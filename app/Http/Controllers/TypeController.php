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

    public function store(Request $request){
        try {
            $data = $request->all();
        $type = Type::create([
            'name' => $data['name'],
        ]);
        toast('New service type added with success!','success');
        $type->save();

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
