<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CostumerAddress
 *
 * @property string $ulid
 * @property string $postal_code
 * @property string $address_line1
 * @property string $address_line2
 * @property string $country
 * @property string $city
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress whereAddressLine1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress whereAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CostumerAddress whereUserId($value)
 *
 * @mixin \Eloquent
 */
class CostumerAddress extends Model
{
    use HasFactory;

    protected $table = 'costumer_addresses';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $casts = [
        'user_id' => 'int',
    ];

    protected $fillable = [
        'postal_code',
        'address_line1',
        'address_line2',
        'country',
        'city',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
