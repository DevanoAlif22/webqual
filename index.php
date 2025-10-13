<?php

require_once 'app/Core/Database.php';
require_once 'app/Core/View.php';
require_once 'app/Core/Router.php';
require_once 'app/models/BaseModel.php';
require_once 'app/models/User.php';

require_once 'app/controllers/HomeController.php';
require_once 'app/controllers/SurveiController.php';
require_once 'app/controllers/DimensiController.php';
require_once 'app/controllers/PertanyaanController.php';
// require_once 'app/controllers/UserController.php';
// require_once 'app/controllers/LowonganController.php';
// require_once 'app/controllers/InformasiController.php';

$path = '/';

if (isset($_SERVER['PATH_INFO'])) $path = $_SERVER['PATH_INFO'];


// auth
// Router::add_get('/login', HomeController::class, 'login_page');
// Router::add_post('/login', UserController::class, 'create_session');
// Router::add_get('/register', HomeController::class, 'register_page');
// Router::add_post('/register', UserController::class, 'insert');
// Router::add_get('/logout', UserController::class, 'delete_session');

// Root path


Router::add_get('/admin/survei', SurveiController::class, 'index');
Router::add_get('/admin/survei-create', SurveiController::class, 'create');
Router::add_post('/admin/survei/store', SurveiController::class, 'store');
Router::add_get('/admin/survei-edit', SurveiController::class, 'edit');
Router::add_post('/admin/survei/update', SurveiController::class, 'update');
Router::add_get('/admin/survei-show', SurveiController::class, 'show');
Router::add_post('/admin/survei/delete', SurveiController::class, 'delete');

Router::add_get('/admin/dimensi', DimensiController::class, 'index');
Router::add_get('/admin/dimensi-create', DimensiController::class, 'create');
Router::add_post('/admin/dimensi/store', DimensiController::class, 'store');
Router::add_get('/admin/dimensi-edit', DimensiController::class, 'edit');
Router::add_post('/admin/dimensi/update', DimensiController::class, 'update');
Router::add_get('/admin/dimensi-show', DimensiController::class, 'show');
Router::add_post('/admin/dimensi/delete', DimensiController::class, 'delete');

Router::add_get('/admin/pertanyaan', PertanyaanController::class, 'index');
Router::add_get('/admin/pertanyaan-create', PertanyaanController::class, 'create');
Router::add_post('/admin/pertanyaan/store', PertanyaanController::class, 'store');
Router::add_get('/admin/pertanyaan-edit', PertanyaanController::class, 'edit');
Router::add_post('/admin/pertanyaan/update', PertanyaanController::class, 'update');
Router::add_get('/admin/pertanyaan-show', PertanyaanController::class, 'show');
Router::add_post('/admin/pertanyaan/delete', PertanyaanController::class, 'delete');


Router::run();
