<?php

namespace App\Actions\Brand;

use App\Models\Shop\Brand;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BrandUpdateAction
{
    private $_brand;

    public function __construct(Brand $brand)
    {
        $this->_brand = $brand;
    }

    public function execute($data = [])
    {

        $validation_rules = [
            'name' => "required|unique:shop_brands,name," . $this->_brand->id,
            'slug' => "required|unique:shop_brands,slug," . $this->_brand->id,
            'website' => 'required|url',
            'description' => 'required',
            'position' => 'required|integer',
            'is_visible' => 'required|boolean',
            'seo_title' => 'required|string|min:5|max:60',
            'seo_description' => 'sometimes|nullable|string|max:160',
            'sort' => 'required|integer',
        ];

        $this->_brand->fill($data);

        $validator = Validator::make($this->_brand->toArray(), $validation_rules);

        if ($validator->fails()) {
            throw ValidationException::withMessages(
                $validator->errors()->toArray()
            );
        }

        $this->_brand->save();
        return $this->_brand;
    }
}
