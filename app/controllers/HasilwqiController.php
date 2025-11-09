<?php
require_once __DIR__ . '/../models/DetailJawaban.php';
require_once __DIR__ . '/../models/Dimensi.php';
require_once __DIR__ . '/../models/Pertanyaan.php';
require_once __DIR__ . '/../models/HasilWqi.php';

class HasilwqiController
{
    public function __construct()
    {
        session_start();
        if (!View::checkAdmin()) {
            header('Location: /webqual/login');
            exit;
        }
    }

    public function index()
    {
        // Ambil dari GET / route, jangan hard-code
        // $id_survei = (int)($_GET['id_survei'] ?? 0);
        // $id_survei = 4;

        $surveiModel = new Survei();
        $surveiBerjalan = $surveiModel->getRunning();
        $id_survei = $surveiBerjalan ? (int)$surveiBerjalan['id_survei'] : 0;
        
        if (!$id_survei) {
            $_SESSION['alertError'] = 'ID survei tidak ditemukan.';
            header('Location: /webqual/admin/survei');
            exit;
        }

        $dj = new DetailJawaban();
        $pt = new Pertanyaan();
        $dm = new Dimensi();
        $hw = new HasilWqi();

        // Ambil pertanyaan & dimensi
        $pertanyaans = $pt->getBySurvei($id_survei); // jika ada, dipakai di view
        $dimensis    = $dm->getAllOrdered();

        // Ambil rata-rata per pertanyaan (avg_jawaban, avg_harapan)
        $data = $dj->getRataRataPerPertanyaan($id_survei);

        // --- Per-butir: hitung MI, MA, MS, WS, WQI_item ---
        $hasilItem   = [];
        $sumWS_total = 0.0;
        $sumMS_total = 0.0;

        foreach ($data as $row) {
            $mi = (float)$row['avg_harapan'];   // Mean Importance
            $ma = (float)$row['avg_jawaban'];   // Mean Agreement
            $ms = $mi * 5;                      // Maximum Score per item
            $ws = $mi * $ma;                    // Weighted Score per item
            $wqi_item = ($ms > 0) ? ($ws / $ms) : 0.0; // 0..1

            $sumWS_total += $ws;
            $sumMS_total += $ms;

            $hasilItem[] = [
                'id_dimensi'      => (int)$row['id_dimensi'],
                'kode_pertanyaan' => $row['kode_pertanyaan'],
                'mean_importance' => round($mi, 3),
                'mean_agreement'  => round($ma, 3),
                'maximum_score'   => round($ms, 3),
                'weighted_score'  => round($ws, 3),
                'wqi_item'        => round($wqi_item, 3),       // 0..1
                'wqi_percent'     => round($wqi_item * 100, 2), // 0..100
            ];
        }

        // --- Per-dimensi: ΣWS / ΣMS ---
        $hasilDimensi = [];
        foreach ($dimensis as $d) {
            $indikator = array_filter($data, fn($r) => (int)$r['id_dimensi'] === (int)$d['id_dimensi']);
            if (!$indikator) continue;

            $sumWS = 0.0;
            $sumMS = 0.0;
            $sumMI = 0.0;
            $sumMA = 0.0;
            $n = 0;

            foreach ($indikator as $r) {
                $mi = (float)$r['avg_harapan'];
                $ma = (float)$r['avg_jawaban'];
                $sumWS += $mi * $ma;
                $sumMS += $mi * 5;
                $sumMI += $mi;
                $sumMA += $ma;
                $n++;
            }

            $wqi_dim = ($sumMS > 0) ? ($sumWS / $sumMS) : 0.0; // 0..1
            $wqi_pct = $wqi_dim * 100.0;

            $hasilDimensi[] = [
                'id_dimensi'        => (int)$d['id_dimensi'],
                'nama_dimensi'      => $d['nama_dimensi'],
                'rata_harapan'      => round($sumMI / max($n, 1), 3),
                'rata_jawaban'      => round($sumMA / max($n, 1), 3),
                'maximum_score_sum' => round($sumMS, 3),
                'weighted_score_sum' => round($sumWS, 3),
                'wqi'               => round($wqi_pct, 2),               // tampil persen di UI
                'kategori'          => $this->kategoriWQIPercent($wqi_pct),
            ];
        }

        // --- Total keseluruhan: ΣWS_total / ΣMS_total ---
        $wqi_total = ($sumMS_total > 0) ? ($sumWS_total / $sumMS_total) : 0.0; // 0..1
        $totalView = [
            'total_weighted_score' => round($sumWS_total, 3),
            'total_maximum_score'  => round($sumMS_total, 3),
            'wqi_overall'          => round($wqi_total * 100, 2), // persen
            'kategori_overall'     => $this->kategoriWQIPercent($wqi_total * 100),
        ];

        // --- OPSIONAL: Simpan ke tabel hasil_wqi (per-dimensi + total) ---
        $this->saveToHasilWqi($hw, $id_survei, $hasilDimensi, $wqi_total, $sumWS_total, $sumMS_total, $data);

        // --- Render ke view ---
        View::render('home/layout/dashboard', 'home/hasil/index', [
            'hasil'         => $hasilItem,     // per-butir
            'hasilDimensi'  => $hasilDimensi,  // per-dimensi
            'total'         => $totalView      // total keseluruhan
        ]);
    }

    /**
     * Simpan ringkasan ke tabel hasil_wqi:
     * - per dimensi (id_dimensi = nilai sebenarnya)
     * - total keseluruhan (id_dimensi = NULL)
     */
    private function saveToHasilWqi(
        HasilWqi $hw,
        int $id_survei,
        array $hasilDimensi,
        float $wqi_total_0_1,
        float $sumWS_total,
        float $sumMS_total,
        array $dataItems
    ): void {
        // Simpan per-dimensi
        foreach ($hasilDimensi as $row) {
            $id_dimensi = (int)$row['id_dimensi'];

            // hitung ulang rata_harapan & rata_jawaban dimensi (sudah ada di $row, tapi pakai angka 4 desimal)
            $rata_h = (float)$row['rata_harapan'];
            $rata_j = (float)$row['rata_jawaban'];

            $hw->upsert([
                'id_survei'       => $id_survei,
                'id_dimensi'      => $id_dimensi,
                'rata_harapan'    => round($rata_h, 4),
                'rata_jawaban'    => round($rata_j, 4),
                'skor_maksimal'   => round((float)$row['maximum_score_sum'], 4),
                'skor_tertimbang' => round((float)$row['weighted_score_sum'], 4),
                'wqi'             => round(((float)$row['wqi']) / 100, 4), // simpan 0..1 di DB
                'interpretasi'    => $row['kategori'],
            ]);
        }

        // Simpan baris total (id_dimensi = NULL)
        // Rata2 harapan & jawaban total → rata dari mean per item (bukan wajib, tapi informatif)
        $nItem = count($dataItems);
        $avgMI = $nItem ? array_sum(array_map(fn($r) => (float)$r['avg_harapan'], $dataItems)) / $nItem : 0.0;
        $avgMA = $nItem ? array_sum(array_map(fn($r) => (float)$r['avg_jawaban'],  $dataItems)) / $nItem : 0.0;

        $hw->upsert([
            'id_survei'       => $id_survei,
            'id_dimensi'      => null, // TOTAL
            'rata_harapan'    => round($avgMI, 4),
            'rata_jawaban'    => round($avgMA, 4),
            'skor_maksimal'   => round($sumMS_total, 4),
            'skor_tertimbang' => round($sumWS_total, 4),
            'wqi'             => round($wqi_total_0_1, 4), // 0..1
            'interpretasi'    => $this->kategoriWQIPercent($wqi_total_0_1 * 100),
        ]);
    }

    /** Ambang kategori dengan input persen (0..100) */
    private function kategoriWQIPercent(float $nilaiPersen): string
    {
        if ($nilaiPersen >= 80) return 'Sangat Baik';
        if ($nilaiPersen >= 60) return 'Baik';
        if ($nilaiPersen >= 50) return 'Cukup Baik';
        if ($nilaiPersen >= 20) return 'Kurang';
        return 'Sangat Kurang';
    }
}
