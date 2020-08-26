<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'name'
    ];

    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    public function getStatusName($id){
        $status =  Status::where('id','=', $id)->first();
        $name = $status->name;
        return $name;
    }
}
