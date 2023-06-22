<?php

namespace App\Actions\Customer;

use App\Models\Shop\Brand;
use App\Models\Shop\Customer;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class CustomerCreateAction
{

    public function execute($data = [])
    {

        $validator = Customer::validate($data);
        if ($validator->fails()) {
            throw ValidationException::withMessages(
                $validator->errors()->toArray()
            );
        }

        $brand = Customer::create($validator->validated());
        return $brand;
    }
}
