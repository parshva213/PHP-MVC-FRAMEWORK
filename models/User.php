<?php
namespace models;

use core\Application;
use core\UserModel;
use core\DbModel;

class User extends UserModel {
    public ?int $id = null; // Allow null until it is set
    const STASTUS_INACTIVE = 0;
    const STASTUS_ACTIVE = 1;
    const STASTUS_DELETED = 2;

    public string $firstName = "";
    public string $lastName = "";
    public string $username = "";
    public string $password = "";
    public string $conform_password = "";
    public string $user_type = "";
    public string $email = "";
    public string $address = "";
    public int $status = SELF::STASTUS_ACTIVE; // Default to 'active'
    public string $user_created_on = "";   // Let MySQL handle this, but define to avoid warnings

    public function __construct()
    {
        if (isset($_POST['firstName']))
            $this->firstName = trim($_POST['firstName']);
        if (isset($_POST['lastName']))
            $this->lastName = trim($_POST['lastName']);
        if (isset($_POST['username']))
            $this->username = trim($_POST['username']);
        if (isset($_POST['password']))
            $this->password = trim($_POST['password']);
        if (isset($_POST['conform_password']))
            $this->conform_password = trim($_POST['conform_password']);
        if (isset($_POST['user_type']))
            $this->user_type = trim($_POST['user_type']);
        if (isset($_POST['email']))
            $this->email = trim($_POST['email']);
        if (isset($_POST['address']))
            $this->address = trim($_POST['address']);
    }

    public static function tableNAME(): string
    {
        return 'ausers';
    }
    

    public static function findOne(array $where): ?self
    {
        return parent::findOne($where);
    }

    public function attributes(): array
    {
        // Only include columns that exist in your table
        return ['firstName', 'lastName', 'username', 'password', 'user_type','email', 'address', 'status'];
        // Remove 'created_at' from here, let MySQL set it automatically
    }

    public function rules(): array {
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'username' => [self::RULE_REQUIRED],
            'user_type' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max' => 24]],
            'conform_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    public function save() {
        $this->status = self::STASTUS_ACTIVE;
        $this->password = md5($this->password,PASSWORD_DEFAULT);
        return parent::save();
    }

    public static function primaryKey(): string
    {
        return 'uid'; // Ensure this matches your database schema
    }

    public function getDisplayName(): string
    {
        return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
    }
}
?>