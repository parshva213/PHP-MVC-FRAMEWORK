<?php

namespace models;

use core\Application;
use core\DbModel;
use models\User;

class LoginForm extends DbModel
{
    public string $firstname = "";
    public string $lastname = "";
    public string $username = "";
    public string $password = "";
    public string $user_type = "";
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public function __construct()
    {
        if (isset($_POST['username']))
            $this->username = trim($_POST['username']);
        if (isset($_POST['password']))
            $this->password = trim($_POST['password']);
    }

    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED, self::RULE_USER_NOT_FOUND],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24], self::RULE_PASSWORD_NOT_VERIFY]
        ];
    }

    public static function primaryKey(): string
    {
        return "uid";
    }

    public static function tableName(): string
    {
        return 'ausers'; // Replace with the actual table name if needed
    }


    public static function findOne(array $where): ?self
    {
        return parent::findOne($where);
    }
    public function attributes(): array
    {
        return ['username', 'password']; // Replace with the actual attributes if needed
    }

    public function login()
    {
        $user = $this->findOne(['username' => $this->username]);
        if (!$user) {
            $this->addError('username', self::RULE_USER_NOT_FOUND);
            return false;
        }

        if (!($this->password === $user->password)) {
            $this->addError('password', self::RULE_PASSWORD_NOT_VERIFY);
            return false;
        }

        if ($user->status === self::STATUS_ACTIVE) {
            $this->addError('username', self::RULE_ACTIVATION);
            return false;
        }

        return Application::$app->login($user);
    }

    public function getDisplayName(): string
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    public function isAdmin(): bool
    {
        $user = Application::$app->user;
        if ($user && $this->user_type === User::ROLE_OWNER) {
            return true;
        }
        return false;
    }
}
