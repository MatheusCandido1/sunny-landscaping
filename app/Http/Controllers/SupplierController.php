<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use RealRashid\SweetAlert\Facades\Alert;


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
