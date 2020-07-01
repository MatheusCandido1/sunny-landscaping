<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use RealRashid\SweetAlert\Facades\Alert;

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
}
