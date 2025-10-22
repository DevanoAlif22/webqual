<?php
require_once __DIR__ . '/../models/DetailJawaban.php';
require_once __DIR__ . '/../models/Dimensi.php';
require_once __DIR__ . '/../models/Pertanyaan.php';

class HasilwqiController
{
    public function __construct()
    {
        session_start();
        if (!View::checkAdmin()) {
            header('Location: /webqual/login');
            return;
        }
    }

    public function index()
    {
        // $id_survei = (int)($_GET['id_survei'] ?? 0);
        $id_survei = 1;
        if (!$id_survei) {
            $_SESSION['alertError'] = 'ID survei tidak ditemukan.';
            header('Location: /webqual/admin/survei');
            return;
        }

        $dj = new DetailJawaban();
        $pt = new Pertanyaan();
        $dm = new Dimensi();

        // Ambil semua pertanyaan survei beserta dimensi
        $pertanyaans = $pt->getBySurvei($id_survei);
        $dimensis = $dm->getAllOrdered();

        // Ambil rata-rata nilai per pertanyaan
        $data = $dj->getRataRataPerPertanyaan($id_survei);

        $totalMax = 0;
        $totalBobot = 0;
        $hasil = [];

        foreach ($data as $row) {
            $maks = ($row['avg_jawaban'] / $row['avg_harapan']) * 100;
            $hasil[] = [
                'kode_pertanyaan' => $row['kode_pertanyaan'],
                'maksimum_skor'   => round($maks, 2),
                'perbandingan'    => round($row['avg_jawaban'] / $row['avg_harapan'], 2),
                'wqi'             => round($maks / 100, 2)
            ];
            $totalMax += $maks;
        }

        // Hitung per dimensi (rata-rata WQI)
        $hasilDimensi = [];
        foreach ($dimensis as $d) {
            $indikator = array_filter($data, fn($r) => $r['id_dimensi'] == $d['id_dimensi']);
            if (count($indikator) == 0) continue;
            $rataHarapan = array_sum(array_column($indikator, 'avg_harapan')) / count($indikator);
            $rataJawaban = array_sum(array_column($indikator, 'avg_jawaban')) / count($indikator);
            $wqi = round(($rataJawaban / $rataHarapan) * 100, 2);

            $hasilDimensi[] = [
                'nama_dimensi' => $d['nama_dimensi'],
                'rata_harapan' => round($rataHarapan, 2),
                'rata_jawaban' => round($rataJawaban, 2),
                'wqi'          => $wqi,
                'kategori'     => $this->kategoriWQI($wqi)
            ];
        }

        View::render('home/layout/dashboard', 'home/hasil/index', [
            'hasil'         => $hasil,
            'hasilDimensi'  => $hasilDimensi,
            'totalMax'      => $totalMax
        ]);
    }

    private function kategoriWQI($nilai)
    {
        if ($nilai >= 80) return 'Sangat Baik';
        if ($nilai >= 66) return 'Baik';
        if ($nilai >= 51) return 'Cukup';
        if ($nilai >= 35) return 'Kurang';
        return 'Sangat Kurang';
    }
}
