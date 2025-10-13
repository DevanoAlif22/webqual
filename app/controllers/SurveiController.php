<?php

require_once __DIR__ . '/../models/Survei.php';

class SurveiController
{
    private array $statusAllowed = ['draf', 'berjalan', 'selesai'];

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
        $surveis = (new Survei())->getAll(); // sebaiknya sudah ORDER BY tanggal_mulai DESC di model
        View::render('home/layout/dashboard', 'home/survei/index', ['surveis' => $surveis]);
    }

    public function create()
    {
        session_start();
        // default id_situs = 1 (sesuai skema), tapi tetap kirim ke view kalau mau pilih
        View::render('home/layout/dashboard', 'home/survei/create', [
            'statusAllowed' => $this->statusAllowed,
            'defaultSiteId' => 1,
        ]);
    }

    public function store()
    {
        session_start();

        $judul   = htmlspecialchars($_POST['judul_survei'] ?? '');
        $mulai   = $_POST['tanggal_mulai'] ?? '';
        $selesai = $_POST['tanggal_selesai'] ?? '';
        $status  = $_POST['status'] ?? 'draf';
        $idSitus = (int)($_POST['id_situs'] ?? 1);

        // Validasi dasar
        $errors = [];
        if ($judul === '') $errors[] = 'Judul survei wajib diisi.';
        if (!$this->isValidDateTime($mulai)) $errors[] = 'Format tanggal mulai tidak valid (YYYY-MM-DD HH:MM:SS).';
        if (!$this->isValidDateTime($selesai)) $errors[] = 'Format tanggal selesai tidak valid (YYYY-MM-DD HH:MM:SS).';
        if (!in_array($status, $this->statusAllowed, true)) $errors[] = 'Status survei tidak valid.';
        if ($this->isValidDateTime($mulai) && $this->isValidDateTime($selesai) && strtotime($mulai) >= strtotime($selesai)) {
            $errors[] = 'Tanggal mulai harus lebih awal dari tanggal selesai.';
        }

        if ($errors) {
            $_SESSION['alertError'] = implode('<br>', $errors);
            header('Location: /sertifikasi-latihan3/survei/create');
            return;
        }

        try {
            $survei = new Survei();
            $survei->insert([
                'id_survei'       => null,
                'id_situs'        => $idSitus,            // default 1
                'judul_survei'    => $judul,
                'tanggal_mulai'   => $mulai,
                'tanggal_selesai' => $selesai,
                'status'          => $status,
                'dibuat_pada'     => date('Y-m-d H:i:s'),
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ]);

            $_SESSION['alertSuccess'] = 'Berhasil menambahkan survei!';
            header('Location: /sertifikasi-latihan3/survei');
            exit();
        } catch (Exception $e) {
            $_SESSION['alertError'] = 'Gagal menambahkan survei!';
            echo json_encode(['status' => $e->getMessage()]);
            return;
        }
    }

    public function edit()
    {
        session_start();
        $id = $_GET['id_survei'] ?? $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['alertError'] = 'ID survei tidak ditemukan.';
            header('Location: /sertifikasi-latihan3/survei');
            return;
        }

        $survei = (new Survei())->getById('id_survei', $id);
        if (!$survei) {
            $_SESSION['alertError'] = 'Data survei tidak ditemukan.';
            header('Location: /sertifikasi-latihan3/survei');
            return;
        }

        View::render('home/layout/dashboard', 'home/survei/edit', [
            'survei'        => $survei,
            'statusAllowed' => $this->statusAllowed,
        ]);
    }

    public function update()
    {
        session_start();

        $id      = $_POST['id_survei'] ?? $_POST['id'] ?? null;
        $judul   = $_POST['judul_survei'] ?? '';
        $mulai   = $_POST['tanggal_mulai'] ?? '';
        $selesai = $_POST['tanggal_selesai'] ?? '';
        $status  = $_POST['status'] ?? 'draf';
        $idSitus = (int)($_POST['id_situs'] ?? 1);

        $errors = [];
        if (!$id) $errors[] = 'ID survei wajib ada.';
        if ($judul === '') $errors[] = 'Judul survei wajib diisi.';
        if (!$this->isValidDateTime($mulai)) $errors[] = 'Format tanggal mulai tidak valid.';
        if (!$this->isValidDateTime($selesai)) $errors[] = 'Format tanggal selesai tidak valid.';
        if (!in_array($status, $this->statusAllowed, true)) $errors[] = 'Status survei tidak valid.';
        if ($this->isValidDateTime($mulai) && $this->isValidDateTime($selesai) && strtotime($mulai) >= strtotime($selesai)) {
            $errors[] = 'Tanggal mulai harus lebih awal dari tanggal selesai.';
        }

        if ($errors) {
            $_SESSION['alertError'] = implode('<br>', $errors);
            header('Location: /sertifikasi-latihan3/survei/edit?id_survei=' . urlencode($id));
            return;
        }

        try {
            $survei = new Survei();
            $survei->update([
                'id_situs'        => $idSitus,
                'judul_survei'    => htmlspecialchars($judul),
                'tanggal_mulai'   => $mulai,
                'tanggal_selesai' => $selesai,
                'status'          => $status,
                'diperbarui_pada' => date('Y-m-d H:i:s'),
            ], 'id_survei', $id);

            $_SESSION['alertSuccess'] = 'Berhasil memperbarui survei!';
            header('Location: /sertifikasi-latihan3/survei');
        } catch (Exception $e) {
            $_SESSION['alertError'] = 'Gagal memperbarui survei!';
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        return;
    }

    public function show()
    {
        session_start();
        $id = $_GET['id_survei'] ?? $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['alertError'] = 'ID survei tidak ditemukan.';
            header('Location: /sertifikasi-latihan3/survei');
            return;
        }

        $survei = (new Survei())->getById('id_survei', $id);
        if (!$survei) {
            $_SESSION['alertError'] = 'Data survei tidak ditemukan.';
            header('Location: /sertifikasi-latihan3/survei');
            return;
        }

        View::render('home/layout/dashboard', 'home/survei/show', ['survei' => $survei]);
    }

    public function delete()
    {
        session_start();
        $id = $_POST['id_survei'] ?? $_POST['id'] ?? null;

        if (!$id) {
            $_SESSION['alertError'] = 'ID survei tidak valid.';
            echo json_encode(['status' => 'error']);
            return;
        }

        try {
            (new Survei())->delete('id_survei', $id);
            $_SESSION['alertSuccess'] = 'Berhasil menghapus survei.';
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            $_SESSION['alertError'] = 'Gagal menghapus survei.';
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        return;
    }

    /** Util: validasi string datetime "YYYY-MM-DD HH:MM:SS" */
    private function isValidDateTime(string $dt): bool
    {
        $d = DateTime::createFromFormat('Y-m-d H:i:s', $dt);
        return $d && $d->format('Y-m-d H:i:s') === $dt;
    }
}
