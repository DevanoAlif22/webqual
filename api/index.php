<?php
// api/index.php

// Tentukan base path project (1 level di atas /api)
define('BASE_PATH', dirname(__DIR__));

// Autoload manual (versi sederhana)
require_once BASE_PATH . '/app/Core/Database.php';
require_once BASE_PATH . '/app/Core/View.php';
require_once BASE_PATH . '/app/Core/Router.php';
require_once BASE_PATH . '/app/models/BaseModel.php';
require_once BASE_PATH . '/app/models/User.php';

require_once BASE_PATH . '/app/controllers/SurveiController.php';
require_once BASE_PATH . '/app/controllers/SurveiFormController.php';
require_once BASE_PATH . '/app/controllers/DimensiController.php';
require_once BASE_PATH . '/app/controllers/PertanyaanController.php';
require_once BASE_PATH . '/app/controllers/AuthController.php';
require_once BASE_PATH . '/app/controllers/RespondenController.php';
require_once BASE_PATH . '/app/controllers/JawabanController.php';
require_once BASE_PATH . '/app/controllers/HasilwqiController.php';

// ========= Routing =========
// Jangan pakai PATH_INFO; gunakan REQUEST_URI agar aman di Vercel
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

// Definisikan route persis seperti sebelumnya
// auth
Router::add_get('/login', AuthController::class, 'login_page');
Router::add_post('/login', AuthController::class, 'create_session');
Router::add_get('/logout', AuthController::class, 'delete_session');
Router::add_get('/register', AuthController::class, 'register_page');
Router::add_post('/register', AuthController::class, 'insert');

// admin – survei
Router::add_get('/admin/survei', SurveiController::class, 'index');
Router::add_get('/admin/survei-create', SurveiController::class, 'create');
Router::add_post('/admin/survei/store', SurveiController::class, 'store');
Router::add_get('/admin/survei-edit', SurveiController::class, 'edit');
Router::add_post('/admin/survei/update', SurveiController::class, 'update');
Router::add_get('/admin/survei-show', SurveiController::class, 'show');
Router::add_post('/admin/survei/delete', SurveiController::class, 'delete');

// admin – dimensi
Router::add_get('/admin/dimensi', DimensiController::class, 'index');
Router::add_get('/admin/dimensi-create', DimensiController::class, 'create');
Router::add_post('/admin/dimensi/store', DimensiController::class, 'store');
Router::add_get('/admin/dimensi-edit', DimensiController::class, 'edit');
Router::add_post('/admin/dimensi/update', DimensiController::class, 'update');
Router::add_get('/admin/dimensi-show', DimensiController::class, 'show');
Router::add_post('/admin/dimensi/delete', DimensiController::class, 'delete');

// responden & jawaban
Router::add_get('/admin/responden', RespondenController::class, 'index');
Router::add_get('/admin/responden-show', RespondenController::class, 'show');
Router::add_post('/admin/responden/delete', RespondenController::class, 'delete');
Router::add_get('/admin/jawaban', JawabanController::class, 'index');

// pertanyaan
Router::add_get('/admin/pertanyaan', PertanyaanController::class, 'index');
Router::add_get('/admin/pertanyaan-create', PertanyaanController::class, 'create');
Router::add_post('/admin/pertanyaan/store', PertanyaanController::class, 'store');
Router::add_get('/admin/pertanyaan-edit', PertanyaanController::class, 'edit');
Router::add_post('/admin/pertanyaan/update', PertanyaanController::class, 'update');
Router::add_get('/admin/pertanyaan-show', PertanyaanController::class, 'show');
Router::add_post('/admin/pertanyaan/delete', PertanyaanController::class, 'delete');

// survei publik
Router::add_get('/survei', SurveiFormController::class, 'form');
Router::add_post('/survei/submit', SurveiFormController::class, 'submit');
Router::add_get('/survei/thanks', SurveiFormController::class, 'thanks');

// hasil wqi
Router::add_get('/admin/hasil', HasilwqiController::class, 'index');

// Jalankan
Router::run($uri);
