<?php

namespace core;

class Need
{
    const STASTUS_INACTIVE = 0;
    const STASTUS_ACTIVE = 1;
    const STASTUS_DELETED = 2;

    const ROLE_ADMIN = 'a';
    const ROLE_OWNER = 'o';
    const ROLE_MANUFACTURER = 'm';
    const ROLE_SUPPLIER = 's';
    const ROLE_CUSTOMER = 'c';

    const PRODUCT_STATE_ACTIVE = 'Active';
    const PRODUCT_STATE_INACTIVE = 'In Active';

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
    public const RULE_GST = 'gst';
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
            self::RULE_GST => 'Invalid GST Number',
        ];
    }
}
