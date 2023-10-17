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
 * App\Models\Order
 *
 * @property string $ulid
 * @property int $costumer_ulid
 * @property string $coupon_ulid
 * @property string $status_ulid
 * @property \Illuminate\Support\Carbon $approved_at
 * @property \Illuminate\Support\Carbon|null $delivered_to_carrier_at
 * @property \Illuminate\Support\Carbon|null $delivered_to_costumer_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupon $coupon
 * @property-read Collection<int, \App\Models\OrderItem> $order_items
 * @property-read int|null $order_items_count
 * @property-read \App\Models\OrderStatus $order_status
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\OrderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCostumerUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCouponUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveredToCarrierAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveredToCostumerAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatusUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $casts = [
        'costumer_ulid' => 'int',
        'approved_at' => 'datetime',
        'delivered_to_carrier_at' => 'datetime',
        'delivered_to_costumer_at' => 'datetime',
    ];

    protected $fillable = [
        'costumer_ulid',
        'coupon_ulid',
        'status_ulid',
        'approved_at',
        'delivered_to_carrier_at',
        'delivered_to_costumer_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'costumer_ulid');
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class, 'coupon_ulid');
    }

    public function order_status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class, 'status_ulid');
    }

    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_ulid');
    }
}
