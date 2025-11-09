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

        $idSurvei = (int)($_POST['id_survei'] ?? 0);

        // === Data diri minimal ===
        $nama    = trim($_POST['nama'] ?? '');
        $umur    = (int)($_POST['umur'] ?? 0);
        $jk      = $_POST['jenis_kelamin'] ?? '';
        $asal    = trim($_POST['jurusan'] ?? ''); // gunakan 'jurusan' sbg 'asal'

        // Tidak dipakai tapi aman diset null (jaga skema table yang sudah ada)
        $email       = null;
        $pendidikan  = null;
        $pekerjaan   = null;

        // Kuesioner
        $jawaban = $_POST['jawaban'] ?? [];
        $harapan = $_POST['harapan'] ?? [];

        // === Validasi minimal ===
        $errors = [];
        if ($idSurvei <= 0) $errors[] = 'Survei tidak valid.';
        if ($nama === '')   $errors[] = 'Nama wajib diisi.';
        if ($umur <= 0)     $errors[] = 'Umur wajib diisi.';
        if ($jk === '')     $errors[] = 'Jenis kelamin wajib diisi.';
        if ($asal === '')   $errors[] = 'Asal wajib diisi.';
        if (empty($jawaban) || empty($harapan)) $errors[] = 'Pernyataan belum diisi.';

        if ($errors) {
            $_SESSION['alertError'] = implode('<br>', $errors);
            header('Location: /webqual/survei');
            return;
        }

        $db = Database::getConnection();

        try {
            $db->beginTransaction();

            // 1) simpan responden (email/pendidikan/pekerjaan diset NULL)
            $sqlRes = "INSERT INTO responden
          (email, nama, jurusan, umur, jenis_kelamin,  dibuat_pada, diperbarui_pada)
          VALUES (:email, :nama, :jurusan, :umur, :jk, NOW(), NOW())";
            $stRes = $db->prepare($sqlRes);
            $stRes->execute([
                ':email'      => $email,
                ':nama'       => $nama,
                ':jurusan'    => $asal,   // ← asal
                ':umur'       => $umur,
                ':jk'         => $jk,
            ]);
            $idResponden = (int)$db->lastInsertId();

            // 2) simpan jawaban header
            $sqlJawab = "INSERT INTO jawaban (id_survei, id_responden, waktu_kirim)
                     VALUES (:id_survei, :id_responden, NOW())";
            $stJawab = $db->prepare($sqlJawab);
            $stJawab->execute([
                ':id_survei'    => $idSurvei,
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
            $_SESSION['alertError'] = 'Terjadi kesalahan saat menyimpan. Silakan coba lagi.';
            header('Location: /webqual/survei');
            return;
        }
    }



    public function thanks()
    {
        View::render('home/layout/user', 'home/survei/thanks');
    }
}
