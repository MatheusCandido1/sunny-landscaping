<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
         'supplier', 'description', 'quantity', 'type', 'unit_price', 'investment'
    ];

    public function service()
    {
        return $this->belongsToMany('App\Service','item_service',  'service_id', 'item_id');
    }
}
