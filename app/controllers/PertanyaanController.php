<?php

require_once __DIR__ . '/../models/Pertanyaan.php';
require_once __DIR__ . '/../models/Dimensi.php';

class PertanyaanController
{
    // public function __construct()
    // {
    //     session_start();
    //     if (!View::checkAdmin()) {
    //         header('Location: /webqual/admin/login');
    //         return;
    //     }
    // }

    /** List pertanyaan (optional filter by dimensi) */
    public function index()
    {
        session_start();

        $idDimensi = isset($_GET['id_dimensi']) ? (int)$_GET['id_dimensi'] : null;

        $modelP = new Pertanyaan();
        $modelD = new Dimensi();

        $dimensis   = $modelD->getAll(); // untuk dropdown filter
        $pertanyaans = $idDimensi ? $modelP->getById('id_dimensi', $idDimensi) : $modelP->getAll();

        View::render('home/layout/dashboard', 'home/pertanyaan/index', [
            'pertanyaans' => $pertanyaans,
            'dimensis'    => $dimensis,
            'filterDim'   => $idDimensi,
        ]);
    }

    /** Form create */
    public function create()
    {
        session_start();
        $dimensis = (new Dimensi())->getAll();
        View::render('home/layout/dashboard', 'home/pertanyaan/create', [
            'dimensis' => $dimensis
        ]);
    }

    /** Simpan baru */
    public function store()
    {
        session_start();

        $id_dimensi       = (int)($_POST['id_dimensi'] ?? 0);
        $kode_pertanyaan  = strtoupper(trim($_POST['kode_pertanyaan'] ?? ''));
        $teks_pertanyaan  = trim($_POST['teks_pertanyaan'] ?? '');
        $aktif            = isset($_POST['aktif']) ? (int)($_POST['aktif'] ? 1 : 0) : 1;

        // Validasi
        $errors = [];
        if ($id_dimensi <= 0)               $errors[] = 'Dimensi wajib dipilih.';
        if ($kode_pertanyaan === '')        $errors[] = 'Kode pertanyaan wajib diisi.';
        if (strlen($kode_pertanyaan) > 40)  $errors[] = 'Kode pertanyaan maksimal 40 karakter.';
        if ($teks_pertanyaan === '')        $errors[] = 'Teks pertanyaan wajib diisi.';

        if ($errors) {
            $_SESSION['alertError'] = implode('<br>', $errors);
            header('Location: /webqual/admin/pertanyaan/create');
            return;
        }

        try {
            $pertanyaan = new Pertanyaan();
            $pertanyaan->insert([
                'id_pertanyaan'  => null,
                'id_dimensi'     => $id_dimensi,
                'kode_pertanyaan' => htmlspecialchars($kode_pertanyaan),
                'teks_pertanyaan' => $teks_pertanyaan,
                'aktif'          => $aktif,
                'dibuat_pada'    => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ]);

            $_SESSION['alertSuccess'] = 'Berhasil menambahkan pertanyaan!';
            header('Location: /webqual/admin/pertanyaan');
            exit();
        } catch (Exception $e) {
            $_SESSION['alertError'] = 'Gagal menambahkan pertanyaan! ' . $e->getMessage();
            echo json_encode(['status' => 'error']);
            return;
        }
    }

    /** Form edit */
    public function edit()
    {
        session_start();
        $id = $_GET['id_pertanyaan'] ?? $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['alertError'] = 'ID pertanyaan tidak ditemukan.';
            header('Location: /webqual/admin/pertanyaan');
            return;
        }

        $modelP = new Pertanyaan();
        $pertanyaan = $modelP->getById('id_pertanyaan', $id);

        if (!$pertanyaan) {
            $_SESSION['alertError'] = 'Data pertanyaan tidak ditemukan.';
            header('Location: /webqual/admin/pertanyaan');
            return;
        }

        $dimensis = (new Dimensi())->getAll();

        View::render('home/layout/dashboard', 'home/pertanyaan/edit', [
            'pertanyaan' => $pertanyaan,
            'dimensis'   => $dimensis
        ]);
    }

    /** Update data */
    public function update()
    {
        session_start();

        $id               = $_POST['id_pertanyaan'] ?? $_POST['id'] ?? null;
        $id_dimensi       = (int)($_POST['id_dimensi'] ?? 0);
        $kode_pertanyaan  = strtoupper(trim($_POST['kode_pertanyaan'] ?? ''));
        $teks_pertanyaan  = trim($_POST['teks_pertanyaan'] ?? '');
        $aktif            = isset($_POST['aktif']) ? (int)($_POST['aktif'] ? 1 : 0) : 1;

        // Validasi
        $errors = [];
        if (!$id)                              $errors[] = 'ID pertanyaan wajib ada.';
        if ($id_dimensi <= 0)                  $errors[] = 'Dimensi wajib dipilih.';
        if ($kode_pertanyaan === '')           $errors[] = 'Kode pertanyaan wajib diisi.';
        if (strlen($kode_pertanyaan) > 40)     $errors[] = 'Kode pertanyaan maksimal 40 karakter.';
        if ($teks_pertanyaan === '')           $errors[] = 'Teks pertanyaan wajib diisi.';

        if ($errors) {
            $_SESSION['alertError'] = implode('<br>', $errors);
            header('Location: /webqual/admin/pertanyaan/edit?id_pertanyaan=' . urlencode($id));
            return;
        }

        try {
            $pertanyaan = new Pertanyaan();
            $pertanyaan->update([
                'id_dimensi'      => $id_dimensi,
                'kode_pertanyaan' => htmlspecialchars($kode_pertanyaan),
                'teks_pertanyaan' => $teks_pertanyaan,
                'aktif'           => $aktif,
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ], 'id_pertanyaan', $id);

            $_SESSION['alertSuccess'] = 'Berhasil memperbarui pertanyaan!';
            header('Location: /webqual/admin/pertanyaan');
        } catch (Exception $e) {
            $_SESSION['alertError'] = 'Gagal memperbarui pertanyaan! ' . $e->getMessage();
            echo json_encode(['status' => 'error']);
        }
        return;
    }

    /** Detail */
    public function show()
    {
        session_start();
        $id = $_GET['id_pertanyaan'] ?? $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['alertError'] = 'ID pertanyaan tidak ditemukan.';
            header('Location: /webqual/admin/pertanyaan');
            return;
        }

        $pertanyaan = (new Pertanyaan())->getById('id_pertanyaan', $id);
        if (!$pertanyaan) {
            $_SESSION['alertError'] = 'Data pertanyaan tidak ditemukan.';
            header('Location: /webqual/admin/pertanyaan');
            return;
        }

        // ambil nama dimensi untuk tampilan
        $dimensi = (new Dimensi())->getById('id_dimensi', $pertanyaan['id_dimensi']);

        View::render('home/layout/dashboard', 'home/pertanyaan/show', [
            'pertanyaan' => $pertanyaan,
            'dimensi'    => $dimensi
        ]);
    }

    /** Hapus */
    public function delete()
    {
        session_start();
        $id = $_POST['id_pertanyaan'] ?? $_POST['id'] ?? null;

        if (!$id) {
            $_SESSION['alertError'] = 'ID pertanyaan tidak valid.';
            echo json_encode(['status' => 'error']);
            return;
        }

        try {
            (new Pertanyaan())->delete('id_pertanyaan', $id); // akan gagal jika masih direferensikan di survei_pertanyaan (FK)
            $_SESSION['alertSuccess'] = 'Berhasil menghapus pertanyaan.';
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            // Kemungkinan terikat FK di survei_pertanyaan
            $_SESSION['alertError'] = 'Gagal menghapus pertanyaan. Pastikan tidak sedang dipakai pada Survei.';
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        return;
    }
}
