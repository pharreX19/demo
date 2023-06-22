<?php

namespace App\Models\Shop;

use App\Models\Address;
use Spatie\MediaLibrary\HasMedia;
use App\Libraries\Traits\Validatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Brand extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Validatable;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'shop_brands';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public static $validation_rules = [
        'name' => "required|unique:shop_brands,name",
        'slug' => "required|unique:shop_brands,slug",
        'website' => 'required|url',
        'description' => 'required',
        'position' => 'required|integer',
        'is_visible' => 'required|boolean',
        'seo_title' => 'required|string|min:5|max:60',
        'seo_description' => 'sometimes|nullable|string|max:160',
        'sort' => 'required|integer',
    ];


    public function scopeFilter($query, $name)
    {
        return $query->where('name', 'LIKE', "%{$name}%");
    }


    public function addresses(): MorphToMany
    {
        return $this->morphToMany(Address::class, 'addressable', 'addressables');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'shop_brand_id');
    }
}
