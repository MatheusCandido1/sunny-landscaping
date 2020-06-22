<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'discount', 'total', 'accepting_proposal', 'down_payment', 'final_balance', 'status', 'visit_id'
    ];

    public function items()
    {
        return $this->belongsToMany('App\Item', 'item_service',  'service_id', 'item_id')->withTimestamps();;
    }

    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }
}
