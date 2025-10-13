<?php

class SurveipertanyaanController
{
    public function __construct()
    {
        session_start();
        if (!View::checkAdmin()) {
            header('Location: /webqual/login');
            return;
        }
    }
}
