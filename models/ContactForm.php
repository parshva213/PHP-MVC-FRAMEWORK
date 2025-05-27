<?php

namespace models;

use core\Application;
use core\Model;
use core\Session;

class ContactForm extends Model
{
    public Session $session;

    public string $subject = "";
    public string $email = "";
    public string $body = "";
    public string $name = "";
    public string $check = "";
    public string $submit = "submit";
    public array $array = [];

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
            'subject' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>5], [self::RULE_MAX, 'max'=>100]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>20]],
            'name' => [self::RULE_REQUIRED]
        ];
        return $array;
    }

    public function submit(): bool
    {
        $this->resetFields();
            return true;
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
        $this->check = "";
        $this->submit = "submit";
    }
}
?>