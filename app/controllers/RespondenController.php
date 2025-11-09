<?php
require_once __DIR__ . '/../models/Responden.php';
require_once __DIR__ . '/../models/Jawaban.php';
require_once __DIR__ . '/../models/Dimensi.php';
require_once __DIR__ . '/../models/Pertanyaan.php';

class RespondenController
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
        $responden = (new Responden())->getAll();
        View::render('home/layout/dashboard', 'home/responden/index', [
            'responden' => $responden
        ]);
    }

    public function show()
    {
        // Ambil parameter
        $id_responden = (int)($_GET['id_responden'] ?? $_GET['id'] ?? 0);
        $id_survei    = (int)($_GET['id_survei'] ?? 0); // WAJIB untuk matriks

        if (!$id_responden) {
            $_SESSION['alertError'] = 'ID responden tidak ditemukan.';
            header('Location: /webqual/admin/responden');
            exit;
        }

        $mRes = new Responden();
        $mJaw = new Jawaban();
        $mDim = new Dimensi();
        $mPer = new Pertanyaan();

        $responden = $mRes->getById('id_responden', $id_responden);
        if (!$responden) {
            $_SESSION['alertError'] = 'Data responden tidak ditemukan.';
            header('Location: /webqual/admin/responden');
            exit;
        }

        // --- DATA UNTUK RINGKASAN (khusus responden ini) ---
        // Kalo id_survei belum diisi, coba tebak dari salah satu jawaban milik responden ini
        if (!$id_survei) {
            $guess = $this->guessSurveiIdForResponden($id_responden);
            $id_survei = $guess ?: 0;
        }
        $ringkasan = [];
        if ($id_survei) {
            $ringkasan = $mJaw->getRingkasanResponden($id_survei, $id_responden);
        }

        // --- DATA UNTUK MATRIKS (opsional: tampilkan semua responden di survei ini) ---
        $tipe = $_GET['tipe'] ?? 'penilaian'; // 'penilaian' | 'harapan'
        $dimensis = [];
        $respondenList = [];
        $nilai = [];

        if ($id_survei) {
            // bangun daftar dimensi + pertanyaan aktif (buat header kolom)
            $dimensis = $mDim->getAllOrdered();
            foreach ($dimensis as &$d) {
                $d['pertanyaans'] = $mPer->getAktifByDimensi((int)$d['id_dimensi']);
            }
            unset($d);

            // daftar responden dalam survei ini (baris tabel matriks)
            $respondenList = $mRes->getBySurvei($id_survei);

            // matrix nilai: [id_responden][id_pertanyaan] = nilai
            $raw = $mJaw->getForMatrix($id_survei, $tipe); // sudah ada di BaseModel turunanmu
            foreach ($raw as $r) {
                $nilai[(int)$r['id_responden']][(int)$r['id_pertanyaan']] = (int)$r['nilai'];
            }
        }

        View::render('home/layout/dashboard', 'home/responden/show', [
            'responden'     => $responden,     // identitas responden yg dilihat
            'ringkasan'     => $ringkasan,     // tabel ringkasan jawaban responden ini
            'id_survei'     => $id_survei,     // untuk filter, dsb

            // untuk tabel matriks (opsional)
            'tipe'          => $tipe,
            'dimensis'      => $dimensis,
            'respondenList' => $respondenList,
            'nilai'         => $nilai,
        ]);
    }

    /** Tebak salah satu id_survei dari responden (jika tidak dipassing via GET) */
    private function guessSurveiIdForResponden(int $id_responden): ?int
    {
        $pdo = Database::getConnection();
        $st  = $pdo->prepare("SELECT id_survei FROM jawaban WHERE id_responden=:r ORDER BY waktu_kirim DESC LIMIT 1");
        $st->bindValue(':r', $id_responden, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['id_survei'] : null;
    }

    public function delete()
    {
        session_start();
        $id = $_POST['id_responden'] ?? $_POST['id'] ?? null;

        if (!$id) {
            $_SESSION['alertError'] = 'ID responden tidak valid.';
            echo json_encode(['status' => 'error']);
            return;
        }

        try {
            // Hapus responden dan semua relasi (jawaban & detail_jawaban via ON DELETE CASCADE)
            (new Responden())->delete('id_responden', $id);
            $_SESSION['alertSuccess'] = 'Berhasil menghapus responden.';
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            $_SESSION['alertError'] = 'Gagal menghapus responden.';
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

        return;
    }
}
