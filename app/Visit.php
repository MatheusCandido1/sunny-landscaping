<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'name', 'date', 'call_costumer_in', 'hoa', 'water_smart_rebate'
    ];

    public function costumers()
    {
        return $this->belongsToMany('App\Costumer');
    }

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function notes(){
        return $this->hasMany('App\Note');
    }

    public function types()
    {
        return $this->belongsToMany('App\Type', 'visit_type',  'visit_id', 'type_id')->withTimestamps();;
    }
}
