<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Data\CityData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class City extends Model
{
    use HasFactory;
    use WithData;

    protected $table = 'cities';

    // protected $dataClass = CityData::class;

    protected $fillable = [
        'name', 'province_id',
    ];

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }


}
