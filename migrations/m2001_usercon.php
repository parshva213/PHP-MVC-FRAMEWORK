<?php

use core\Application;

class m0001_initial {
    public function up() {
        $db = Application::$app->db;
        $SQL = "
CREATE TABLE IF NOT EXISTS usercon (
    uid INT,
    contact VARCHAR(15),
    FOREIGN KEY (uid) REFERENCES ausers(uid)
) ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);
        echo "Migration applied: Created 'usercon' table." . PHP_EOL;
    }

    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS usercon;";
        $db->pdo->exec($SQL);
        echo "Migration rolled back: Dropped 'usercon' table." . PHP_EOL;
    }
}

?>