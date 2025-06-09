<?php

namespace core;

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
                if ($ruleName === Need::RULE_REQUIRED && !$value) {
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
                if ($ruleName === Need::RULE_UNIQUE && is_array($rule)) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableNames = $this->tableNAME() ?? ""; // Array of table names

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
        return $need->errors[$attribute][0] ?? '';
    }
}
