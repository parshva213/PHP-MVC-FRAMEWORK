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
use controllers\UserController;
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

$app->router->get('/', [SiteController::class, 'Home']);
$app->router->get('/contact', [SiteController::class, 'Contact']);
$app->router->post('/contact', [SiteController::class, 'Contact']);
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [SiteController::class, 'logout']);
$app->router->post('/profile', [SiteController::class, 'profile']);
$app->router->get('/profile', [SiteController::class, 'profile']);
$app->router->get('/givePermission', [UserController::class, 'givePermission']);
$app->router->post('/giveAccess', [UserController::class, 'giveAccess']);
$app->router->get('/giveAccess', [UserController::class, 'giveAccess']);
$app->router->get('/usersview', [UserController::class, 'userview']);
$app->router->get('/cpass', [SiteController::class, 'cpass']);
$app->router->post('/cpass', [SiteController::class, 'cpass']);
$app->router->get('/forget-password', [AuthController::class, 'fpass']);
$app->router->post('/forget-password', [AuthController::class, 'fpass']);
$app->run();
