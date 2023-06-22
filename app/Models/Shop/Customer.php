<?php

namespace App\Models\Shop;

use App\Libraries\Traits\Validatable;
use App\Models\Address;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Validatable;

    /**
     * @var string
     */
    protected $table = 'shop_customers';

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'birthday' => 'date',
    ];

    public static $validation_rules = [
        'name' => 'required',
        'email' => 'required|email|unique:shop_customers,email',
        'photo' => 'sometimes|nullable|string',
        'gender' => 'required|in:male,female',
        'phone' => 'sometimes|nullable|string|max:255',
        'birthday' => 'required|date'
    ];

    public function scopeFilter($query, $name)
    {
        return $query->where('name', 'LIKE', "%{$name}%");
    }


    public function addresses(): MorphToMany
    {
        return $this->morphToMany(Address::class, 'addressable');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(Payment::class, Order::class, 'shop_customer_id');
    }
}
