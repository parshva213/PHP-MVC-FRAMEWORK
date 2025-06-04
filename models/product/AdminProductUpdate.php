<?php

namespace mproduct;

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
            'pname' => [self::RULE_REQUIRED],
            'product_type' => [self::RULE_REQUIRED],
            'hsfno' => [self::RULE_REQUIRED, self::RULE_ISNUM],
            'description' => [self::RULE_REQUIRED],
            'pstatus' => [self::RULE_REQUIRED],
            'quantity' => [self::RULE_ISNUM],
            'mrp' => [self::RULE_REQUIRED, self::RULE_ISNUM],
            'selling_price' => [self::RULE_REQUIRED, self::RULE_ISNUM]
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
