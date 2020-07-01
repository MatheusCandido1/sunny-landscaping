<?php

namespace App\Http\Controllers;

use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return view('referrals.index', ['referrals' =>Referral::all()]);
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
            $referral = Referral::create([
                'name' => $data['name'],
            ]);
            $referral->save();
    
            toast('New referral added with success!','success');
            return redirect()->route('referrals.index'); 
            } catch (Throwable $e) {
                toast('Pleasy try again!','error');
    
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function show(Referral $referral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $referral = DB::table('referrals')->select('id','name')->where('referrals.id','=',$id)->first();
            return view('referrals.edit', ['referral' => $referral]);
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
            $referral = Referral::where('id','=', $id)->first();
            $referral->fill($request->only('name'));
            $referral->save();

            toast('Referral updated with success!','success');

            return redirect()->route('referrals.index'); 
            } catch (Throwable $e) {
                toast('Pleasy try again!','error');
    
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Referral  $referral
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $referral = Referral::where('id','=', $id)->first();
            $referral->delete();

            toast('Referral deleted with success!','success');
            return redirect()->back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
        
    }
}
