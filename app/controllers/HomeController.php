<?php

require_once __DIR__ . '/../models/Survei.php';
require_once __DIR__ . '/../models/Dimensi.php';
require_once __DIR__ . '/../models/Pertanyaan.php';
require_once __DIR__ . '/../models/SurveiPertanyaan.php';
require_once __DIR__ . '/../models/Responden.php';
require_once __DIR__ . '/../models/Jawaban.php';
require_once __DIR__ . '/../models/DetailJawaban.php';

class HomeController
{
    /** Halaman beranda: tampilkan survei yang sedang berjalan + ringkasan */
    public function home_page()
    {
        // Ambil survei yang statusnya "berjalan" & periode aktif (implementasikan di model Survei::getRunning())
        $survei = (new Survei())->getRunning();

        // Hitung total respon (opsional: sediakan di model, atau return 0 jika belum ada survei)
        $totalRespon = 0;
        if ($survei) {
            $totalRespon = (new Jawaban())->countBySurvei('id_survei', $survei['id_survei']);
        }

        View::render('home/layout/user', 'home/home', [
            'survei'       => $survei,
            'totalRespon'  => $totalRespon,
        ]);
    }

    /** Halaman form survei publik */
    public function survei_page()
    {
        // Ambil survei berjalan
        $survei = (new Survei())->getRunning();
        if (!$survei) {
            View::render('home/layout/user', 'home/survei_kosong'); // buat view sederhana: "Tidak ada survei berjalan"
            return;
        }

        // Ambil daftar item pertanyaan dari relasi survei_pertanyaan (urut tampil)
        // Implementasikan di model SurveiPertanyaan::getItemsWithDimension($id_survei)
        // yang me-return array item berisi: id_pertanyaan, kode_pertanyaan, teks_pertanyaan, id_dimensi, nama_dimensi, kode_dimensi, urutan_tampil
        $items = (new SurveiPertanyaan())->getItemsWithDimension($survei['id_survei']);

        View::render('home/layout/dashboard', 'home/survei_form', [
            'survei' => $survei,
            'items'  => $items,
        ]);
    }

    /** Proses kirim survei (public POST) */
    public function kirim_survei()
    {
        session_start();

        // Validasi method
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /sertifikasi-latihan3/survei');
            return;
        }

        $id_survei = (int)($_POST['id_survei'] ?? 0);
        $email     = trim($_POST['email'] ?? '');
        $nama      = trim($_POST['nama'] ?? '');
        $jurusan   = trim($_POST['jurusan'] ?? '');
        $umur      = (int)($_POST['umur'] ?? 0);
        $jk        = $_POST['jenis_kelamin'] ?? '';

        $agreement  = $_POST['jawaban']  ?? []; // item_id => 1..5
        $importance = $_POST['harapan']  ?? []; // item_id => 1..5

        // Validasi dasar
        $errors = [];
        if ($id_survei <= 0) $errors[] = 'Survei tidak valid.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email tidak valid.';
        if ($nama === '') $errors[] = 'Nama wajib diisi.';
        if ($umur < 20 || $umur > 44) $errors[] = 'Umur harus 20–44.';
        if (!in_array($jk, ['Laki-laki', 'Perempuan', 'Lainnya'], true)) $errors[] = 'Jenis kelamin tidak valid.';

        // Ambil daftar pertanyaan yang seharusnya tampil
        $expectedIds = (new SurveiPertanyaan())->getQuestionIds($id_survei); // return array of id_pertanyaan

        foreach ($expectedIds as $qid) {
            if (!isset($agreement[$qid]) || !isset($importance[$qid])) {
                $errors[] = 'Semua pertanyaan wajib diisi.';
                break;
            }
        }

        if ($errors) {
            $_SESSION['alertError'] = implode('<br>', $errors);
            header('Location: /sertifikasi-latihan3/survei');
            return;
        }

        // Simpan data (header + detail)
        try {
            // 1) Responden
            $id_responden = (new Responden())->insertAndGetId([
                'uuid'           => self::uuid4(),
                'email'          => $email,
                'nama'           => $nama,
                'jurusan'        => $jurusan,
                'umur'           => $umur,
                'jenis_kelamin'  => $jk,
                'persetujuan'    => 1,
            ]);

            // 2) Jawaban (header)
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            $ua = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 300);

            $id_jawaban = (new Jawaban())->insertAndGetId([
                'id_survei'   => $id_survei,
                'id_responden' => $id_responden,
                'alamat_ip'   => $ip,  // simpan string; jika DB varbinary gunakan konversi di model
                'user_agent'  => $ua,
            ]);

            // 3) Detail tiap pertanyaan
            $detailM = new DetailJawaban();
            foreach ($expectedIds as $qid) {
                $harapan = (int)$importance[$qid];
                $jawab   = (int)$agreement[$qid];
                // validasi rentang
                if ($harapan < 1 || $harapan > 5 || $jawab < 1 || $jawab > 5) {
                    throw new Exception('Skor harus 1..5');
                }
                $detailM->insert([
                    'id_jawaban'    => $id_jawaban,
                    'id_pertanyaan' => $qid,
                    'harapan'       => $harapan, // importance
                    'jawaban'       => $jawab,   // agreement
                ]);
            }

            $_SESSION['alertSuccess'] = 'Terima kasih! Jawaban Anda sudah terekam.';
            header('Location: /sertifikasi-latihan3/hasil');
            return;
        } catch (Exception $e) {
            $_SESSION['alertError'] = 'Terjadi kesalahan saat menyimpan: ' . $e->getMessage();
            header('Location: /sertifikasi-latihan3/survei');
            return;
        }
    }

    /** Halaman ringkasan hasil cepat (Mean & WQI per dimensi) */
    public function hasil_page()
    {
        $survei = (new Survei())->getRunning();
        if (!$survei) {
            View::render('home/layout/user', 'home/survei_kosong');
            return;
        }

        // Ambil ringkasan mean importance/jawaban & WQI per dimensi
        // Implementasikan di model Jawaban::getSummaryByDimension($id_survei)
        // return: [{nama_dimensi, rata_harapan, rata_jawaban, wqi_unit}]
        $ringkas = (new Jawaban())->getSummaryByDimension($survei['id_survei']);

        View::render('home/layout/user', 'home/hasil', [
            'survei'  => $survei,
            'ringkas' => $ringkas,
        ]);
    }

    /** Halaman kontak (statis) */
    public function kontak_page()
    {
        View::render('home/layout/user', 'home/kontak');
    }

    /** Halaman login admin */
    public function login_page()
    {
        session_start();
        View::render('home/layout/auth', 'home/auth/login');
    }

    /** Util: UUID v4 sederhana */
    private static function uuid4(): string
    {
        $data = random_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
