<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'name'
    ];

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
