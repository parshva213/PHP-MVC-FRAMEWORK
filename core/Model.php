<?php

namespace core;

abstract class Model
{

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_EMAIL_NOT_FOUND = 'email_not_found';
    public const RULE_USER_NOT_FOUND = 'user_not_found';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_PASSWORD_NOT_VERIFY = 'pass_not_found';
    public const RULE_UNIQUE = 'unique';
    public const RULE_ACTIVATION = 'Login Activation';
    public const RULE_ISNUM = 'Number';

    public string $val = "";




    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;
    abstract public static function tableName(): string;

    public array $errors = [];

    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL, $rule);
                }
                if ($ruleName === self::RULE_MIN && isset($rule['min']) && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, ['min' => $rule['min']]);
                }
                if ($ruleName === self::RULE_MAX && isset($rule['max']) && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, ['max' => $rule['max']]);
                }
                if ($ruleName === self::RULE_MATCH && isset($rule['match']) && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, self::RULE_MATCH, ['match' => $rule['match']]);
                }
                if ($ruleName === self::RULE_ISNUM && !is_numeric($value)) {
                    $this->addError($attribute, self::RULE_ISNUM);
                }

                if ($ruleName === self::RULE_UNIQUE && is_array($rule)) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableNames = $this->tableNAME() ?? ""; // Array of table names

                    if ($uniqueAttr === 'contact') {
                        $rawContact = (string) $value;
                        $value = '+91 ' . substr($rawContact, 0, 5) . '-' . substr($rawContact, 5);
                    }



                    $statement = Application::$app->db->prepare("SELECT * FROM $tableNames WHERE $uniqueAttr = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();

                    if ($record) {
                        $this->addError($attribute, self::RULE_UNIQUE, ['field' => $attribute]);
                        break; // Exit the loop if a record is found
                    }
                }
            }
        }
        // echo "<pre>";
        // print_r($this->errors);
        // echo "</pre>";
        // exit;
        return empty(($this->errors));
    }

    public function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessage()[$rule] ?? '';
        if (!is_array($params)) {
            $params = array($params);
        }
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", ucfirst((string)$value), $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function errorMessage()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid Email address',
            self::RULE_EMAIL_NOT_FOUND => 'This email dose not found',
            self::RULE_USER_NOT_FOUND => 'This username not found or match',
            self::RULE_MIN => 'Minimum length of the field must be {min}',
            self::RULE_MAX => 'Maximum length of the field must be {max}',
            self::RULE_MATCH => 'This field must match the {match} field',
            self::RULE_PASSWORD_NOT_VERIFY => 'This password is invalid',
            self::RULE_UNIQUE => 'This {field} already exist',
            self::RULE_ACTIVATION => 'User account is not active',
            self::RULE_ISNUM => 'Contains Only Digit',
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }
}
