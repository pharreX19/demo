<?php

namespace App\Models\Shop;

use App\Models\Shop\Product;
use App\Libraries\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variation extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Validatable;

    protected $table = 'shop_product_variations';

    public static $validation_rules = [
        'file' => 'required|file|mimes:jpg',
        'size' => 'required|string',
        'color' => 'required|string'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'shop_product_id');
    }
}
