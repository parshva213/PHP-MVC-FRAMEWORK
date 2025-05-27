<?php
/**
 * Migrations Script
 * 
 * Author: Parsh
 * Date: 9/5/2025
 * Time: 11:30 AM
 */

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;
use core\Application;

// Load environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'] ?? '',
        'user' => $_ENV['DB_USER'] ?? '',
        'password' => $_ENV['DB_PASSWORD'] ?? ''
    ]
];

// Initialize the application
$app = new Application(__DIR__, $config);

// Apply migrations// Apply migrations
$app->db->applyMigrations();

?>?>