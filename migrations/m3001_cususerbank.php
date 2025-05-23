<?php

use core\Application;

class m0001_initial {
    public function up() {
        $db = Application::$app->db;
        $SQL = "
CREATE TABLE IF NOT EXISTS cususerbank (
    acc_no VARCHAR(100),
    uid INT,
    bank_name VARCHAR(100),
    FOREIGN KEY (uid) REFERENCES ausers(uid)
) ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);
        echo "Migration applied: Created 'cususerbank' table." . PHP_EOL;
    }

    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS cususerbank;";
        $db->pdo->exec($SQL);
        echo "Migration rolled back: Dropped 'cususerbank' table." . PHP_EOL;
    }
}

?>