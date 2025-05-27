<?php

use core\Application;

class m0001_initial {
    public function up() {
        $db = Application::$app->db;
        $SQL = "
CREATE TABLE IF NOT EXISTS ugst (
    uid INT,
    gst_no VARCHAR(100) UNIQUE,
    FOREIGN KEY (uid) REFERENCES ausers(uid)
) ENGINE=INNODB;
        ";
        $db->pdo->exec($SQL);
        echo "Migration applied: Created 'ugst' table." . PHP_EOL;
    }

    public function down() {
        $db = Application::$app->db;
        $SQL = "DROP TABLE IF EXISTS ugst;";
        $db->pdo->exec($SQL);
        echo "Migration rolled back: Dropped 'ugst' table." . PHP_EOL;
    }
}

?>