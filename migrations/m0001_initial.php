<?php

use core\Application;

class m0001_initial {
    public function up() {
        $db = Application::$app->db;
        $SQL = "
            CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                firstName VARCHAR(255) NOT NULL,
                lastName VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                status TINYINT DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);
        echo "Migration applied: Created 'users' table." . PHP_EOL;
    }

    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS users;";
        $db->pdo->exec($SQL);
        echo "Migration rolled back: Dropped 'users' table." . PHP_EOL;
    }
}

?>