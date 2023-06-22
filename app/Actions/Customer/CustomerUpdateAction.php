<?php

namespace App\Actions\Customer;

use App\Models\Shop\Brand;
use App\Models\Shop\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerUpdateAction
{
    private $_customer;

    public function __construct(Customer $customer)
    {
        $this->_customer = $customer;
    }

    public function execute($data = [])
    {

        $validation_rules = [
            'name' => 'required',
            'email' => 'required|email|unique:shop_customers,email,' . $this->_customer->id,
            'photo' => 'sometimes|nullable|string',
            'gender' => 'required|in:male,female',
            'phone' => 'sometimes|nullable|string|max:255',
            'birthday' => 'required|date'
        ];

        $this->_customer->fill($data);

        $validator = Validator::make($this->_customer->toArray(), $validation_rules);

        if ($validator->fails()) {
            throw ValidationException::withMessages(
                $validator->errors()->toArray()
            );
        }

        $this->_customer->save();
        return $this->_customer;
    }
}
