<?php
class Situs extends BaseModel
{
    public function __construct()
    {
        parent::__construct('situs');
    }

    public function getActive()
    {
        $sql = "SELECT * FROM {$this->table} WHERE aktif = 1 ORDER BY id_situs ASC LIMIT 1";
        $st  = $this->connection->prepare($sql);
        $st->execute();
        return $st->fetch(PDO::FETCH_ASSOC);
    }
}
