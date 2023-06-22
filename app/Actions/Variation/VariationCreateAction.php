<?php

namespace App\Actions\Variation;

use App\Models\User;
use App\Models\Shop\Brand;
use App\Models\Shop\Product;
use App\Models\Shop\Customer;
use App\Models\Shop\Variation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class VariationCreateAction
{

    public function execute(Product $product, $data = [])
    {

        $validator = Variation::validate($data);
        if ($validator->fails()) {
            throw ValidationException::withMessages(
                $validator->errors()->toArray()
            );
        }

        $path = Storage::disk('public')->put('uploads', $data['file']);

        $variation = Variation::create([
            'image_path' => $path,
            'shop_product_id' => $product->id,
            'color' => $data['color'],
            'size' => $data['size']
        ]);
        $product['image_path'] = $variation;
        return $product;
    }
}
