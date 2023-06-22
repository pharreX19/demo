<?php

namespace App\Actions\Customer;

use App\Models\Shop\Brand;
use App\Models\Shop\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerShowAction
{

    public function execute(Customer $customer)
    {
        $customer->load([]); //Load relationships
        return $customer;
    }
}
