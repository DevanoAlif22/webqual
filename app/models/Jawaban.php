<?php
class Jawaban extends BaseModel
{
    public function __construct()
    {
        parent::__construct('jawaban');
    }

    public function insertAndGetId(array $data): int
    {
        $this->insert($data);
        return (int)$this->connection->lastInsertId();
    }

    public function countBySurvei(int $id_survei): int
    {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE id_survei = :id";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_survei, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch(PDO::FETCH_ASSOC);
        return (int)($row['total'] ?? 0);
    }

    /** Ringkasan untuk halaman hasil (bisa dipanggil dari controller Home) */
    public function getSummaryByDimension(int $id_survei)
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

    /** Detail gabungan satu responden (opsional untuk admin lihat 1 submission) */
    public function getDetailSubmission(int $id_jawaban)
    {
        $sql = "
            SELECT
                p.kode_pertanyaan, p.teks_pertanyaan,
                d.nama_dimensi,
                dj.harapan, dj.jawaban
            FROM detail_jawaban dj
            INNER JOIN pertanyaan p ON p.id_pertanyaan = dj.id_pertanyaan
            INNER JOIN dimensi d    ON d.id_dimensi    = p.id_dimensi
            WHERE dj.id_jawaban = :id
            ORDER BY d.id_dimensi, p.id_pertanyaan
        ";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_jawaban, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }
}
