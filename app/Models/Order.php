<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mathrix\Lumen\Zero\Models\BaseModel;


/**
 * Class Order.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 *
 * @property-read int $id
 * @property string $status
 * @property int $address_id
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * ---
 * @property-read Address $address
 * @property-read User $user
 * @property-read Collection|Stock $stocks
 */
class Order extends BaseModel
{
    public const CREATED = "created";
    public const PAID = "paid";
    public const CANCELED = "canceled";
    public const FULFILLED = "fulfilled";
    public const RETURNED = "returned";
    public const STATUSES = [
        self::CREATED,
        self::PAID,
        self::CANCELED,
        self::FULFILLED,
        self::RETURNED
    ];

    protected $fillable = ["status", "address_id", "user_id"];
    protected $rules = [
        "address_id" => "required|exist:address,id",
        "user_id" => "required|exist:users,id"
    ];


    /**
     * @return BelongsTo
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return BelongsToMany
     */
    public function stocks(): BelongsToMany
    {
        return $this->belongsToMany(Stock::class);
    }
}
