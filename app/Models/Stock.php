<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mathrix\Lumen\Zero\Models\BaseModel;

/**
 * Class Stock.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 *
 * @property-read int $id
 * @property int $price
 * @property string $size
 * @property int $inventory
 * @property int $available_inventory
 * @property int $product_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * ---
 * @property Product $product
 */
class Stock extends BaseModel
{
    protected $fillable = [
        "price",
        "size",
        "inventory",
        "available_inventory",
        "product_id"
    ];


    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    /**
     * @return BelongsToMany
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }
}
