<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\UserData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;
use Spatie\LaravelData\WithData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone_number
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Collection<int, \App\Models\Attribute> $attributes
 * @property-read int|null $attributes_count
 * @property-read Collection<int, \App\Models\Category> $categories
 * @property-read int|null $categories_count
 * @property-read Collection<int, \App\Models\CostumerAddress> $costumer_addresses
 * @property-read int|null $costumer_addresses_count
 * @property-read Collection<int, \App\Models\Coupon> $coupons
 * @property-read int|null $coupons_count
 * @property-read Collection<int, \App\Models\OrderStatus> $order_statuses
 * @property-read int|null $order_statuses_count
 * @property-read Collection<int, \App\Models\Order> $orders
 * @property-read int|null $orders_count
 * @property-read Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read Collection<int, \App\Models\Shipping> $shippings
 * @property-read int|null $shippings_count
 *
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use InteractsWithMedia;
    use Notifiable;
    use Searchable;
    use WithData;

    protected $table = 'users';

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    protected $appends = [
        'avatar',
    ];

    protected $dataClass = UserData::class;

    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class, 'updated_by');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'updated_by');
    }

    public function costumer_addresses(): HasMany
    {
        return $this->hasMany(CostumerAddress::class);
    }

    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class, 'updated_by');
    }

    public function order_statuses(): HasMany
    {
        return $this->hasMany(OrderStatus::class, 'updated_by');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'costumer_ulid');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'published_by');
    }

    public function shippings(): HasMany
    {
        return $this->hasMany(Shipping::class, 'updated_by');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width('200')->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->withResponsiveImages()->singleFile();
    }

    public function getAvatarAttribute()
    {
        return $this->getFirstMedia('avatar');
    }

    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'image' => $this->getFirstMediaUrl('avatar', 'thumb'),
            'phone_number' => $this->phone_number
        ];
    }
}
