<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChangeOrder extends Model
{
    protected $fillable = [
        'change_order_key','date','discount', 'subtotal','original_contract_amount', 'change_order_amount', 'revised_contract_amount', 'option_1','status', 'visit_id'
    ];

    public function elements()
    {
        return $this->belongsToMany('App\Element','element_changeorder', 'changeorder_id', 'element_id')->withTimestamps();;
    }

    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }

    public function getLastChangeOrderKey($visit_id)
    {
        return DB::table('change_orders')
        ->selectRaw('change_order_key')
        ->where('visit_id','=',$visit_id);
    }
}
