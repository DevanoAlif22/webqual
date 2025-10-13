<?php
class HasilWqi extends BaseModel
{
    public function __construct()
    {
        parent::__construct('hasil_wqi');
    }

    /** Upsert sederhana berdasarkan (id_survei, id_dimensi) unik */
    public function upsert(array $data)
    {
        // Pastikan ada unique key (id_survei, id_dimensi) di DB untuk aman, atau lakukan manual cek
        $cek = $this->getExisting($data['id_survei'], $data['id_dimensi']);
        if ($cek) {
            $this->update($data, 'id_hasil', $cek['id_hasil']);
        } else {
            $this->insert($data);
        }
    }

    public function getExisting(int $id_survei, ?int $id_dimensi)
    {
        $sql = "SELECT * FROM {$this->table}
                WHERE id_survei = :s AND " . ($id_dimensi === null ? "id_dimensi IS NULL" : "id_dimensi = :d") . " LIMIT 1";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':s', $id_survei, PDO::PARAM_INT);
        if ($id_dimensi !== null) $st->bindParam(':d', $id_dimensi, PDO::PARAM_INT);
        $st->execute();
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function listBySurvei(int $id_survei)
    {
        return $this->getAllById('id_survei', $id_survei);
    }
}
