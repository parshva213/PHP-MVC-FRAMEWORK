<?php

namespace muser;

use core\DbModel;

class AddCompany extends DbModel
{
    public string $company_name = '';
    public string $company_address = '';
    public string $gst_no = '';
    public int $uid = 0;

    public array $rules = [
        'company_name' => [self::RULE_REQUIRED],
        'company_address' => [self::RULE_REQUIRED],
        'gst_no' => [self::RULE_REQUIRED, self::RULE_GST, [self::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'gst_no']]
    ];

    public function attributes(): array
    {
        return ['company_name', 'company_address', 'gst_no', 'uid'];
    }

    public static function primaryKey(): string
    {
        return 'company_id';
    }

    public function getDisplayName(): string
    {
        return $this->company_name;
    }

    public function isRole(): string
    {
        return 's';
    }

    public static function tableName(): string
    {
        return 'scompany';
    }

    public function rules(): array
    {
        return $this->rules;
    }
}
