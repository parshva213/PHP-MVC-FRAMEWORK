<?php
/* 
* user: parsh 
* date: 9/5/2025
* time: 11:30 AM 
*/

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use core\Application;
use controllers\SiteController;
use controllers\AuthController;
use controllers\AdminController;
use core\Need;
use muser\LoginForm;

// Check if the script is accessed from a web browser
if (php_sapi_name() !== 'cli-server' && php_sapi_name() !== 'apache2handler') {
    echo "This script is designed to be accessed via a web browser.";
    exit;
}

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => LoginForm::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'] ?? '',
        'user' => $_ENV['DB_USER'] ?? '',
        'password' => $_ENV['DB_PASSWORD'] ?? ''
    ]
];

$app = new Application(dirname(__DIR__), $config);

if ($app->user->isRole() === Need::ROLE_ADMIN) {
    $app->router->post('/adminUserGiveAccess', [AdminController::class, 'usergiveAccess']);
    $app->router->get('/adminGiveLoginPermission', [AdminController::class, 'usergivePermission']);
    $app->router->get('/adminUserGiveAccess', [AdminController::class, 'usergiveAccess']);
    $app->router->get('/adminProductGiveAccess', [AdminController::class, 'productgiveAccess']);
    $app->router->get('/adminUsersview', [AdminController::class, 'userView']);
    $app->router->get('/adminProductList', [AdminController::class, 'productList']);
}

$app->router->get('/', [SiteController::class, 'Home']);
$app->router->post('/contact', [SiteController::class, 'Contact']);
$app->router->post('/profile', [SiteController::class, 'profile']);
$app->router->post('/cpass', [SiteController::class, 'cpass']);
$app->router->get('/contact', [SiteController::class, 'Contact']);
$app->router->get('/logout', [SiteController::class, 'logout']);
$app->router->get('/cpass', [SiteController::class, 'cpass']);
$app->router->get('/profile', [SiteController::class, 'profile']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->get('/forget-password', [AuthController::class, 'fpass']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->post('/forget-password', [AuthController::class, 'fpass']);


$app->run();
