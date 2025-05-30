<?php

namespace muser;

use core\Application;
use cuser\updateUser;

class ContactForm extends UpdateUser
{

    public string $subject = "";
    public string $email = "";
    public string $body = "";
    public string $name = "";
    public string $submit = "submit";

    public function __construct()
    {
        if (isset($_POST['body']))
            $this->body = trim($_POST['body']);
        if (isset($_POST['name']))
            $this->name = trim($_POST['name']);
        if (isset($_POST['subject']))
            $this->subject = trim($_POST['subject']);
        if (isset($_POST['email']))
            $this->email = trim($_POST['email']);
    }

    public function rules(): array
    {
        $array = [
            'subject' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 100]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 20]],
            'name' => [self::RULE_REQUIRED]
        ];
        return $array;
    }

    public function submit(): bool
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
        $this->resetFields();
        return $statement->execute();
    }

    /**
     * Resets all form fields to their default values.
     */
    private function resetFields(): void
    {
        $this->subject = "";
        $this->email = "";
        $this->body = "";
        $this->name = "";
        $this->submit = "submit";
    }

    public static function tableNAME(): string
    {
        return 'contact_messages';
    }
    public function attributes(): array
    {
        return [
            'name',
            'subject',
            'body'
        ];
    }
    public static function primaryKey(): string
    {
        return 'id';
    }
}
