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
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'contact' => [self::RULE_REQUIRED, self::RULE_ISNUM, [self::RULE_MIN, 'min' => 10], [self::RULE_MAX, 'max' => 10], [self::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'contact', 'tables' => ['causers', 'usercon']]],
            'address' => [self::RULE_REQUIRED]
        ];
    }
}
