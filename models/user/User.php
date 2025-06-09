<?php

namespace muser;

use core\DbModel;
use core\Need;

class User extends DbModel
{

    public ?int $id = null; // Allow null until it is set

    public string $statement = "";

    public string $firstName = "";
    public string $lastName = "";
    public string $username = "";
    public string $password = "";
    public string $conform_password = "";
    public string $user_type = "";
    public string $email = "";
    public string $contact = "";
    public string $address = "";
    public int $status = Need::STASTUS_ACTIVE; // Default to 'active'
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
        if (isset($_POST['contact']))
            $this->address = (int)$_POST['contact'];
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
        return ['firstName', 'lastName', 'username', 'password', 'user_type', 'email', 'address', 'status', 'contact'];
        // Remove 'created_at' from here, let MySQL set it automatically
    }

    public function rules(): array
    {
        return [
            'firstName' => [Need::RULE_REQUIRED],
            'lastName' => [Need::RULE_REQUIRED],
            'username' => [Need::RULE_REQUIRED, [Need::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'username', 'tables' => ['causers', 'ausers']]],
            'user_type' => [Need::RULE_REQUIRED],
            'address' => [Need::RULE_REQUIRED],
            'email' => [Need::RULE_REQUIRED, Need::RULE_EMAIL, [Need::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'email', 'tables' => ['causers', 'ausers']]],
            'password' => [Need::RULE_REQUIRED, [Need::RULE_MIN, 'min' => 8], [Need::RULE_MAX, 'max' => 24]],
            'conform_password' => [Need::RULE_REQUIRED, [Need::RULE_MATCH, 'match' => 'password']],
            'contact' => [Need::RULE_REQUIRED, [Need::RULE_MIN, 'min' => 10], [Need::RULE_MAX, 'max' => 10], [Need::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'contact', 'tables' => ['causers', 'usercon']]],
        ];
    }

    public function save()
    {
        $this->status = Need::STASTUS_ACTIVE;
        $this->firstName = ucfirst($this->firstName);
        $this->lastName = ucfirst($this->lastName);
        $this->password = md5($this->password, PASSWORD_DEFAULT);
        $rawContact = (string) $_POST['contact'];
        $this->contact = '+91 ' . substr($rawContact, 0, 5) . '-' . substr($rawContact, 5);
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

    public function isRole(): string
    {
        return $this->user_type;
    }
}
