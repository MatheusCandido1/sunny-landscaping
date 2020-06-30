<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'address', 'cross_street1', 'cross_street2', 'gate_code', 'city', 'state', 'zipcode', 'phone', 'cellphone', 'email','referred'
    ];

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }
}
