<?php

namespace App\Actions\Customer;

use App\Models\User;
use App\Models\Shop\Brand;
use App\Models\Shop\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerListAction
{

    public function execute($options = [])
    {
        $defaultSort = array(
            'sortBy' => 'updated_at',
            'order' => 'desc'
        );

        $options = $defaultSort + $options;
        $filter = isset($options['name']) ? $options['name'] : '';

        return Customer::filter($filter)
            ->orderBy($options['sortBy'], $options['order'])
            ->paginate();
    }
}
