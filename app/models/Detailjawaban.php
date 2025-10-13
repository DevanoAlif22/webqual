<?php
class DetailJawaban extends BaseModel
{
    public function __construct()
    {
        parent::__construct('detail_jawaban');
    }

    /** Bulk insert (opsional dipakai saat submit) */
    public function bulkInsert(int $id_jawaban, array $pairs)
    {
        // $pairs = [ [id_pertanyaan => int, 'harapan' => 1..5, 'jawaban' => 1..5], ... ]
        $sql = "INSERT INTO {$this->table} (id_jawaban, id_pertanyaan, harapan, jawaban)
                VALUES (:j, :p, :h, :a)";
        $st  = $this->connection->prepare($sql);
        foreach ($pairs as $row) {
            $st->bindValue(':j', $id_jawaban, PDO::PARAM_INT);
            $st->bindValue(':p', $row['id_pertanyaan'], PDO::PARAM_INT);
            $st->bindValue(':h', $row['harapan'], PDO::PARAM_INT);
            $st->bindValue(':a', $row['jawaban'], PDO::PARAM_INT);
            $st->execute();
        }
    }

    /** Statistik per pertanyaan (opsional) */
    public function getStatsPerPertanyaan(int $id_survei)
    {
        $sql = "
          SELECT
            p.id_pertanyaan, p.kode_pertanyaan, p.teks_pertanyaan,
            d.nama_dimensi,
            ROUND(AVG(dj.harapan), 3) AS rata_harapan,
            ROUND(AVG(dj.jawaban),  3) AS rata_jawaban
          FROM detail_jawaban dj
          INNER JOIN jawaban j    ON j.id_jawaban = dj.id_jawaban AND j.id_survei = :id
          INNER JOIN pertanyaan p ON p.id_pertanyaan = dj.id_pertanyaan
          INNER JOIN dimensi d    ON d.id_dimensi    = p.id_dimensi
          GROUP BY p.id_pertanyaan, p.kode_pertanyaan, p.teks_pertanyaan, d.nama_dimensi
          ORDER BY d.id_dimensi, p.id_pertanyaan
        ";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }
}
