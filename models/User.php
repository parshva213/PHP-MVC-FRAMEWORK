<?php
namespace models;

use core\Application;
use core\UserModel;

class User extends UserModel {
    const STASTUS_INACTIVE = 0;
    const STASTUS_ACTIVE = 1;
    const STASTUS_DELETED = 2;

    public string $firstName = "";
    public string $lastName = "";
    public string $email = "";
    public string $password = "";
    public string $conform_password = "";
    public int $status = SELF::STASTUS_INACTIVE; // Default to 'active'
    public string $created_at = "";   // Let MySQL handle this, but define to avoid warnings

    public static function tableNAME(): string
    {
        return 'users';
    }
    

    public static function findOne($where){
        $db = Application::$app->db->pdo;
        $tableName = static::tableNAME();
        $attributes = array_keys($where);
        
        
        $params = implode(" AND ",array_map(fn($a) => "$a = :$a", $attributes));
        $sql="SELECT * FROM $tableName WHERE $params;";

        $statement = $db->prepare($sql);
        foreach($where as $k => $v){
            $statement->bindValue(":$k", $v);
        }
        $statement->execute();
       
        return $statement->fetchObject(static::class);
    }

    public function attributes(): array
    {
        // Only include columns that exist in your table
        return ['firstName', 'lastName', 'email', 'password', 'status'];
        // Remove 'created_at' from here, let MySQL set it automatically
    }

    public function rules(): array {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max' => 24]],
            'conform_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function save() {
        $this->status = self::STASTUS_ACTIVE;
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        return parent::save();
    }

    public static function primaryKey(): string
    {
        return 'id';   
    }

    public function getDisplayName(): string
    {
        return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
    }
}
?>