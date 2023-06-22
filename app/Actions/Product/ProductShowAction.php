<?php

namespace App\Actions\Product;

use App\Models\User;
use App\Models\Shop\Brand;
use App\Models\Shop\Product;
use App\Models\Shop\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductShowAction
{

    public function execute(Product $product)
    {
        $product->load([]); //Load relationships
        return $product;
    }
}
