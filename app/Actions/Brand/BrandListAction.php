<?php

namespace App\Actions\Brand;

use App\Models\User;
use App\Models\Shop\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BrandListAction
{

    public function execute($options = [])
    {
        $defaultSort = array(
            'sortBy' => 'updated_at',
            'order' => 'desc'
        );

        $options = $defaultSort + $options;
        $filter = isset($options['name']) ? $options['name'] : '';

        return Brand::filter($filter)
            ->orderBy($options['sortBy'], $options['order'])
            ->paginate();
    }
}
