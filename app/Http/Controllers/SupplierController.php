<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


class SupplierController extends Controller
{
    public function index()
    {
        try{
            return view('suppliers.index', ['suppliers' => Supplier::all()]);
        }
        catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function edit($id)
    {
        try{
            $supplier = DB::table('suppliers')->select('id','name','value')->where('suppliers.id','=',$id)->first();
            return view('suppliers.edit', ['supplier' => $supplier]);
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
            $supplier = Supplier::where('id','=', $id)->first();
            $supplier->fill($request->only('name','value'));
            $supplier->save();

            toast('Supplier updated with success!','success');
            return redirect()->route('suppliers.index'); 
            } catch (Throwable $e) {
                toast('Pleasy try again!','error');
    
            }
    }

    public function destroy(Supplier $supplier)
    {
        try{
        $supplier = Supplier::where('id','=', $supplier->id)->first();
        $supplier->delete();
        toast('Supplier deleted with success!','success');
        return redirect()->back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
