<?php

namespace core;

use core\Model;

abstract class DbModel extends Model
{

    abstract public static function tableNAME(): string;

    abstract public function attributes(): array;
    abstract public static function primaryKey(): string;


    public function save() {
        $db = Application::$app->db->pdo;
        $tableName = $this->tableNAME();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $sql = "INSERT INTO $tableName (" . implode(',', $attributes) . ") VALUES (" . implode(',', $params) . ")";
        $statement = $db->prepare($sql);
        foreach ($attributes as $a) {
            $statement->bindValue(":$a", $this->{$a});
        }
        return $statement->execute();
    }

    
}


?>