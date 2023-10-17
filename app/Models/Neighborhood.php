<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\NeighborhoodData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Neighborhood extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'neighborhoods';

    // protected $dataClass = NeighborhoodData::class;

    protected $casts = [
        'city_id' => 'int',
    ];

    protected $fillable = [
        'name',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
