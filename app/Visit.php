<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'date', 'call_costumer_in', 'hoa', 'water_smart_rebate', 'type'
    ];

    public function costumers()
    {
        return $this->belongsToMany('App\Costumer');
    }
}
