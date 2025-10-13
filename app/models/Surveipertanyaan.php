<?php
class SurveiPertanyaan extends BaseModel
{
    public function __construct()
    {
        parent::__construct('survei_pertanyaan');
    }

    /** Daftar id_pertanyaan sesuai urutan tampil */
    public function getQuestionIds(int $id_survei): array
    {
        $sql = "SELECT id_pertanyaan FROM {$this->table}
                WHERE id_survei = :id
                ORDER BY urutan_tampil ASC";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll(PDO::FETCH_COLUMN);
    }

    /** Item lengkap buat render form */
    public function getItemsWithDimension(int $id_survei): array
    {
        $sql = "SELECT
                  p.id_pertanyaan, p.kode_pertanyaan, p.teks_pertanyaan,
                  d.id_dimensi, d.nama_dimensi, d.kode_dimensi,
                  sp.urutan_tampil
                FROM {$this->table} sp
                INNER JOIN pertanyaan p ON p.id_pertanyaan = sp.id_pertanyaan
                INNER JOIN dimensi d    ON d.id_dimensi    = p.id_dimensi
                WHERE sp.id_survei = :id
                ORDER BY sp.urutan_tampil ASC";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':id', $id_survei, PDO::PARAM_INT);
        $st->execute();
        return $st->fetchAll();
    }

    /** Tambah mapping satu butir ke survei pada urutan tertentu */
    public function addMapping(int $id_survei, int $id_pertanyaan, int $urutan)
    {
        $data = [
            'id_survei'     => $id_survei,
            'id_pertanyaan' => $id_pertanyaan,
            'urutan_tampil' => $urutan,
        ];
        $this->insert($data);
    }

    /** Hapus semua mapping untuk satu survei (mis. reset) */
    public function deleteBySurvei(int $id_survei)
    {
        $this->delete('id_survei', $id_survei);
    }

    /** Reorder (set urutan baru) */
    public function setOrder(int $id_survei, int $id_pertanyaan, int $urutan_baru)
    {
        $this->update(['urutan_tampil' => $urutan_baru], 'id_survei', $id_survei);
        // Catatan: jika perlu tepat ke baris unik, gunakan PK gabungan:
        // Buat query manual:
        $sql = "UPDATE {$this->table} SET urutan_tampil = :u
                WHERE id_survei = :s AND id_pertanyaan = :p";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':u', $urutan_baru, PDO::PARAM_INT);
        $st->bindParam(':s', $id_survei, PDO::PARAM_INT);
        $st->bindParam(':p', $id_pertanyaan, PDO::PARAM_INT);
        $st->execute();
    }
}
