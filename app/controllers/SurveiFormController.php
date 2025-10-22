<?php

require_once __DIR__ . '/../models/Survei.php';

class SurveiFormController
{
    public function form()
    {
        session_start();
        $model = new Survei();

        // Ambil survei yang sedang berjalan
        $survei = $model->getRunning();
        if (!$survei) {
            View::render('home/layout/user', 'home/survei/closed');
            return;
        }

        // Ambil semua pertanyaan + dimensi
        $items = $model->getItemsWithDimension($survei['id_survei']);

        View::render('home/layout/user', 'home/survei/form', [
            'survei' => $survei,
            'items'  => $items
        ]);
    }

    public function submit()
    {
        session_start();

        $idSurvei  = (int)($_POST['id_survei'] ?? 0);
        $email     = trim($_POST['email'] ?? '');
        $nama      = trim($_POST['nama'] ?? '');
        $jurusan   = trim($_POST['jurusan'] ?? '');
        $umur      = (int)($_POST['umur'] ?? 0);
        $jk        = $_POST['jenis_kelamin'] ?? '';
        $pendidikan = trim($_POST['pendidikan'] ?? '');
        $pekerjaan = trim($_POST['pekerjaan'] ?? '');

        $jawaban   = $_POST['jawaban'] ?? [];
        $harapan   = $_POST['harapan'] ?? [];

        $errors = [];
        if ($idSurvei <= 0) $errors[] = 'Survei tidak valid.';
        if ($email === '')  $errors[] = 'Email wajib diisi.';
        if ($nama === '')   $errors[] = 'Nama wajib diisi.';
        if ($jurusan === '') $errors[] = 'Jurusan/asal wajib diisi.';
        if ($umur <= 0)     $errors[] = 'Umur wajib diisi.';
        if ($jk === '')     $errors[] = 'Jenis kelamin wajib diisi.';
        if (empty($jawaban) || empty($harapan)) $errors[] = 'Pernyataan belum diisi.';

        if ($errors) {
            $_SESSION['alertError'] = implode('<br>', $errors);
            header('Location: /webqual/survei');
            return;
        }

        $db = Database::getConnection();

        try {
            $db->beginTransaction();

            // 1) simpan responden
            $sqlRes = "INSERT INTO responden
                   (email, nama, jurusan, umur, jenis_kelamin, pendidikan, pekerjaan, dibuat_pada, diperbarui_pada)
                   VALUES (:email, :nama, :jurusan, :umur, :jk, :pendidikan, :pekerjaan, NOW(), NOW())";
            $stRes = $db->prepare($sqlRes);
            $stRes->execute([
                ':email'      => $email ?: null,
                ':nama'       => $nama ?: null,
                ':jurusan'    => $jurusan ?: null,
                ':umur'       => $umur ?: null,
                ':jk'         => $jk ?: null,
                ':pendidikan' => $pendidikan ?: null,
                ':pekerjaan'  => $pekerjaan ?: null,
            ]);
            $idResponden = (int)$db->lastInsertId();

            // 2) simpan jawaban header
            $ip  = $_SERVER['REMOTE_ADDR'] ?? null;
            $ua  = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 300);

            // alamat_ip kolom VARBINARY(16). Pakai INET6_ATON agar aman ipv4/ipv6.
            $sqlJawab = "INSERT INTO jawaban (id_survei, id_responden, waktu_kirim)
                     VALUES (:id_survei, :id_responden, NOW())";
            $stJawab = $db->prepare($sqlJawab);
            $stJawab->execute([
                ':id_survei'   => $idSurvei,
                ':id_responden' => $idResponden,
            ]);
            $idJawaban = (int)$db->lastInsertId();

            // 3) simpan detail jawaban
            $stDet = $db->prepare("INSERT INTO detail_jawaban
                               (id_jawaban, id_pertanyaan, harapan, jawaban)
                               VALUES (:id_jawaban, :id_pertanyaan, :harapan, :jawaban)");

            foreach ($jawaban as $idPertanyaan => $nilaiJawaban) {
                $nilaiHarapan = isset($harapan[$idPertanyaan]) ? (int)$harapan[$idPertanyaan] : null;
                $stDet->execute([
                    ':id_jawaban'    => $idJawaban,
                    ':id_pertanyaan' => (int)$idPertanyaan,
                    ':harapan'       => $nilaiHarapan,
                    ':jawaban'       => (int)$nilaiJawaban,
                ]);
            }

            $db->commit();
            header('Location: /webqual/survei/thanks');
            exit;
        } catch (Exception $e) {
            if ($db->inTransaction()) $db->rollBack();
            $_SESSION['alertError'] = 'Terjadi kesalahan saat menyimpan. Silakan coba lagi.' . $e->getMessage();
            header('Location: /webqual/survei');
            return;
        }
    }


    public function thanks()
    {
        View::render('home/layout/user', 'home/survei/thanks');
    }
}
