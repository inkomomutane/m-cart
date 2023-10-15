<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Variant
 *
 * @property string $ulid
 * @property string $name
 * @property string $product_ulid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read Collection<int, \App\Models\VariantValue> $variant_values
 * @property-read int|null $variant_values_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Variant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant query()
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereProductUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variant whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Variant extends Model
{
    use HasFactory;

    protected $table = 'variants';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'product_ulid',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_ulid');
    }

    public function variant_values(): HasMany
    {
        return $this->hasMany(VariantValue::class, 'variant_ulid');
    }
}
