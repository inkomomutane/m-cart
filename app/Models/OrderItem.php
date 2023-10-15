<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OrderItem
 *
 * @property string $ulid
 * @property float $price
 * @property int $quantity
 * @property string $order_ulid
 * @property string $product_ulid
 * @property string|null $shipping_ulid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @property-read \App\Models\Product $product
 * @property-read \App\Models\Shipping|null $shipping
 *
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereOrderUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereProductUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereShippingUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderItem whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $casts = [
        'price' => 'float',
        'quantity' => 'int',
    ];

    protected $fillable = [
        'price',
        'quantity',
        'order_ulid',
        'product_ulid',
        'shipping_ulid',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_ulid');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_ulid');
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class, 'shipping_ulid');
    }
}
