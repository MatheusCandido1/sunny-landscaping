<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'description', 'unit_cost', 'type', 'type_per'
    ];

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }

}
