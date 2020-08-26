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

    public function storeNote($visit_id, $text)
    {
            $note = new Note();
            $noteKey = $note->getLastNoteKey($visit_id)->latest()->first();

            if(isset($noteKey)){
            $newNoteKey = 0;
            $newNoteKey = $noteKey->note_key + 1;
            }else{
                $newNoteKey = 1;
            }


        $notes = Note::create([
            'note_key' => $newNoteKey,
            'note' => $text,
            'visit_id' => $visit_id
        ]); 
    }
}
