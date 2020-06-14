<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'date', 'call_costumer_min', 'hoa', 'water_smart_rebate', 'type', 'costumer_id'
    ];

    public function costumer(){
        return $this->belongsTo("App\Costumer");
    }
}
