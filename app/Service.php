<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Service extends Model
{
    protected $fillable = [
        'quote_key','discount', 'total', 'subtotal', 'accepting_proposal', 'down_payment', 'final_balance', 'notes','status', 'visit_id'
    ];

    public function items()
    {
        return $this->belongsToMany('App\Item','item_service', 'service_id', 'item_id')->withTimestamps();;
    }

    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }

    public function getLastQuoteKey()
    {
        return DB::table('services')
        ->selectRaw('quote_key');
    }
}
