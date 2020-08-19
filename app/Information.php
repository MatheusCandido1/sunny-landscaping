<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = "informations";

    protected $fillable = [
        'address','address2','phone1', 'phone2'
    ];
}
