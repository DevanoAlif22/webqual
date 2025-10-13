<?php

class View
{
    public static function render($main, $view, $data = [])
    {
        extract($data);
        $content = "app/views/$view.php";
        require "app/views/$main.php";
    }

    public static function checkAuth()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }
        header('Location: /');
        return false;
    }
    public static function checkLogin()
    {
        if (!isset($_SESSION['user'])) {
            return true;
        }
        header('Location: /');
        return false;
    }

    public static function checkAdmin()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
            return true;
        }
        header('Location: /home');
        return false;
    }
}
