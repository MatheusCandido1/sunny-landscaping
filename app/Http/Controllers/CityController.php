<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return view('cities.index', ['cities' => City::all()]);
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
        try {
            $data = $request->all();
            $city = city::create([
                'name' => $data['name'],
            ]);
            $city->save();
    
            toast('New city added with success!','success');
            return redirect()->route('cities.index'); 
            } catch (Throwable $e) {
                toast('Pleasy try again!','error');
    
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $city = DB::table('cities')->select('id','name')->where('cities.id','=',$id)->first();
            return view('cities.edit', ['city' => $city]);
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
            $city = City::where('id','=', $id)->first();
            $city->fill($request->only('name'));
            $city->save();

            toast('City updated with success!','success');

            return redirect()->route('cities.index'); 
            } catch (Throwable $e) {
                toast('Pleasy try again!','error');
    
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $city = City::where('id','=', $id)->first();
            $city->delete();

            toast('City deleted with success!','success');
            return redirect()->back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
        
    }
}
