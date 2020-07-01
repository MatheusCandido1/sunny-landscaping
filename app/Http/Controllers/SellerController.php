<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return view('sellers.index', ['sellers' =>Seller::all()]);
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
        $seller = Seller::create([
            'name' => $data['name'],
        ]);
        $seller->save();

        toast('New seller added with success!','success');
        return redirect()->route('sellers.index'); 
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    public function edit($id)
    {
        try{
            $seller = DB::table('sellers')->select('id','name')->where('sellers.id','=',$id)->first();
            return view('sellers.edit', ['seller' => $seller]);
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
            $seller = Seller::where('id','=', $id)->first();
            $seller->fill($request->only('name'));
            $seller->save();

            toast('Seller updated with success!','success');

            return redirect()->route('sellers.index'); 
            } catch (Throwable $e) {
                toast('Pleasy try again!','error');
    
            }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $seller = Seller::where('id','=', $id)->first();
            $seller->delete();

            toast('Seller deleted with success!','success');
            return redirect()->back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
        
    }
}
