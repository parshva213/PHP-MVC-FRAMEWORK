<?php

namespace models;

use core\Application;
use core\DbModel;
use models\User;

class LoginForm extends DbModel
{
    public string $username = "";
    public string $password = "";

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
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max' => 24], self::RULE_PASSWORD_NOT_VERIFY]
        ];
    }

    public static function primaryKey(): string
    {
        return Application::$user->primaryKey();
    }

    public static function tableNAME(): string
    {
        return 'users'; // Replace with the actual table name if needed
    }

    public function attributes(): array
    {
        return ['username', 'password']; // Replace with the actual attributes if needed
    }

    public function login()
    {
        $user = (new User())->findOne(['username' => $this->username]);
        if (!$user) {
            $this->addError('username', self::RULE_USER_NOT_FOUND);
            return false;
        }

        if (!($this->password === $user->password)) {
            $this->addError('password', self::RULE_PASSWORD_NOT_VERIFY);
            return false;
        }

        return Application::$app->login($user);

    }
    
}

?>