<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeOrder extends Model
{
    protected $fillable = [
        'date', 'original_contract_amount', 'change_order_amount', 'down_payment', 'revise_contract_amout', 'status', 'visit_id'
    ];

    public function elements()
    {
        return $this->belongsToMany('App\Element','element_changeorder', 'changeorder_id', 'element_id')->withTimestamps();;
    }

    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }
}
