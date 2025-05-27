<?php

namespace core;

use core\Model;

abstract class DbModel extends Model
{

    abstract public static function tableNAME(): string;

    abstract public function attributes(): array;
    abstract public static function primaryKey(): string;
    abstract public function getDisplayName(): string;
    abstract public function isAdmin(): bool;



    public function save()
    {
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

    public static function findOne(array $where): ?self
    {
        $tableName = static::tableNAME();
        $attributes = array_keys($where);
        $sql = "SELECT * FROM $tableName WHERE " . implode(" AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = Application::$app->db->pdo->prepare($sql);

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }

        $statement->execute();
        $record = $statement->fetchObject(static::class);

        return $record === false ? null : $record;
    }
}
