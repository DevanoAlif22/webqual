<?php

class BaseModel
{
    protected $connection;
    protected $table;

    function __construct($table)
    {
        $this->connection = Database::getConnection();
        $this->table = $table;
    }

    public function getAll()
    {
        $query = "SELECT * FROM $this->table";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getById($identifier, $id)
    {
        $query = "SELECT * FROM $this->table WHERE $identifier = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch();
    }

    public function getAllById($identifier, $id)
    {
        $query = "SELECT * FROM $this->table WHERE $identifier = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function insert($data)
    {
        $query = "INSERT INTO $this->table VALUES (";
        foreach ($data as $key => $value) {
            $query .= ":$key, ";
        }
        $query = substr($query, 0, -2);
        $query .= ")";
        $statement = $this->connection->prepare($query);
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
    }

    public function update($data, $identifier, $id)
    {
        $query = "UPDATE $this->table SET ";
        foreach ($data as $key => $value) {
            $query .= "$key = :$key, ";
        }
        $query = substr($query, 0, -2);
        $query .= " WHERE $identifier = :id";
        $statement = $this->connection->prepare($query);
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    public function delete($identifier, $id)
    {
        $query = "DELETE FROM $this->table WHERE $identifier = :id";
        $statement = $this->connection->prepare($query);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    // Responden.php
    public function getByMultiple($conds)
    {
        $where = [];
        foreach ($conds as $k => $v) {
            $where[] = "$k=:$k";
        }
        $sql = "SELECT * FROM $this->table WHERE " . implode(' AND ', $where) . " LIMIT 1";
        $st = $this->connection->prepare($sql);
        foreach ($conds as $k => $v) {
            $st->bindValue(":$k", $v);
        }
        $st->execute();
        return $st->fetch();
    }

    // Dimensi.php
    public function getAllOrdered()
    {
        $st = $this->connection->prepare("SELECT * FROM $this->table ORDER BY id_dimensi ASC");
        $st->execute();
        return $st->fetchAll();
    }

    // Pertanyaan.php
    public function getAktifByDimensi($id_dimensi)
    {
        $st = $this->connection->prepare("SELECT * FROM $this->table WHERE id_dimensi=:d AND aktif=1 ORDER BY kode_pertanyaan ASC");
        $st->bindValue(':d', $id_dimensi, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }

    // Jawaban.php
    public function getForMatrix($id_survei, $tipe = 'penilaian')
    {
        $kolom = ($tipe === 'harapan') ? 'dj.harapan' : 'dj.jawaban';
        $sql = "SELECT j.id_responden, dj.id_pertanyaan, $kolom AS nilai
                FROM jawaban j
                INNER JOIN detail_jawaban dj ON dj.id_jawaban = j.id_jawaban
                WHERE j.id_survei = :s";
        $st = $this->connection->prepare($sql);
        $st->bindValue(':s', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }
    public function getBySurvei(int $id_survei)
    {
        $sql = "SELECT r.*
                FROM responden r
                INNER JOIN jawaban j ON j.id_responden = r.id_responden
                WHERE j.id_survei = :s
                ORDER BY j.waktu_kirim DESC";
        $st = $this->connection->prepare($sql);
        $st->bindValue(':s', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }

    public function getRataRataPerPertanyaan($id_survei)
    {
        $sql = "
            SELECT 
                p.id_pertanyaan,
                p.id_dimensi,
                p.kode_pertanyaan,
                AVG(dj.jawaban) AS avg_jawaban,
                AVG(dj.harapan) AS avg_harapan
            FROM jawaban j
            JOIN detail_jawaban dj ON dj.id_jawaban = j.id_jawaban
            JOIN pertanyaan p ON p.id_pertanyaan = dj.id_pertanyaan
            WHERE j.id_survei = :s
            GROUP BY p.id_pertanyaan, p.id_dimensi, p.kode_pertanyaan
            ORDER BY p.id_dimensi, p.kode_pertanyaan ASC
        ";
        $st = $this->connection->prepare($sql);
        $st->bindValue(':s', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }
    public function getRingkasanResponden(int $id_survei, int $id_responden): array
    {
        $sql = "
            SELECT 
                d.nama_dimensi,
                p.kode_pertanyaan,
                p.teks_pertanyaan,
                dj.harapan,
                dj.jawaban
            FROM jawaban j
            INNER JOIN detail_jawaban dj ON dj.id_jawaban = j.id_jawaban
            INNER JOIN pertanyaan p      ON p.id_pertanyaan = dj.id_pertanyaan
            INNER JOIN dimensi d         ON d.id_dimensi   = p.id_dimensi
            WHERE j.id_survei = :s AND j.id_responden = :r
            ORDER BY p.id_dimensi ASC, p.kode_pertanyaan ASC
        ";
        $st = $this->connection->prepare($sql);
        $st->bindValue(':s', $id_survei, PDO::PARAM_INT);
        $st->bindValue(':r', $id_responden, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }
    public function attach(int $id_survei, int $id_pertanyaan)
    {
        $sqlOrder = "SELECT COALESCE(MAX(urutan_tampil), 0) + 1 AS next_no
                     FROM survei_pertanyaan
                     WHERE id_survei = :s";
        $st = $this->connection->prepare($sqlOrder);
        $st->execute([':s' => $id_survei]);
        $next = (int)$st->fetchColumn();

        $sql = "INSERT INTO survei_pertanyaan (id_survei, id_pertanyaan, urutan_tampil)
                VALUES (:s, :p, :u)";
        $st2 = $this->connection->prepare($sql);
        $st2->execute([
            ':s' => $id_survei,
            ':p' => $id_pertanyaan,
            ':u' => $next,
        ]);
    }
    public function getLastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}
