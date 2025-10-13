<?php

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    /** Halaman login (GET) */
    public function login_page()
    {
        session_start();
        // Jika sudah login, langsung lempar ke dashboard/admin page
        if (!empty($_SESSION['admin'])) {
            header('Location: /sertifikasi-latihan3/survei');
            return;
        }
        View::render('home/layout/auth', 'home/auth/login');
    }

    /** Proses login (POST) */
    public function create_session()
    {
        // Validasi method
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /sertifikasi-latihan3/login');
            return;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        session_start();

        // Cari user admin berdasarkan username
        // Bisa pakai getById('username', ...) dari BaseModel, atau findByUsername() jika sudah ada.
        $user = (new User())->getById('username', $username);

        if (!$user) {
            $_SESSION['alertError'] = 'Username tidak ditemukan!';
            header('Location: /sertifikasi-latihan3/login');
            return;
        }

        // Verifikasi password hash (bcrypt)
        if (!password_verify($password, $user['password'])) {
            $_SESSION['alertError'] = 'Password salah!';
            header('Location: /sertifikasi-latihan3/login');
            return;
        }

        // Set session admin (disesuaikan agar View::checkAdmin() bisa mengenali)
        $_SESSION['admin'] = [
            'id_user'  => $user['id_user'],
            'username' => $user['username'],
        ];
        // (opsional) kompatibilitas jika ada check lain:
        $_SESSION['user'] = [
            'id'       => $user['id_user'],
            'username' => $user['username'],
            'role'     => 'admin',
        ];

        // Redirect ke halaman admin utama (ubah sesuai preferensi)
        header('Location: /sertifikasi-latihan3/survei');
        return;
    }

    /** Logout */
    public function delete_session()
    {
        session_start();
        session_destroy();
        header('Location: /sertifikasi-latihan3/login');
        return;
    }
}
