<?php

use core\Application;

class m0001_initial {
    public function up() {
        $db = Application::$app->db;
        $SQL = "
CREATE TABLE IF NOT EXISTS raw_product (
    product_id INT PRIMARY KEY AUTO_INCREMENT,
    uploaded_by INT,
    product_name VARCHAR(100),
    product_type VARCHAR(100),
    description VARCHAR(250),
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (uploaded_by) REFERENCES ausers(uid)
) ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);
        echo "Migration applied: Created 'raw_product' table." . PHP_EOL;
    }

    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS raw_product;";
        $db->pdo->exec($SQL);
        echo "Migration rolled back: Dropped 'raw_product' table." . PHP_EOL;
    }
}

?>