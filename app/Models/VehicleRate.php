<?php

namespace App\Models;
use App\Models\VehicleType;
use Illuminate\Database\Eloquent\Model;

class VehicleRate extends Model
{
    protected $guarded = [];


    public function vehicleType()
    {
        // return $this->belongsTo(VehicleType::class);
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }
}
