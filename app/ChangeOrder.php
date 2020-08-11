<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeOrder extends Model
{
    protected $fillable = [
        'date','discount', 'subtotal','original_contract_amount', 'change_order_amount', 'revised_contract_amount', 'option_1','status', 'visit_id'
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
