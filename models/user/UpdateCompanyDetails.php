<?php

namespace muser;

use core\Model;
use core\Need;

class UpdateCompanyDetails
{
    public int $company_id = 0;
    public string $company_name = '';
    public string $company_address = '';
    public string $gst_no = '';
    public string $acc_hol_name = '';
    public string $acc_no = '';
    public string $bank_ifsc = '';
    public string $bank_name = '';
    public string $bank_branch = '';

    public function attributes(): array
    {
        return [
            'scompany' => [
                'company_id',
                'company_name',
                'company_address',
                'gst_no'
            ],
            'scompanybank' => [
                'company_id',
                'acc_hol_name',
                'bank_name',
                'acc_no',
                'bank_ifsc',
                'bank_branch'
            ]
        ];
    }

    public array $rules = [
        'scompany' => [
            'company_id' => [],
            'company_name' => [],
            'company_address' => [],
            'gst_no' => [
                Need::RULE_GST,
                [
                    Need::RULE_UNIQUE,
                    'class' => self::class,
                    'attribute' => 'gst_no'
                ]
            ]
        ],
        'scompanybank' => [
            'company_id' => [],
            'acc_hol_name' => [],
            'bank_name' => [],
            'acc_no' => [
                Need::RULE_ISNUM,
                [
                    Need::RULE_UNIQUE,
                    'class' => self::class,
                    'attribute' => 'acc_no'
                ]
            ],
            'bank_ifsc' => [],
            'bank_branch' => []
        ]
    ];

    public function rules(): array
    {
        return [
            'scompany' => [
                'company_id' => [Need::RULE_REQUIRED],
                'company_name' => [Need::RULE_REQUIRED],
                'company_address' => [Need::RULE_REQUIRED],
                'gst_no' => [Need::RULE_REQUIRED]
            ],
            'scompanybank' => [
                'company_id' => [Need::RULE_REQUIRED],
                'acc_hol_name' => [Need::RULE_REQUIRED],
                'bank_name' => [Need::RULE_REQUIRED],
                'acc_no' => [Need::RULE_REQUIRED],
                'bank_ifsc' => [Need::RULE_REQUIRED],
                'bank_branch' => [Need::RULE_REQUIRED]
            ]
        ];
    }

    public function check($data)
    {
        foreach ($this->attributes() as $table => $attributes) {
            foreach ($attributes as $attribute) {
                if ($data[$attribute] !== $this->{$attribute}) {
                }
            }
        }
    }
}
