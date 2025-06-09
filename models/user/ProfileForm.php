<?php

namespace muser;

use core\Application;
use core\Need;
use cuser\UpdateUser;
use PDO;

class ProfileForm extends UpdateUser
{
    public int $id;

    public array $rule = [];
    public array $needchange = [
        'firstName' => [],
        'lastName' => [],
        'address' => [],
        'email' => [
            'email' => [
                Need::RULE_EMAIL,
                [Need::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'email']
            ]
        ],
        'contact' => [
            'contact' => [
                Need::RULE_ISNUM,
                [Need::RULE_MIN, 'min' => 10],
                [Need::RULE_MAX, 'max' => 10],
                [Need::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'contact'],
            ]
        ],
    ];

    public string $firstName = "";
    public string $lastName = "";
    public string $email = "";
    public string $contact = "";
    public string $address = "";

    public function __construct()
    {
        // Initialize $id from the session or current user if available
        $this->id = Application::$app->session->get('user');
    }

    public function submit(): bool
    {
        return false;
    }

    public function fetch()
    {
        $db = Application::$app->db->pdo;

        $user = $db->query("SELECT * FROM ausers where uid = $this->id")->fetchAll(PDO::FETCH_ASSOC);
        $user = $user[0];
        $this->firstName = $user['firstname'];
        $this->lastName = $user['lastname'];
        $this->email = $user['email'];
        $this->address = $user['address'];
        $this->contact = str_replace(['+91', '-', ' '], '', $user['contact']);
    }

    public function rules(): array
    {
        // Define your validation rules here
        return $this->rule;
    }

    public static function tableNAME(): string
    {
        return 'ausers'; // Replace with the actual table name if needed
    }

    public function attributes(): array
    {
        return [
            'firstName',
            'lastName',
            'email',
            'address',
            'contact'
        ];
    }
    public static function primaryKey(): string
    {
        return "uid";
    }

    public function profilepasscheck(): bool
    {
        $this->fetch(); // Fetch original values from DB
        $hasChanges = false;

        // STEP 1: Apply RULE_REQUIRED for empty fields
        foreach (['firstName', 'lastName', 'email', 'contact', 'address'] as $key) {
            $inputValue = trim($_POST[$key] ?? '');
            if (empty($inputValue)) {
                $this->rule = array_merge($this->rule, [
                    $key => [Need::RULE_REQUIRED]
                ]);
            }

            // STEP 2: Detect if anything changed (only to trigger other rules)
            if ($this->{$key} !== $inputValue) {
                $this->rule = array_merge($this->rule, $this->needchange[$key] ?? "");
                $this->$key = trim($_POST[$key]);
            }
        }

        // STEP 3: If any field has changed, apply only field-specific rules (no RULE_REQUIRED)
        // if ($hasChanges) {


        //     // Update model values (already validated as non-empty above)
        //     $this->firstName = trim($_POST['firstName'] ?? '');
        //     $this->lastName = trim($_POST['lastName'] ?? '');
        //     $this->email = trim($_POST['email'] ?? '');
        //     $this->contact = trim($_POST['contact'] ?? '');
        //     $this->address = trim($_POST['address'] ?? '');
        // }
        // echo "<pre>";
        // var_dump($this->rule);
        // echo "</pre>";
        // exit();
        return $this->validate();
    }


    public function save()
    {
        $db = Application::$app->db->pdo;

        $rawContact = $this->contact;
        $this->contact = '+91 ' . substr($rawContact, 0, 5) . '-' . substr($rawContact, 5);

        $tableName = $this->tableNAME();
        $attributes = $this->attributes();
        $put = implode(', ', array_map(fn($attr) => "$attr = :$attr", $attributes));


        $statement = $db->prepare("UPDATE $tableName set $put  where uid = $this->id");
        foreach ($attributes as $a) {
            $statement->bindValue(":$a", $this->{$a});
        }
        $this->contact = str_replace(['+91', '-', ' '], '', $this->contact);
        return $statement->execute();
    }
}
