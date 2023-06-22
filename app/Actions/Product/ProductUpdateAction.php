<?php

namespace App\Actions\Product;

use App\Models\User;
use App\Models\Shop\Brand;
use App\Models\Shop\Product;
use App\Models\Shop\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductUpdateAction
{
    private $_product;

    public function __construct(Product $product)
    {
        $this->_product = $product;
    }

    public function execute($data = [])
    {

        $validation_rules = [
            "shop_brand_id" => "required|exists:shop_brands,id",
            "name" => "required",
            "slug" => "required|unique:shop_products,slug," . $this->_product->id,
            "sku" => "required|unique:shop_products,sku," . $this->_product->id,
        ];

        $this->_product->fill($data);

        $validator = Validator::make($this->_product->toArray(), $validation_rules);

        if ($validator->fails()) {
            throw ValidationException::withMessages(
                $validator->errors()->toArray()
            );
        }

        $this->_product->save();
        return $this->_product;
    }
}
