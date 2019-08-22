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
 * @property string $receipt_url
 * @property string $stripe_id
 * @property array $content
 * @property array $address
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * ---
 * @property-read User $user
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

    protected $fillable = ["status", "stripe_id", "content", "address", "user_id"];
    protected $rules = [
        "user_id" => "required|exists:users,id"
    ];
    protected $casts = [
        "content" => "array",
        "address" => "array"
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
