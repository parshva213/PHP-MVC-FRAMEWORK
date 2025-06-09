<?php

namespace muser;

use core\DbModel;
use core\Need;

class AddSupplier extends DbModel
{

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $contact = '';
    public string $address = '';
    public string $user_type = Need::ROLE_SUPPLIER;

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'contact', 'address', 'user_type'];
    }
    public static function primaryKey(): string
    {
        return 'id';
    }
    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }
    public function isRole(): string
    {
        return 'supplier';
    }

    public static function tableName(): string
    {
        return 'ausers';
    }

    public function rules(): array
    {
        return [
            'firstname' => [Need::RULE_REQUIRED],
            'lastname' => [Need::RULE_REQUIRED],
            'email' => [Need::RULE_REQUIRED, Need::RULE_EMAIL],
            'contact' => [Need::RULE_REQUIRED, Need::RULE_ISNUM, [Need::RULE_MIN, 'min' => 10], [Need::RULE_MAX, 'max' => 10], [Need::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'contact',]],
            'address' => [Need::RULE_REQUIRED]
        ];
    }
}
