<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Lumen\Auth\Authorizable;
use Mathrix\Lumen\JWT\Auth\HasJWT;
use Mathrix\Lumen\Zero\Models\BaseModel;

/**
 * Class User.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 *
 * @property-read int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $stripe_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * ---
 * @property-read Collection|Address[] $addresses
 * @property-read Collection|Order[] $orders
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use HasJWT, Authorizable, Authenticatable;

    protected $fillable = ["email", "password", "first_name", "last_name"];
    protected $hidden = ["password"];
    protected $rules = [
        "email" => "required|email",
        "password" => "required",
        "first_name" => "required|max:255",
        "last_name" => "required|max:255",
        "stripe_id" => "required|max:255"
    ];
    protected $casts = [
        "scopes" => "array"
    ];

    /**
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
