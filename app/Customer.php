<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'gender','address', 'cross_street1', 'cross_street2', 'gate_code',  'state', 'zipcode', 'phone', 'cellphone', 'email','parcel_number','company','company_name','company_address','company_state','company_city','company_zipcode','referral_id','city_id','seller_id'
    ];

    public function Referral()
    {
        return $this->belongsTo('App\Referral');
    }

    public function City()
    {
        return $this->belongsTo('App\City');
    }

    public function Seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }
}
