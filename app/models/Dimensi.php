<?php
class Dimensi extends BaseModel
{
    public function __construct()
    {
        parent::__construct('dimensi');
    }

    public function getByKode(string $kode)
    {
        $sql = "SELECT * FROM {$this->table} WHERE kode_dimensi = :kode LIMIT 1";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':kode', $kode);
        $st->execute();
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function options() // untuk dropdown
    {
        $sql = "SELECT id_dimensi, nama_dimensi FROM {$this->table} ORDER BY id_dimensi ASC";
        $st  = $this->connection->prepare($sql);
        $st->execute();
        return $st->fetchAll();
    }
}
