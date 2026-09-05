<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleRate extends Model
{
    protected $guarded = [];


    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }
}
