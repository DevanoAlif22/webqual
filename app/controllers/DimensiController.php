<?php

require_once __DIR__ . '/../models/Dimensi.php';

class DimensiController
{
    // public function __construct()
    // {
    //     session_start();
    //     if (!View::checkAdmin()) {
    //         header('Location: /webqual/login');
    //         return;
    //     }
    // }

    public function index()
    {
        session_start();
        $dimensis = (new Dimensi())->getAll(); // sebaiknya ORDER BY id_dimensi ASC di model
        View::render('home/layout/dashboard', 'home/dimensi/index', ['dimensis' => $dimensis]);
    }

    public function create()
    {
        session_start();
        View::render('home/layout/dashboard', 'home/dimensi/create');
    }

    public function store()
    {
        session_start();

        $kode_dimensi = strtoupper(trim($_POST['kode_dimensi'] ?? ''));
        $nama_dimensi = trim($_POST['nama_dimensi'] ?? '');
        $deskripsi    = trim($_POST['deskripsi'] ?? '');

        // Validasi dasar
        $errors = [];
        if ($kode_dimensi === '') $errors[] = 'Kode dimensi wajib diisi.';
        if ($nama_dimensi === '') $errors[] = 'Nama dimensi wajib diisi.';
        if (strlen($kode_dimensi) > 40) $errors[] = 'Kode dimensi maksimal 40 karakter.';
        if (strlen($nama_dimensi) > 120) $errors[] = 'Nama dimensi maksimal 120 karakter.';

        if ($errors) {
            $_SESSION['alertError'] = implode('<br>', $errors);
            header('Location: /sertifikasi-latihan3/dimensi/create');
            return;
        }

        try {
            $dimensi = new Dimensi();
            $dimensi->insert([
                'id_dimensi'     => null,
                'kode_dimensi'   => htmlspecialchars($kode_dimensi),
                'nama_dimensi'   => htmlspecialchars($nama_dimensi),
                'deskripsi'      => $deskripsi, // boleh kosong
                'dibuat_pada'    => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ]);

            $_SESSION['alertSuccess'] = 'Berhasil menambahkan dimensi!';
            header('Location: /sertifikasi-latihan3/dimensi');
            exit();
        } catch (Exception $e) {
            // biasanya kena UNIQUE (kode_dimensi)
            $_SESSION['alertError'] = 'Gagal menambahkan dimensi! ' . $e->getMessage();
            echo json_encode(['status' => 'error']);
            return;
        }
    }

    public function edit()
    {
        session_start();
        $id = $_GET['id_dimensi'] ?? $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['alertError'] = 'ID dimensi tidak ditemukan.';
            header('Location: /sertifikasi-latihan3/dimensi');
            return;
        }

        $dimensi = (new Dimensi())->getById('id_dimensi', $id);
        if (!$dimensi) {
            $_SESSION['alertError'] = 'Data dimensi tidak ditemukan.';
            header('Location: /sertifikasi-latihan3/dimensi');
            return;
        }

        View::render('home/layout/dashboard', 'home/dimensi/edit', ['dimensi' => $dimensi]);
    }

    public function update()
    {
        session_start();

        $id           = $_POST['id_dimensi'] ?? $_POST['id'] ?? null;
        $kode_dimensi = strtoupper(trim($_POST['kode_dimensi'] ?? ''));
        $nama_dimensi = trim($_POST['nama_dimensi'] ?? '');
        $deskripsi    = trim($_POST['deskripsi'] ?? '');

        $errors = [];
        if (!$id) $errors[] = 'ID dimensi wajib ada.';
        if ($kode_dimensi === '') $errors[] = 'Kode dimensi wajib diisi.';
        if ($nama_dimensi === '') $errors[] = 'Nama dimensi wajib diisi.';
        if (strlen($kode_dimensi) > 40) $errors[] = 'Kode dimensi maksimal 40 karakter.';
        if (strlen($nama_dimensi) > 120) $errors[] = 'Nama dimensi maksimal 120 karakter.';

        if ($errors) {
            $_SESSION['alertError'] = implode('<br>', $errors);
            header('Location: /sertifikasi-latihan3/dimensi/edit?id_dimensi=' . urlencode($id));
            return;
        }

        try {
            $dimensi = new Dimensi();
            $dimensi->update([
                'kode_dimensi'   => htmlspecialchars($kode_dimensi),
                'nama_dimensi'   => htmlspecialchars($nama_dimensi),
                'deskripsi'      => $deskripsi,
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ], 'id_dimensi', $id);

            $_SESSION['alertSuccess'] = 'Berhasil memperbarui dimensi!';
            header('Location: /sertifikasi-latihan3/dimensi');
        } catch (Exception $e) {
            $_SESSION['alertError'] = 'Gagal memperbarui dimensi! ' . $e->getMessage();
            echo json_encode(['status' => 'error']);
        }
        return;
    }

    public function show()
    {
        session_start();
        $id = $_GET['id_dimensi'] ?? $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['alertError'] = 'ID dimensi tidak ditemukan.';
            header('Location: /sertifikasi-latihan3/dimensi');
            return;
        }

        $dimensi = (new Dimensi())->getById('id_dimensi', $id);
        if (!$dimensi) {
            $_SESSION['alertError'] = 'Data dimensi tidak ditemukan.';
            header('Location: /sertifikasi-latihan3/dimensi');
            return;
        }

        View::render('home/layout/dashboard', 'home/dimensi/show', ['dimensi' => $dimensi]);
    }

    public function delete()
    {
        session_start();
        $id = $_POST['id_dimensi'] ?? $_POST['id'] ?? null;

        if (!$id) {
            $_SESSION['alertError'] = 'ID dimensi tidak valid.';
            echo json_encode(['status' => 'error']);
            return;
        }

        try {
            (new Dimensi())->delete('id_dimensi', $id);
            $_SESSION['alertSuccess'] = 'Berhasil menghapus dimensi.';
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            $_SESSION['alertError'] = 'Gagal menghapus dimensi.';
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        return;
    }
}
