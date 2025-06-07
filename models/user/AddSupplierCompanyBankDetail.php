<?php

namespace muser;

use core\DbModel;

class AddSupplierCompanyBankDetail extends DbModel
{
    public int $company_id = 0;
    public string $acc_hol_name = '';
    public string $acc_no = '';
    public string $bank_ifsc = '';
    public string $branch_name = '';
    public string $bank_name = '';

    public function attributes(): array
    {
        return ['company_id', 'acc_hol_name', 'bank_name', 'acc_no', 'bank_ifsc', 'branch_name'];
    }

    public static function primaryKey(): string
    {
        return 'id';
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
            'company_id' => [self::RULE_REQUIRED],
            'bank_name' => [self::RULE_REQUIRED],
            'acc_no' => [self::RULE_REQUIRED, self::RULE_ISNUM, [self::RULE_UNIQUE, 'class' => self::class, 'attribute' => 'acc_no']],
            'bank_ifsc' => [self::RULE_REQUIRED],
            'branch_name' => [self::RULE_REQUIRED],
            'acc_hol_name' => [self::RULE_REQUIRED]
        ];
    }
    public function getDisplayName(): string
    {
        return $this->acc_hol_name;
    }
}
