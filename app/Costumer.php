<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    protected $fillable = [
        'name', 'address', 'city', 'gate_code', 'phone', 'cellphone', 'email'
    ];

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }
}
