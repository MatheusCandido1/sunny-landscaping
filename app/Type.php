<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name'
    ];

    public function visits()
    {
        return $this->belongsToMany('App\Visit', 'visit_type',  'visit_id', 'type_id')->withTimestamps();;
    }
}
