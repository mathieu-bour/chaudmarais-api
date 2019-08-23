<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
 * @property int $subtotal
 * @property int $shipping_price
 * @property int $total
 * @property array $content
 * @property array $shipping
 * @property string $receipt_url
 * @property string $stripe_id
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

    protected $fillable = [
        "status",
        "subtotal",
        "shipping_price",
        "total",
        "content",
        "shipping",
        "receipt_url",
        "stripe_id",
        "user_id"
    ];
    protected $rules = [
        "user_id" => "required|exists:users,id"
    ];
    protected $casts = [
        "content" => "array",
        "shipping" => "array"
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
