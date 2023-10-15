<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Sell
 *
 * @property string $ulid
 * @property int $quantity
 * @property float $price
 * @property string $product_ulid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Sell newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sell newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sell query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sell whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sell wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sell whereProductUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sell whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sell whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sell whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Sell extends Model
{
    use HasFactory;

    protected $table = 'sells';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $casts = [
        'quantity' => 'int',
        'price' => 'float',
    ];

    protected $fillable = [
        'quantity',
        'price',
        'product_ulid',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_ulid');
    }
}
