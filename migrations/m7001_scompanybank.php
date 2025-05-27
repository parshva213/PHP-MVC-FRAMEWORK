<?php

use core\Application;

class m0001_initial {
    public function up() {
        $db = Application::$app->db;
        $SQL = "
CREATE TABLE IF NOT EXISTS scompanybank (
    company_id INT,
    bank_name VARCHAR(100),
    bank_branch VARCHAR(100),
    bank_ifsc VARCHAR(100),
    acc_no VARCHAR(100),
    acc_hol_name VARCHAR(100),
    FOREIGN KEY (company_id) REFERENCES scompany(company_id)
) ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);
        echo "Migration applied: Created 'scompanybank' table." . PHP_EOL;
    }

    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS scompanybank;";
        $db->pdo->exec($SQL);
        echo "Migration rolled back: Dropped 'scompanybank' table." . PHP_EOL;
    }
}

?>