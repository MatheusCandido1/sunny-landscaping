<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'date', 'call_costumer_min', 'hoa', 'water_smart', 'cross_streets'
    ];

    public function costumer(){
        return $this->belongsTo("App\Costumer");
    }
}
