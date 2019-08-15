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
 * @property string[] $images
 * @property int $order
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * ---
 * @property int $price
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
        "order",
        "images"
    ];
    protected $casts = [
        "enabled" => "boolean",
        "images" => "array"
    ];
    protected $rules = [
        "enabled" => "required|boolean",
        "name" => "required|max:255",
        "slug" => "required|max:255",
        "description" => "required",
        "order" => "required|min:0"
    ];
    protected $appends = ["price"];


    /**
     * @return HasMany
     */
    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * @return int|null
     */
    public function getPriceAttribute()
    {
        /** @var Stock|null $stock */
        $stock = $this->stocks()->orderBy("price")->first();

        return $stock !== null ? $stock->price : null;
    }
}
