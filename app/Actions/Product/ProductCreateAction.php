<?php

namespace App\Actions\Product;

use App\Models\User;
use App\Models\Shop\Brand;
use App\Models\Shop\Product;
use App\Models\Shop\Customer;
use Illuminate\Validation\ValidationException;

class ProductCreateAction
{

    public function execute($data = [])
    {

        $validator = Product::validate($data);
        if ($validator->fails()) {
            throw ValidationException::withMessages(
                $validator->errors()->toArray()
            );
        }

        $brand = Product::create($validator->validated());
        return $brand;
    }
}
