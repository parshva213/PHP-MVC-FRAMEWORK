<?php

namespace mproduct;

use cproduct\UpdateProduct;

class AdminProductUpdate extends UpdateProduct
{

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
        return [];
    }
    public static function tableName(): string
    {
        return 'product';
    }
}
