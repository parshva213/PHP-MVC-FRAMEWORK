<?php

namespace models;

use core\Model;

class ContactForm extends Model
{
    public string $subject = "";
    public string $email = "";
    public string $body = "";
    public string $check = "";
    public string $submit = "submit";
    public array $array = [];

    public function __construct()
    {
        if (isset($_POST['body']))
            $this->body = trim($_POST['body']);
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
            'body' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min'=>20]]
        ];
        return $array;
    }

    public function submit(): bool
    {
        if ($this->check === "on") {
            // Clear all fields after successful submission
            $this->resetFields();
            return true;
        } else {
            $this->array['email'][] =  self::RULE_EMAIL_NOT_FOUND;
            $user = (new User())->findOne(['email' => $this->email]);
            if ($user !== null) {
                // Clear all fields after successful submission
                $this->resetFields();
                return true;
            }
            $this->addError('email', self::RULE_EMAIL_NOT_FOUND);
            return false; // Stop further execution if user not found
        }
    }

    /**
     * Resets all form fields to their default values.
     */
    private function resetFields(): void
    {
        $this->subject = "";
        $this->email = "";
        $this->body = "";
        $this->check = "";
        $this->submit = "submit";
    }
}
?>