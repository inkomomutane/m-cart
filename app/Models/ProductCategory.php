<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\ProductCategory
 *
 * @property string $ulid
 * @property string $product_ulid
 * @property string $category_ulid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCategoryUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereProductUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected $primaryKey = 'ulid';

    public $incrementing = false;

    protected $fillable = [
        'product_ulid',
        'category_ulid',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_ulid');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_ulid');
    }
}
