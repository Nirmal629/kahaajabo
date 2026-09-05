<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleDetails extends Model
{
    protected $guarded = [];

    public function document()
    {
        return $this->hasOne(VehicleDocument::class, 'vehicle_id', 'id');
    }
}
