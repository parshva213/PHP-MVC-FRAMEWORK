<?php

namespace models;

use core\Application;
use core\DbModel;
use PDO;

class ProfileForm extends DbModel
{
    public int $id;
    const STASTUS_INACTIVE = 0;
    const STASTUS_ACTIVE = 1;
    const STASTUS_DELETED = 2;

    const ROLE_OWNER = 'o';
    const ROLE_MANUFACTURER = 'm';
    const ROLE_SUPPLIER = 's';
    const ROLE_CUSTOMER = 'c';

    public string $statement = "";

    public string $firstName = "";
    public string $lastName = "";
    public string $username = "";
    public string $current_password = "";
    public string $password = "";
    public string $conform_password = "";
    public string $user_type = "";
    public string $email = "";
    public string $contact = "";
    public string $address = "";
    public int $status = SELF::STASTUS_ACTIVE; // Default to 'active'
    public string $user_created_on = "";   // Let MySQL handle this, but define to avoid warnings

    public function __construct()
    {
        // Initialize $id from the session or current user if available
        $this->id = Application::$app->session->get('user');

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
            $this->contact = trim($_POST['contact']);
        if (isset($_POST['address']))
            $this->address = trim($_POST['address']);
    }

    public function submit(): bool
    {
        return false;
    }

    public function fetch()
    {
        $db = Application::$app->db->pdo;

        $user = $db->query("SELECT * FROM ausers where uid = $this->id")->fetchAll(PDO::FETCH_ASSOC);
        $user = $user[0];
        $this->firstName = $user['firstname'];
        $this->lastName = $user['lastname'];
        $this->username = $user['username'];
        $this->user_type = $user['user_type'];
        $this->email = $user['email'];
        $this->address = $user['address'];

        $usercon = $db->query("Select * from usercon where uid = $this->id")->fetchAll(PDO::FETCH_ASSOC);
        $contact = $usercon[0]['contact'];
        $con = str_replace(['+91', '-'], '', $contact);
        $this->contact = $con;
    }

    public function rules(): array
    {
        // Define your validation rules here
        return [
            'firstName' => [self::RULE_REQUIRED],
            'lastName' => [self::RULE_REQUIRED],
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
            'conform_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            'user_type' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'contact' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 15], [self::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'contact', 'tables' => ['causers', 'usercon']]],
            'address' => [self::RULE_REQUIRED],
        ];
    }

    public static function tableNAME(): string
    {
        return 'ausers'; // Replace with the actual table name if needed
    }

    public function attributes(): array
    {
        return [[
            'firstName',
            'lastName',
            'username',
            'password',
            'conform_password',
            'user_type',
            'email',
            'address',
            'status',
            'user_created_on'
        ], ['contact']];
    }
    public static function primaryKey(): string
    {
        return "uid";
    }
    public function getDisplayName(): string
    {
        return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
    }
    public function isAdmin(): bool
    {
        $user = Application::$app->user;
        if ($user && $this->user_type === self::ROLE_OWNER) {
            return true;
        }
        return false;
    }
}
