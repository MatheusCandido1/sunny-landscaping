<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class TypeController extends Controller
{
    public function index()
    {
        try{
            return view('types.index', ['types' =>Type::all()]);
        }
        catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function store(Request $request){
        try {
            $data = $request->all();
        $type = Type::create([
            'name' => $data['name'],
        ]);
        $type->save();
        toast('New service type added with success!','success');

        return redirect()->route('types.index'); 
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');

        }
        
    }

    public function edit($id)
    {
        try{
            $type = DB::table('types')->select('id','name')->where('types.id','=',$id)->first();
            return view('types.edit', ['type' => $type]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $type = type::where('id','=', $id)->first();
            $type->fill($request->only('name'));
            $type->save();
            toast('Service type updated with success!','success');
            return redirect()->route('types.index'); 
            } catch (Throwable $e) {
                toast('Pleasy try again!','error');
    
            }
    }

    public function destroy($id)
    {
        try{
            $type = Type::where('id','=', $id)->first();
            $type->delete();
            toast('Service type deleted with success!','success');
            return redirect()->back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
        
    }
}
