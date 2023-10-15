<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Tags\HasTags;

/**
 * App\Models\Product
 *
 * @property string $ulid
 * @property string $name
 * @property string $sku
 * @property float $regular_price
 * @property float $discount_price
 * @property int $quantity
 * @property string|null $short_description
 * @property string|null $description
 * @property float $weight
 * @property bool $published
 * @property int $published_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection<int, \App\Models\Attribute> $attributes
 * @property-read int|null $attributes_count
 * @property-read Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read Collection<int, \App\Models\OrderItem> $order_items
 * @property-read int|null $order_items_count
 * @property-read Collection<int, \App\Models\ProductCoupon> $product_coupons
 * @property-read int|null $product_coupons_count
 * @property-read Collection<int, \App\Models\Sell> $sells
 * @property-read int|null $sells_count
 * @property-read Collection<int, \App\Models\Shipping> $shippings
 * @property-read int|null $shippings_count
 * @property-read \App\Models\User $user
 * @property-read Collection<int, \App\Models\Variant> $variants
 * @property-read int|null $variants_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDiscountPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePublishedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereRegularPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereWeight($value)
 *
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;
    use HasTags;

    protected $table = 'products';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $casts = [
        'regular_price' => 'float',
        'discount_price' => 'float',
        'quantity' => 'int',
        'weight' => 'float',
        'published' => 'bool',
        'published_by' => 'int',
    ];

    protected $fillable = [
        'name',
        'sku',
        'regular_price',
        'discount_price',
        'quantity',
        'short_description',
        'description',
        'weight',
        'published',
        'published_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_ulid');
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute', 'product_ulid', 'attribute_ulid')
            ->withPivot('ulid')
            ->withTimestamps();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_ulid', 'category_ulid')
            ->withPivot('ulid')
            ->withTimestamps();
    }

    public function product_coupons(): HasMany
    {
        return $this->hasMany(ProductCoupon::class, 'product_ulid');
    }

    public function sells(): HasMany
    {
        return $this->hasMany(Sell::class, 'product_ulid');
    }

    public function shippings(): BelongsToMany
    {
        return $this->belongsToMany(Shipping::class, 'shipping_product', 'product_ulid', 'shipping_ulid')
            ->withPivot('ulid', 'ship_charge', 'free', 'estimated_days')
            ->withTimestamps();
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class, 'product_ulid');
    }
}
