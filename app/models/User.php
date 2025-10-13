<?php
class User extends BaseModel
{
    public function __construct()
    {
        parent::__construct('user'); // tabel admin
    }

    public function findByUsername(string $username)
    {
        $sql = "SELECT * FROM {$this->table} WHERE username = :u LIMIT 1";
        $st  = $this->connection->prepare($sql);
        $st->bindParam(':u', $username);
        $st->execute();
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function createWithHash(string $username, string $plainPassword)
    {
        $hash = password_hash($plainPassword, PASSWORD_BCRYPT);
        $this->insert([
            'id_user'        => null,
            'username'       => $username,
            'password'       => $hash,
            'dibuat_pada'    => date('Y-m-d H:i:s'),
            'diperbarui_pada' => date('Y-m-d H:i:s'),
        ]);
    }
}
