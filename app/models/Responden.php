<?php
class Responden extends BaseModel
{
    public function __construct()
    {
        parent::__construct('responden');
    }

    /** Insert lalu kembalikan ID (dibutuhkan saat submit publik) */
    public function insertAndGetId(array $data): int
    {
        $this->insert($data);
        return (int)$this->connection->lastInsertId();
    }

    /** Untuk daftar responden per survei */
    public function getBySurvei(int $id_survei)
    {
        $sql = "SELECT r.*
                FROM jawaban j
                INNER JOIN responden r ON r.id_responden = j.id_responden
                WHERE j.id_survei = :id
                ORDER BY j.waktu_kirim DESC";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }
}
