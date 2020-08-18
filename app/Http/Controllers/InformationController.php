<?php

namespace App\Http\Controllers;

use App\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $info = DB::table('informations')->first();
            return view('informations.index', ['info' => $info]);
        }
        catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function show(Information $information)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $info = DB::table('informations')->select('id','address','phone1', 'phone2')->where('informations.id','=',$id)->first();
            return view('informations.edit', ['info' => $info]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $info = Information::where('id','=', $id)->first();
            $info->fill($request->only('address','phone1','phone2'));
            $info->save();

            toast('Information updated with success!','success');

            return redirect()->route('informations.index'); 
            } catch (Throwable $e) {
                toast('Pleasy try again!','error');
    
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function destroy(Information $information)
    {
        //
    }
}
