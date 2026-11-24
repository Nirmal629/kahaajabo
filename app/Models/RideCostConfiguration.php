<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideCostConfiguration extends Model
{
    protected $guarded = [];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }
}
