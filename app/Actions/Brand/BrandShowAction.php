<?php

namespace App\Actions\Brand;

use App\Models\Shop\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BrandShowAction
{

    public function execute(Brand $brand)
    {
        $brand->load([]); //Load relationships
        return $brand;
    }
}
