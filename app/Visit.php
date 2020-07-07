<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'date', 'call_customer_in', 'hoa', 'water_smart_rebate', 'invoice_number', 'payment_amout', 'contract_date','customer_id'
    ];

    public function customers()
    {
        return $this->belongsTo('App\Customer');
    }

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function changeorders()
    {
        return $this->hasMany('App\ChangeOrder');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }

    public function types()
    {
        return $this->belongsToMany('App\Type', 'visit_type',  'visit_id', 'type_id')->withTimestamps();;
    }
}
