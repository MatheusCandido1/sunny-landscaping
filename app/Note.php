<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Note extends Model
{
    protected $fillable = [
        'note_key','note','visit_id'
    ];

    public function visit()
    {
        return $this->belongsTo('App\Visit');
    }

    public function getLastNoteKey($visit_id)
    {
        return DB::table('notes')
        ->selectRaw('notes.note_key')
        ->where('notes.visit_id','=',$visit_id);
    }
}
