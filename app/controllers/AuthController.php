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
            header('Location: /webqual/survei');
            return;
        }
        View::render('home/layout/auth', 'home/auth/login');
    }

    public function insert()
    {
        $user = new User();
        if ($user->getById('username', $_POST['username'])) {
            session_start();
            $_SESSION['alertError'] = 'Username Sudah Pernah Digunakan!';
            header('Location: /webqual/register');
            return;
        }

        if ($_POST['password'] !== $_POST['confirm_password']) {
            session_start();
            $_SESSION['alertError'] = 'Password dan Confirm Password tidak sama!';
            header('Location: /webqual/register');
            exit;
        }

        $now = date('Y-m-d H:i:s');
        $user->insert([
            'id' => 'DEFAULT',
            'username' => $_POST['username'],
            'user_password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'dibuat_pada'     => $now,
            'diperbarui_pada' => $now,
        ]);
        session_start();

        $_SESSION['alertSuccess'] = 'Berhasil Mendaftar!';
        header('Location: /webqual/login');
        return;
    }

    public function register_page()
    {
        View::render('home/layout/auth', 'home/auth/register');
    }
    /** Proses login (POST) */
    public function create_session()
    {
        // Validasi method
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /webqual/login');
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
            header('Location: /webqual/login');
            return;
        }

        // Verifikasi password hash (bcrypt)
        if (!password_verify($password, $user['password'])) {
            $_SESSION['alertError'] = 'Password salah!';
            header('Location: /webqual/login');
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
        header('Location: /webqual/admin/survei');
        return;
    }

    /** Logout */
    public function delete_session()
    {
        session_start();
        session_destroy();
        header('Location: /webqual/login');
        return;
    }
}
