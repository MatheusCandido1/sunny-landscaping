<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'note','visit_id'
    ];

    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }
}
