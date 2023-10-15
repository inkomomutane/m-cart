<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\VariantValue
 *
 * @property string $ulid
 * @property string $variant_ulid
 * @property float $price
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Variant $variant
 *
 * @method static \Illuminate\Database\Eloquent\Builder|VariantValue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariantValue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariantValue query()
 * @method static \Illuminate\Database\Eloquent\Builder|VariantValue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantValue wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantValue whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantValue whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantValue whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantValue whereVariantUlid($value)
 *
 * @mixin \Eloquent
 */
class VariantValue extends Model
{
    use HasFactory;

    protected $table = 'variant_values';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $casts = [
        'price' => 'float',
        'quantity' => 'int',
    ];

    protected $fillable = [
        'variant_ulid',
        'price',
        'quantity',
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class, 'variant_ulid');
    }
}
