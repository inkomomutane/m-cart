<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ShippingProduct
 *
 * @property string $ulid
 * @property float $ship_charge
 * @property bool $free
 * @property int $estimated_days
 * @property string $shipping_ulid
 * @property string $product_ulid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Shipping $shipping
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct whereEstimatedDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct whereFree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct whereProductUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct whereShipCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct whereShippingUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ShippingProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ShippingProduct extends Model
{
    use HasFactory;

    protected $table = 'shipping_product';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $casts = [
        'ship_charge' => 'float',
        'free' => 'bool',
        'estimated_days' => 'int',
    ];

    protected $fillable = [
        'ship_charge',
        'free',
        'estimated_days',
        'shipping_ulid',
        'product_ulid',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_ulid');
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class, 'shipping_ulid');
    }
}
