<?php

namespace App\Actions\Product;

use App\Models\User;
use App\Models\Shop\Brand;
use App\Models\Shop\Product;
use App\Models\Shop\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductListAction
{

    public function execute($options = [])
    {
        $defaultSort = array(
            'sortBy' => 'updated_at',
            'order' => 'desc'
        );

        $options = $defaultSort + $options;
        $filter = isset($options['name']) ? $options['name'] : '';

        return Product::filter($filter)
            ->orderBy($options['sortBy'], $options['order'])
            ->paginate();
    }
}
