<?php

namespace App\Http\Controllers;

use App;
use App\Costumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('costumers.index', ['costumers' => Costumer::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('costumers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $costumer = new Costumer($request->only('name', 'address', 'gate_code', 'phone', 'cellphone', 'email'));
            $costumer->save();
            return redirect()->route('costumers.index');
    }

    public function projectsByCostumer($id) 
    {
        $projects = DB::table('costumer_visit')
        ->selectRaw(' costumer_visit.id as project_id, visits.id, costumers.name, visits.date, visits.type')
        ->join('visits','visits.id','=','costumer_visit.visit_id')
        ->join('costumers','costumers.id','=','costumer_visit.costumer_id')
        ->where('costumers.id','=', $id)
        ->get();
        return view('costumers.projects', ['projects' => $projects, 'id' => $id]);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    
    */

    public function visitByCostumer($id)
    {
        $data = DB::table('costumer_visit')
        ->selectRaw('costumers.*, visits.*')
        ->join('visits','visits.id','=','costumer_visit.visit_id')
        ->join('costumers','costumers.id','=','costumer_visit.costumer_id')
        ->where('visits.id','=', $id)
        ->get();
        return view('costumers.show', ['data' => $data[0]]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
