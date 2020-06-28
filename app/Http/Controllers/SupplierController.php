<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        return view('suppliers.index', ['suppliers' => Supplier::all()]);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier = Supplier::where('id','=', $supplier->id)->first();
        $supplier->delete();
        return redirect()->back();
    }
}
