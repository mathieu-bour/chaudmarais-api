<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mathrix\Lumen\Zero\Models\BaseModel;

/**
 * Class Address.
 *
 * @author Mathieu Bour <mathieu@mathrix.fr>
 * @copyright Mathrix Education SA.
 * @since 1.0.0
 *
 * @property-read int $id
 * @property string $line1
 * @property string $line2
 * @property string $postal_code
 * @property string $city
 * @property string $country
 * @property int $user_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * ---
 * @property-read User $user
 */
class Address extends BaseModel
{
    protected $fillable = [
        "line1",
        "line2",
        "postal_code",
        "city",
        "country",
        "user_id"
    ];
    protected $rules = [
        "line1" => "required|max:255",
        "line2" => "nullable|max:255",
        "postal_code" => "required|max:255",
        "city" => "required|max:255",
        "country" => "required|max:255",
        "user_id" => "required|exists:users,id"
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
