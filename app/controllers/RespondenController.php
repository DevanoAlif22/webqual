<?php

require_once __DIR__ . '/../models/Responden.php';
require_once __DIR__ . '/../models/Jawaban.php';

class RespondenController
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
        session_start();
        $responden = (new Responden())->getAll(); // bisa diurutkan di model (ORDER BY waktu_kirim DESC)
        View::render('home/layout/dashboard', 'home/responden/index', [
            'responden' => $responden
        ]);
    }

    public function show()
    {
        session_start();
        $id = $_GET['id_responden'] ?? $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['alertError'] = 'ID responden tidak ditemukan.';
            header('Location: /webqual/admin/responden');
            return;
        }

        $responden = (new Responden())->getById('id_responden', $id);
        if (!$responden) {
            $_SESSION['alertError'] = 'Data responden tidak ditemukan.';
            header('Location: /webqual/admin/responden');
            return;
        }

        // Ambil jawaban milik responden ini (opsional ditampilkan di view detail)
        $jawabans = (new Jawaban())->getAllById('id_responden', $id);

        View::render('home/layout/dashboard', 'home/responden/show', [
            'responden' => $responden,
            'jawabans'  => $jawabans
        ]);
    }
}
