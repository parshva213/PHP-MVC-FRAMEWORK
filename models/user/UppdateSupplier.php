<?php

namespace muser;

use core\Application;
use core\DbModel;
use core\Need;
use PDO;

class UppdateSupplier extends DbModel
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $contact = '';
    public string $address = '';
    public string $user_type = Need::ROLE_SUPPLIER;

    public array $rules = [
        'firstname' => [Need::RULE_REQUIRED],
        'lastname' => [Need::RULE_REQUIRED],
        'email' => [Need::RULE_REQUIRED],
        'contact' => [Need::RULE_REQUIRED],
        'address' => [Need::RULE_REQUIRED]
    ];

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
        return $this->user_type;
    }

    public static function tableName(): string
    {
        return 'ausers';
    }

    public function rules(): array
    {
        return $this->rules;
    }


    public function validata($uid, $db)
    {
        $smt = $db->prepare("SELECT * FROM " . self::tableName() . " WHERE uid = :uid");
        $smt->bindValue(':uid', $uid);
        $smt->execute();
        $result = $smt->fetchAll(PDO::FETCH_ASSOC);
        $result = $result[0];
        $contact = $result['contact'];
        $result['contact'] = str_replace([' ', '-', '+91'], '', $result['contact']); // Clean up contact number
        foreach ($this->attributes() as $attribute) {
            if ($result[$attribute] !== $this->{$attribute}) {
                if ($attribute === 'email') {
                    $this->rules[$attribute][] = [Need::RULE_UNIQUE, 'class' => self::class, 'attribute' => $attribute];
                }
                if ($attribute === 'contact') {
                    $this->rules[$attribute][] = Need::RULE_ISNUM;
                    $this->rules[$attribute][] = [Need::RULE_MIN, 'min' => 10];
                    $this->rules[$attribute][] = [Need::RULE_MAX, 'max' => 10];
                    $this->rules[$attribute][] = [Need::RULE_UNIQUE, 'class' => self::class, 'attribute' => $attribute];
                }
            }
        }
        $result['contact'] = $contact;
        if ($this->validate()) {
            return true;
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'errors' => $this->errors,
                'attribute' => $this->attributes()
            ]);
            exit;
        }
    }
}
