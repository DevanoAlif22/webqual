<?php
class Pertanyaan extends BaseModel
{
    public function __construct()
    {
        parent::__construct('pertanyaan');
    }

    public function getByDimensi(int $id_dimensi)
    {
        return $this->getAllById('id_dimensi', $id_dimensi);
    }

    public function isUsedInAnySurvei(int $id_pertanyaan): bool
    {
        $sql = "SELECT COUNT(*) AS n FROM survei_pertanyaan WHERE id_pertanyaan = :id";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_pertanyaan, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch(PDO::FETCH_ASSOC);
        return (int)($row['n'] ?? 0) > 0;
    }
}
