<?php
require_once __DIR__ . '/../models/Dimensi.php';
require_once __DIR__ . '/../models/Pertanyaan.php';
require_once __DIR__ . '/../models/Responden.php';
require_once __DIR__ . '/../models/DetailJawaban.php';

class JawabanController
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
            $_SESSION['alertError'] = 'Pilih survei terlebih dahulu.';
            header('Location: /webqual/admin/survei');
            return;
        }

        $tipe = ($_GET['tipe'] ?? 'penilaian'); // 'penilaian' | 'harapan'

        // dimensi + pertanyaan (urut)
        $dimModel = new Dimensi();
        $prtModel = new Pertanyaan();
        $dimensis = $dimModel->getAllOrdered();
        foreach ($dimensis as &$d) {
            $d['pertanyaans'] = $prtModel->getAktifByDimensi($d['id_dimensi']);
        }

        // responden via JOIN jawaban
        $responden = (new Responden())->getBySurvei($id_survei);

        // nilai matriks dari detail_jawaban
        $rows  = (new DetailJawaban())->getForMatrix($id_survei, $tipe);
        $nilai = [];
        foreach ($rows as $r) {
            $nilai[(int)$r['id_responden']][(int)$r['id_pertanyaan']] = (int)$r['nilai'];
        }

        View::render('home/layout/dashboard', 'home/jawaban/index', [
            'dimensis'  => $dimensis,
            'responden' => $responden,
            'nilai'     => $nilai
        ]);
    }
}
