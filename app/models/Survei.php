<?php

class Survei extends BaseModel
{
    public function __construct()
    {
        parent::__construct('survei'); // tabel utama
    }

    /** Ambil 1 survei yang statusnya 'berjalan' dan sedang dalam rentang tanggal aktif */
    public function getRunning()
    {
        $sql = "SELECT * FROM {$this->table}
                WHERE status='berjalan' AND NOW() BETWEEN tanggal_mulai AND tanggal_selesai
                ORDER BY tanggal_mulai DESC
                LIMIT 1";
        $st = $this->connection->prepare($sql);
        $st->execute();
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    /** Hitung jumlah respons (tabel: jawaban) untuk satu survei */
    public function countResponses($id_survei)
    {
        $sql = "SELECT COUNT(*) AS total FROM jawaban WHERE id_survei = :id";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_survei, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch(PDO::FETCH_ASSOC);
        return (int)($row['total'] ?? 0);
    }

    /** Ambil daftar id_pertanyaan yang dipakai di survei sesuai urutan_tampil */
    public function getQuestionIds($id_survei)
    {
        $sql = "SELECT sp.id_pertanyaan
                FROM survei_pertanyaan sp
                WHERE sp.id_survei = :id
                ORDER BY sp.urutan_tampil ASC";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_COLUMN);
    }

    /** Ambil item pertanyaan lengkap + info dimensi untuk 1 survei (buat render form) */
    // models/Survei.php
    public function getItemsWithDimension($id_survei)
    {
        $sql = "SELECT
                p.id_pertanyaan,
                p.kode_pertanyaan,
                p.teks_pertanyaan,
                d.id_dimensi,
                d.nama_dimensi,
                d.kode_dimensi,
                sp.urutan_tampil
            FROM survei_pertanyaan sp
            INNER JOIN pertanyaan p ON p.id_pertanyaan = sp.id_pertanyaan
            INNER JOIN dimensi d    ON d.id_dimensi    = p.id_dimensi
            WHERE sp.id_survei = :id
            ORDER BY d.id_dimensi ASC, sp.urutan_tampil ASC, p.kode_pertanyaan ASC";
        $st  = $this->connection->prepare($sql);
        $st->bindValue(':id', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }


    /**
     * Ringkasan per dimensi: rata_harapan, rata_jawaban, wqi_unit (0..1)
     * WQI unit = AVG(harapan*jawaban) / (AVG(harapan) * 5)
     */
    public function getSummaryByDimension($id_survei)
    {
        $sql = "
            SELECT
                d.id_dimensi,
                d.nama_dimensi,
                ROUND(AVG(dj.harapan), 3) AS rata_harapan,
                ROUND(AVG(dj.jawaban),  3) AS rata_jawaban,
                ROUND(AVG(dj.harapan * dj.jawaban) / NULLIF(AVG(dj.harapan) * 5, 0), 3) AS wqi_unit
            FROM detail_jawaban dj
            INNER JOIN jawaban j    ON j.id_jawaban = dj.id_jawaban AND j.id_survei = :id
            INNER JOIN pertanyaan p ON p.id_pertanyaan = dj.id_pertanyaan
            INNER JOIN dimensi d    ON d.id_dimensi    = p.id_dimensi
            GROUP BY d.id_dimensi, d.nama_dimensi
            ORDER BY d.id_dimensi ASC
        ";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }
}
