<?php

namespace muser;

use core\Application;
use core\Model;
use core\Need;

class UpdateCompanyDetails extends Model
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

    public function checkattributes(): array
    {
        return [
            'scompany' => [
                'company_address',
                'company_name',
                'gst_no',
            ],
            'scompanybank' => [
                'acc_no',
                'acc_hol_name',
                'bank_branch',
                'bank_ifsc',
                'bank_name',
            ]
        ];
    }
    public function attributes(): array
    {
        return [
            'company_name',
            'company_address',
            'gst_no',
            'acc_hol_name',
            'bank_name',
            'acc_no',
            'bank_ifsc',
            'bank_branch',
        ];
    }

    public array $needrules = [
        'scompany' => [
            'company_name' => [],
            'company_address' => [],
            'gst_no' => [
                Need::RULE_GST,
                [
                    Need::RULE_UNIQUE,
                    'class' => self::class,
                    'attribute' => 'gst_no',
                    'table' => 'scompany'
                ]

            ]
        ],
        'scompanybank' => [
            'acc_hol_name' => [],
            'bank_name' => [],
            'acc_no' => [
                Need::RULE_ISNUM,
                [
                    Need::RULE_UNIQUE,
                    'class' => self::class,
                    'attribute' => 'acc_no',
                    'table' => 'scompanybank'
                ]
            ],
            'bank_ifsc' => [],
            'bank_branch' => []
        ]
    ];

    public array $rules = [];

    public function rules(): array
    {
        return $this->rules;
    }
    public static function tableName(): string
    {
        return "";
    }

    public function check($data)
    {
        foreach ($this->checkattributes() as $table => $attributes) {
            foreach ($attributes as $attribute) {
                if ($attribute === 'company_id') {
                    $this->{$attribute} = $data[$attribute] ?? 0;
                    continue;
                }
                if (empty($data[$attribute])) {
                    $this->rules[$attribute] = [Need::RULE_REQUIRED];
                }

                if ($data[$attribute] !== $this->{$attribute}) {
                    $this->rules[$attribute] = array_merge(
                        $this->rules[$attribute] ?? [],
                        $this->needrules[$table][$attribute]
                    );
                }
                $this->{$attribute} = $data[$attribute] ?? '';
            }
        }


        if (empty($this->rules))
            return "Rule is empty";

        if ($this->validate()) {
            return "Validate success";
        }

        header('Content-Type: application/json');
        echo json_encode([
            'errors' => $this->errors,
            'attribute' => $this->attributes()
        ]);
        exit;
    }

    public function update()
    {
        $db = Application::$app->db->pdo;
        $sql = "SAVEPOINT sp1;";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        foreach ($this->checkattributes() as $table => $attributes) {
            $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
            $sql = "UPDATE $table SET " . implode(', ', $params) . " WHERE company_id = :company_id";
            $stmt = $db->prepare($sql);
            foreach ($attributes as $a) {
                $stmt->bindValue(":$a", $this->{$a});
            }
            $stmt->bindValue(":company_id", $this->company_id);
            if (!$stmt->execute()) {
                $sql = "ROLLBACK TO SAVEPOINT sp1;";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                return false;
            }
        }

        return true;
    }
}
