<?php

namespace mproduct;

use core\Model;
use core\Need;
use DateTime;

class AddOrder extends Model
{
    public string $tabel = "";

    // place_1
    public string $company_id = "";
    public string $company_invoice_number = "";
    public string $date_of_invoice = "";
    public string $due_date = "";
    public string $e_way_bill_number = "";

    // place_2
    public int $total_items = 0;

    public array $dummyrule = [];

    public function __construct()
    {
        $this->dummyrule = [
            'place_1' => [
                'company_id' => [],
                'company_invoice_number' => [
                    Need::RULE_REQUIRED,
                    Need::RULE_ISNUM,
                    [
                        Need::RULE_UNIQUE_SAME,
                        'attribute' => ['company_invoice_number', 'company_id'],
                        'table' => 'sorder'
                    ],
                ],
                'date_of_invoice' => [
                    Need::RULE_REQUIRED,
                    Need::RULE_TODAY_BEFORE_DATE,
                ],
                'e_way_bill_number' => [
                    Need::RULE_REQUIRED,
                    Need::RULE_ISNUM,
                    [
                        Need::RULE_MIN,
                        'min' => 12,
                    ],
                    [
                        Need::RULE_MAX,
                        'max' => 12,
                    ],
                ],
                'due_date' => [
                    Need::RULE_REQUIRED,
                    Need::RULE_TODAY_AFTER_DATE,
                ],
            ],
            'place_2' => 'strong'
        ];
    }

    public function attributes()
    {
        return [
            'place_1' => [
                'company_id',
                'company_invoice_number',
                'date_of_invoice',
                'due_date',
                'e_way_bill_number',
            ]
        ];
    }

    public array $rule = [];

    public function rules(): array
    {
        return $this->rule;
    }
    public static function tableName(): string
    {
        return (new static())->tabel;
    }

    public function place_1(array $data)
    {
        $this->company_id = $data['company_id'];
        $this->company_invoice_number = $data['company_invoice_number'];

        // Validate and format the date
        $date = DateTime::createFromFormat('j/n/Y', $data['date_of_invoice']);

        if ($date && $date->format('j-n-Y') === $data['date_of_invoice']) {
            $formattedDate = $date->format('d-m-Y');
        } else {
            // If the date is invalid, you should handle it gracefully
            $formattedDate = $data['date_of_invoice']; // or keep the original value, or add error
        }

        $this->date_of_invoice = $formattedDate;

        $date = DateTime::createFromFormat('j/n/Y', $data['due_date']);

        if ($date && $date->format('j/n/Y') === $data['due_date']) {
            $formattedDate = $date->format('d/m/Y');
        } else {
            // If the date is invalid, you should handle it gracefully
            $formattedDate = $data['due_date']; // or keep the original value, or add error
        }

        $this->due_date = $formattedDate;


        $this->e_way_bill_number = $data['e_way_bill_number'];
        $this->tabel = 'sorder';
        $this->rule = $this->dummyrule['place_1'];


        // Validate the data
        if ($this->validate()) {
            header('Content-Type: application/json');
            echo json_encode([
                'attribute' => $this->attributes()['place_1'],
                'next' => ['new-order-place-to-next1', 'new-order-place-to-next2'],
            ]);
        } else {
            // print_r($this->errors);
            header('Content-Type: application/json');
            echo json_encode([
                'attribute' => $this->attributes()['place_1'],
                'errors' => $this->errors,
            ]);
        }
        exit;
    }


    public function back1()
    {
        header('Content-Type: application/json');
        echo json_encode([
            'back' => ['new-order-place-to-next1', 'new-order-place-to-next2'],
        ]);
        exit;
    }
}
