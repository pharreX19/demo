<?php

namespace App\Models\Shop;

use App\Models\Comment;
use Spatie\MediaLibrary\HasMedia;
use App\Libraries\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Validatable;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'shop_products';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'featured' => 'boolean',
        'is_visible' => 'boolean',
        'backorder' => 'boolean',
        'requires_shipping' => 'boolean',
        'published_at' => 'date',
    ];

    public static $validation_rules = [
        "shop_brand_id" => "required|exists:shop_brands,id",
        "name" => "required",
        "slug" => "required|unique:shop_products,slug",
        "sku" => "required|unique:shop_products,sku",
        "barcode" => "sometimes|nullable|string",
        "description" => "sometimes|nullable|string",
        "qty" => "sometimes|nullable|numeric|min:1",
        "security_stock" => "sometimes|nullable|string",
        "featured" => "sometimes|nullable|string",
        "is_visible" => "sometimes|nullable|boolean",
        "old_price" => "sometimes|nullable|numeric",
        "price" => "sometimes|nullable|string|numeric",
        "cost" => "sometimes|nullable|string",
        "type" => "sometimes|nullable|string",
        "backorder" => "sometimes|nullable|string",
        "requires_shipping" => "boolean|sometimes|nullable",
        "published_at" => "sometimes|nullable|date",
        "seo_title" => "sometimes|nullable|string",
        "seo_description" => "sometimes|nullable|string",
        "weight_value" => "sometimes|nullable|string",
        "weight_unit" => "sometimes|nullable|string",
        "height_value" => "sometimes|nullable|string",
        "height_unit" => "sometimes|nullable|string",
        "width_value" => "sometimes|nullable|string",
        "width_unit" => "sometimes|nullable|string",
        "depth_value" => "sometimes|nullable|string",
        "depth_unit" => "sometimes|nullable|string",
        "volume_value" => "sometimes|nullable|string",
        "volume_unit" => "sometimes|nullable|string",
    ];


    public function scopeFilter($query, $name)
    {
        return $query->where('name', 'LIKE', "%{$name}%");
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'shop_brand_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'shop_category_product', 'shop_product_id', 'shop_category_id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
