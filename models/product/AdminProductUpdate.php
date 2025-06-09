<?php

namespace mproduct;

use core\Need;
use cproduct\UpdateProduct;

class AdminProductUpdate extends UpdateProduct
{

    public string $pid = "";
    public string $pname = "";
    public string $product_type = "";
    public string $hsfno = "";
    public string $description = "";
    public string $pstatus = "";
    public string $quantity = "";
    public string $mrp = "";
    public string $selling_price = "";


    public function rules(): array
    {
        return [
            'pname' => [Need::RULE_REQUIRED],
            'product_type' => [Need::RULE_REQUIRED],
            'hsfno' => [Need::RULE_REQUIRED, Need::RULE_ISNUM],
            'description' => [Need::RULE_REQUIRED],
            'pstatus' => [Need::RULE_REQUIRED],
            'quantity' => [Need::RULE_ISNUM],
            'mrp' => [Need::RULE_REQUIRED, Need::RULE_ISNUM],
            'selling_price' => [Need::RULE_REQUIRED, Need::RULE_ISNUM]
        ];
    }
    public static function tableName(): string
    {
        return 'product';
    }

    public function attribute(): array
    {
        return [
            'pname',
            'product_type',
            'hsfno',
            'description',
            'pstatus',
            'quantity',
            'mrp',
            'selling_price'
        ];
    }
}
