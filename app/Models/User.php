<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Libraries\Traits\Validatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rules\Password;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Validatable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $validation_rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:5'
    ];


    public function canAccessFilament(): bool
    {
        return true;
    }
}
