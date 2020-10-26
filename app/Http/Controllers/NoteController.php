<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $note = new Note();
            $text = $request->note;
            $visit =  $request->visit_id;
            
            $note = $note->storeNote($visit, $text);


            toast('Note created with success!','success');
            return back();
        }
        catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        try{


        $noteKey = $note->getLastNoteKey($note->visit_id)->latest('note_key')->first();

        if($note->note_key == $noteKey->note_key) {
        Note::destroy($note->id);
        toast('Note deleted with success!','success');
        return back();
        }else{
            toast('You cannot delete this Note!','error'); 
            return redirect()->back();
        }
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
