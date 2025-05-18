<?php

namespace models;

use core\Application;
use core\DbModel;
use models\User;

class LoginForm extends DbModel
{
    public string $email = "";
    public string $password = "";

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, self::RULE_EMAIL_NOT_FOUND],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>8], [self::RULE_MAX, 'max' => 24], self::RULE_PASSWORD_NOT_FOUND]
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
        return ['email', 'password']; // Replace with the actual attributes if needed
    }

    public function login()
    {
        $user = (new User())->findOne(['email' => $this->email]);
        if ($user){
            // Correct password verification logic
            if (password_verify($this->password, $user->password)) {
                return Application::$app->login($user);
            }
            $this->addError('password', self::RULE_PASSWORD_NOT_FOUND);
            return false; // Stop further execution if password is incorrect
        }
        $this->addError('email', self::RULE_EMAIL_NOT_FOUND);
        return false; // Stop further execution if user not found
    }
    
}

?>