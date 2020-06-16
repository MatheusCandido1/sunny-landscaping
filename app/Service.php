<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'final_balance', 'status', 'visit_id'
    ];

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }
}
