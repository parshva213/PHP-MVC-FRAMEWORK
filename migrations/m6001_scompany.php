<?php

use core\Application;

class m0001_initial {
    public function up() {
        $db = Application::$app->db;
        $SQL = "
CREATE TABLE IF NOT EXISTS scompany (
    company_id INT PRIMARY KEY AUTO_INCREMENT,
    uid INT,
    company_name VARCHAR(100),
    company_address VARCHAR(255),
    company_created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uid) REFERENCES ausers(uid)
) ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);
        echo "Migration applied: Created 'scompany' table." . PHP_EOL;
    }

    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS scompany;";
        $db->pdo->exec($SQL);
        echo "Migration rolled back: Dropped 'scompany' table." . PHP_EOL;
    }
}

?>