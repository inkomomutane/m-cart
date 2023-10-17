<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ProductCoupon
 *
 * @property string $ulid
 * @property string $product_ulid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCoupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCoupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCoupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCoupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCoupon whereProductUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCoupon whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCoupon whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductCoupon extends Model
{
    use HasFactory;

    protected $table = 'product_coupon';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $fillable = [
        'product_ulid',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_ulid');
    }
}
