<?php

use core\Application;

class m0001_initial {
    public function up() {
        $db = Application::$app->db;
        $SQL = "
CREATE TABLE IF NOT EXISTS muserbank (
    bank_id INT PRIMARY KEY AUTO_INCREMENT,
    uid INT,
    bank_name VARCHAR(100),
    bank_branch VARCHAR(100),
    bank_ifsc VARCHAR(100),
    acc_no VARCHAR(100),
    acc_hol_name VARCHAR(100),
    FOREIGN KEY (uid) REFERENCES ausers(uid)
) ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);
        echo "Migration applied: Created 'muserbank' table." . PHP_EOL;
    }

    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS muserbank;";
        $db->pdo->exec($SQL);
        echo "Migration rolled back: Dropped 'muserbank' table." . PHP_EOL;
    }
}

?>