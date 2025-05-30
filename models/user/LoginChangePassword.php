<?php

namespace muser;

use core\Application;
use cuser\UpdateUser;
use PDO;

class LoginChangePassword extends UpdateUser
{
    public int $id;

    public array $rule = [
        'current_password' => [self::RULE_REQUIRED],
        'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
        'conform_password' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
    ];

    public string $user_password = "";  // hashed password from DB
    public string $current_password = "";
    public string $password = "";
    public string $conform_password = "";

    public function __construct()
    {
        $this->id = Application::$app->session->get('user');

        $this->current_password = trim($_POST['current_password'] ?? '');
        $this->password = trim($_POST['password'] ?? '');
        $this->conform_password = trim($_POST['conform_password'] ?? '');
    }

    public function fetch()
    {
        $db = Application::$app->db->pdo;
        $stmt = $db->prepare("SELECT password FROM ausers WHERE uid = :uid");
        $stmt->bindValue(':uid', $this->id);
        $stmt->execute();
        $this->user_password = $stmt->fetchColumn(); // Get hashed password
    }

    public function rules(): array
    {
        return $this->rule;
    }

    public static function tableNAME(): string
    {
        return 'ausers';
    }

    public function attributes(): array
    {
        return [
            'password'
        ];
    }

    public static function primaryKey(): string
    {
        return 'uid';
    }

    public function verification(): bool
    {
        $this->fetch();

        // Check if current_password matches the hashed password
        if (md5($this->current_password) !== $this->user_password) {
            $this->addError('current_password', self::RULE_MATCH, ['match' => 'stored password']);
            return false;
        }

        return true;
    }

    public function save(): bool
    {
        $db = Application::$app->db->pdo;

        // Hash new password before saving
        $hashed = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("UPDATE ausers SET password = :password WHERE uid = :uid");
        $stmt->bindValue(':password', $hashed);
        $stmt->bindValue(':uid', $this->id);

        if ($stmt->execute()) {
            $this->current_password = $this->password = $this->conform_password = "";
            return true;
        }
        return false;
    }
}
