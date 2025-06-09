<?php

namespace muser;

use core\Application;
use core\DbModel;
use core\Need;

class LoginForm extends DbModel
{
    public string $firstname = "";
    public string $lastname = "";
    public string $username = "";
    public string $password = "";
    public string $user_type = "";

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
            'username' => [Need::RULE_REQUIRED, Need::RULE_USER_NOT_FOUND],
            'password' => [Need::RULE_REQUIRED, [Need::RULE_MIN, 'min' => 8], [Need::RULE_MAX, 'max' => 24], Need::RULE_PASSWORD_NOT_VERIFY]
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
            $this->addError('username', Need::RULE_USER_NOT_FOUND);
            return false;
        }

        if ($this->password !== $user->password) {
            $this->addError('password', Need::RULE_PASSWORD_NOT_VERIFY);
            return false;
        }

        if ($user->status === Need::STASTUS_ACTIVE) {
            $this->addError('username', Need::RULE_ACTIVATION);
            return false;
        }
        return Application::$app->login($user);
    }

    public function getDisplayName(): string
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    public function isRole(): string
    {
        return $this->user_type;
    }
}
