<?php
class HasilWqi extends BaseModel
{
    public function __construct()
    {
        parent::__construct('hasil_wqi');
    }

    /**
     * Upsert sederhana berdasarkan (id_survei, id_dimensi).
     * Catatan:
     * - id_dimensi = NULL untuk baris TOTAL (keseluruhan).
     * - Karena UNIQUE (id_survei,id_dimensi) tidak bisa membatasi NULL di MariaDB/MySQL,
     *   kita tetap cek manual via getExisting().
     */
    public function upsert(array $data)
    {
        $cek = $this->getExisting((int)$data['id_survei'], $data['id_dimensi'] === null ? null : (int)$data['id_dimensi']);
        if ($cek) {
            $this->updateExplicit($data, 'id_hasil', (int)$cek['id_hasil']);
        } else {
            $this->insertExplicit($data);
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

    /**
     * Insert dengan column list eksplisit (lebih aman daripada BaseModel::insert()).
     * Wajib isi semua kolom non-nullable (kecuali AUTO_INCREMENT & default).
     *
     * Kolom: id_hasil (AI), id_survei, id_dimensi(NULLable), rata_harapan, rata_jawaban,
     *        skor_maksimal, skor_tertimbang, wqi, interpretasi, dibuat_pada (default)
     */
    public function insertExplicit(array $data): void
    {
        $cols = [
            'id_survei',
            'id_dimensi',
            'rata_harapan',
            'rata_jawaban',
            'skor_maksimal',
            'skor_tertimbang',
            'wqi',
            'interpretasi'
        ];
        $names = implode(',', $cols);
        $binds = implode(',', array_map(fn($c) => ":$c", $cols));

        $sql = "INSERT INTO {$this->table} ($names) VALUES ($binds)";
        $st  = $this->connection->prepare($sql);

        foreach ($cols as $c) {
            $paramType = PDO::PARAM_STR;
            if (in_array($c, ['id_survei', 'id_dimensi'], true)) $paramType = PDO::PARAM_INT;
            $st->bindValue(":$c", $data[$c] ?? null, $data[$c] === null ? PDO::PARAM_NULL : $paramType);
        }
        $st->execute();
    }

    /** Update eksplisit berdasarkan PK */
    public function updateExplicit(array $data, string $identifier, int $id): void
    {
        $cols = [
            'id_survei',
            'id_dimensi',
            'rata_harapan',
            'rata_jawaban',
            'skor_maksimal',
            'skor_tertimbang',
            'wqi',
            'interpretasi'
        ];
        $set = implode(',', array_map(fn($c) => "$c=:$c", $cols));
        $sql = "UPDATE {$this->table} SET $set WHERE $identifier = :id";
        $st  = $this->connection->prepare($sql);

        foreach ($cols as $c) {
            $paramType = PDO::PARAM_STR;
            if (in_array($c, ['id_survei', 'id_dimensi'], true)) $paramType = PDO::PARAM_INT;
            $st->bindValue(":$c", $data[$c] ?? null, $data[$c] === null ? PDO::PARAM_NULL : $paramType);
        }
        $st->bindValue(':id', $id, PDO::PARAM_INT);
        $st->execute();
    }
}
