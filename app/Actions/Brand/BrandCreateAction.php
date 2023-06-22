<?php

namespace App\Actions\Brand;

use App\Models\Shop\Brand;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class BrandCreateAction
{

    public function execute($data = [])
    {

        $validator = Brand::validate($data);
        if ($validator->fails()) {
            throw ValidationException::withMessages(
                $validator->errors()->toArray()
            );
        }

        $brand = Brand::create($validator->validated());
        return $brand;
    }
}
