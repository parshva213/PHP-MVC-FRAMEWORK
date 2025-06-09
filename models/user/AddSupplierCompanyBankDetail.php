<?php

namespace muser;

use core\DbModel;
use core\Need;

class AddSupplierCompanyBankDetail extends DbModel
{
    public int $company_id = 0;
    public string $acc_hol_name = '';
    public string $acc_no = '';
    public string $bank_ifsc = '';
    public string $bank_branch = '';
    public string $bank_name = '';

    public function attributes(): array
    {
        return ['company_id', 'acc_hol_name', 'bank_name', 'acc_no', 'bank_ifsc', 'bank_branch'];
    }

    public static function primaryKey(): string
    {
        return 'company_id';
    }

    public static function tableName(): string
    {
        return 'scompanybank';
    }

    public function isRole(): string
    {
        return 's';
    }

    public function rules(): array
    {
        return [
            'company_id' => [Need::RULE_REQUIRED],
            'bank_name' => [Need::RULE_REQUIRED],
            'acc_no' => [Need::RULE_REQUIRED, Need::RULE_ISNUM, [Need::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'acc_no']],
            'bank_ifsc' => [Need::RULE_REQUIRED],
            'bank_branch' => [Need::RULE_REQUIRED],
            'acc_hol_name' => [Need::RULE_REQUIRED]
        ];
    }
    public function getDisplayName(): string
    {
        return $this->acc_hol_name;
    }
}
