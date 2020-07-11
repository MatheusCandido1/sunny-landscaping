<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = [
        'target', 'description', 'quantity', 'type', 'unit_price', 'investment'
   ];

   public function changeorder()
   {
       return $this->belongsToMany('App\ChangeOrder','element_changeorder', 'changeorder_id', 'element_id')->withTimestamps();
   }
}
