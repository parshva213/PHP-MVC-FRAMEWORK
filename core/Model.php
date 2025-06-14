<?php

namespace core;

use DateTime;

abstract class Model
{

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
                if ($ruleName === Need::RULE_REQUIRED && empty($value)) {
                    $this->addError($attribute, Need::RULE_REQUIRED);
                }
                if ($ruleName === Need::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, Need::RULE_EMAIL, $rule);
                }
                if ($ruleName === Need::RULE_MIN && isset($rule['min']) && strlen($value) < $rule['min']) {
                    $this->addError($attribute, Need::RULE_MIN, ['min' => $rule['min']]);
                }
                if ($ruleName === Need::RULE_MAX && isset($rule['max']) && strlen($value) > $rule['max']) {
                    $this->addError($attribute, Need::RULE_MAX, ['max' => $rule['max']]);
                }
                if ($ruleName === Need::RULE_MATCH && isset($rule['match']) && $value !== $this->{$rule['match']}) {
                    $this->addError($attribute, Need::RULE_MATCH, ['match' => $rule['match']]);
                }
                if ($ruleName === Need::RULE_ISNUM && !is_numeric($value)) {
                    $this->addError($attribute, Need::RULE_ISNUM);
                }
                if ($ruleName === Need::RULE_GST && !preg_match("/^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([a-zA-Z0-9]){3}$/", $value)) {
                    $this->addError($attribute, Need::RULE_GST);
                }
                date_default_timezone_set('Asia/Kolkata');

                $today = new DateTime('today');
                // print_r($today);
                if ($ruleName === Need::RULE_TODAY_AFTER_DATE) {
                    $inputDate = DateTime::createFromFormat('Y-m-d', $value);
                    if (!$inputDate || $inputDate <= $today) {
                        $this->addError($attribute, Need::RULE_TODAY_AFTER_DATE);
                    }
                }
                if ($ruleName === Need::RULE_TODAY_BEFORE_DATE) {
                    $inputDate = DateTime::createFromFormat('Y-m-d', $value);
                    if (!$inputDate || $inputDate >= $today) {
                        $this->addError($attribute, Need::RULE_TODAY_BEFORE_DATE);
                    }
                }
                if ($ruleName === Need::RULE_TODAY_DATE && $value === $today) {
                    $this->addError($attribute, Need::RULE_TODAY_DATE);
                }
                if ($ruleName === Need::RULE_UNIQUE && is_array($rule)) {
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableNames = $rule['table'] ?? $this->tableNAME() ??  ""; // Array of table names

                    if ($uniqueAttr === 'contact') {
                        $rawContact = (string) $value;
                        $value = '+91 ' . substr($rawContact, 0, 5) . '-' . substr($rawContact, 5);
                    }
                    if ($uniqueAttr === 'email') {
                        $value = strtolower($value);
                    }
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableNames WHERE $uniqueAttr = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();

                    if ($record) {
                        $this->addError($attribute, Need::RULE_UNIQUE, ['field' => $attribute]);
                    }
                }
                if ($ruleName === Need::RULE_UNIQUE_SAME && is_array($rule)) {
                    $uniqueAtt = $rule['attribute'];
                    $tableName = $rule['table'];

                    $params = implode(" AND ", array_map(fn($a) => "$a = :$a", $uniqueAtt));

                    // Ensure primary_value is properly bound
                    $sql = "SELECT * FROM $tableName WHERE $params ;";
                    // echo "<pre>";
                    // print_r($sql);
                    // echo "</pre>";
                    // exit();
                    $statement = Application::$app->db->prepare($sql);
                    foreach ($uniqueAtt as $a) {
                        $statement->bindValue(":$a", $this->{$a}); // Bind the unique attribute value
                    }
                    $statement->execute();
                    $record = $statement->fetchObject();

                    if ($record) {
                        $this->addError($attribute, Need::RULE_UNIQUE_SAME, ['field' => $attribute]);
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
        $need = new Need();
        $message = $need->errorMessage()[$rule] ?? '';
        if (!is_array($params)) {
            $params = array($params);
        }
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", ucfirst((string)$value), $message);
        }
        $this->errors[$attribute][] = $message;
    }



    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        $need = new Need();
        return $need->errorMessage[$attribute][0] ?? '';
    }
}
