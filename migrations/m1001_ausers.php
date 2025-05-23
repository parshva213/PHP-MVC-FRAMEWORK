<?php

use core\Application;

class m0001_initial {
    public function up() {
        $db = Application::$app->db;
        $SQL = "
CREATE TABLE IF NOT EXISTS ausers (
    uid INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    username VARCHAR(100),
    password VARCHAR(100),
    user_type ENUM('o', 'm', 's', 'c'),
    email VARCHAR(100),
    address TEXT,
    status TINYINT(1),
    user_created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);
        echo "Migration applied: Created 'ausers' table." . PHP_EOL;
    }

    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS ausers;";
        $db->pdo->exec($SQL);
        echo "Migration rolled back: Dropped 'ausers' table." . PHP_EOL;
    }
}

?>