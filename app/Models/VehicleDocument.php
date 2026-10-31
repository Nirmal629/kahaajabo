<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleDocument extends Model
{
    protected $guarded = [];
    
    public function vehicle()
    {
        return $this->belongsTo(VehicleDetails::class, 'vehicle_id', 'id');
    }
}
