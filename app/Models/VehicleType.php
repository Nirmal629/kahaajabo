<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    protected $guarded = [];

    public function vehicleRates()
    {
        return $this->hasMany(VehicleRate::class);
    }
}
