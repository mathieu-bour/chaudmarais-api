<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mathrix\Lumen\Zero\Models\BaseModel;


/**
 * Class Product.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 *
 * @property-read int $id
 * @property bool $enabled
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property int $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * ---
 * @property-read Collection|Stock[] $stocks
 */
class Product extends BaseModel
{
    protected $fillable = [
        "enabled",
        "name",
        "slug",
        "description",
        "order"
    ];
    protected $casts = [
        "enabled" => "boolean"
    ];


    /**
     * @return HasMany
     */
    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
