<?php

namespace App\Http\Controllers;

use App;
use App\Costumer;
use App\Item;
use App\Suppllier;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;
use TJGazel\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;



class CostumerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('costumers.index', ['costumers' => Costumer::all()]);
        } catch (Throwable $e) {
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
        try {
            $data = $request->all();
        if(isset($data['cellphone'])){
            $cellphone = true;
        }else{
            $cellphone = false;

        }

        $costumer = costumer::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'cross_street1' => $data['cross_street1'],
            'cross_street2' => $data['cross_street2'],
            'gate_code' => $data['gate_code'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zipcode' => $data['zipcode'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'cellphone' => $cellphone,
            'referred' => $referred
        ]);
        toast('New costumer added with success!','success');

        $costumer->save();

        return redirect()->route('costumers.index'); 
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');

        }
        
    }

    public function projectsByCostumer($id) 
    {
        try {
            $projects = DB::table('costumer_visit')
            ->selectRaw('costumers.name as cost_name, costumer_visit.id as project_id, visits.id, visits.name, visits.date')
            ->join('visits','visits.id','=','costumer_visit.visit_id')
            ->join('costumers','costumers.id','=','costumer_visit.costumer_id')
            ->where('costumers.id','=', $id)
            ->get();
            return view('costumers.projects', ['types' => Type::all(), 'projects' => $projects, 'id' => $id]);
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');

        }
       
    }

    public function Quote($id)
    {
        try {
            return view('quotes.create', ['suppliers' => \App\Supplier::all(), 'visit_id' => $id]);
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }

    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    
    */

    public function visitByCostumer($id)
    {
        try{
        $data = DB::table('costumer_visit')
        ->selectRaw('costumers.referred, costumers.city, costumers.state,costumers.zipcode,costumers.cross_street1, costumers.cross_street2,costumers.name as costumer_name, costumers.email, costumers.phone, costumers.cellphone, costumers.address, costumers.gate_code, visits.name as visit_name, visits.date, visits.call_costumer_in, visits.hoa, visits.water_smart_rebate, visits.id as visit_id')
        ->join('visits','visits.id','=','costumer_visit.visit_id')
        ->join('costumers','costumers.id','=','costumer_visit.costumer_id')
        ->where('visits.id','=', $id)
        ->get();

        $quoteStatus = DB::table('services')
        ->selectRaw('services.id, services.status, services.final_balance, sum(items.investment), services.discount, services.accepting_proposal, services.down_payment')
        ->join('item_service','item_service.service_id','=','services.id')
        ->join('visits','visits.id','=','services.visit_id')
        ->join('items', 'item_service.item_id','=', 'items.id')
        ->join('costumer_visit','costumer_visit.visit_id','=','visits.id')
        ->join('costumers','costumers.id','=','costumer_visit.costumer_id')
        ->where('costumer_visit.visit_id', '=', $id)
        ->get();

        $note = DB::table('notes')
        ->selectRaw('notes.id, notes.note, notes.created_at')
        ->join('visits', 'visits.id','=','notes.visit_id')
        ->where('notes.visit_id','=',$id)
        ->orderBy('created_at','ASC')
        ->get();

        if(is_null($quoteStatus[0]->status))
        {
            $check = false;
            return view('costumers.show', ['data' => $data[0], 'quote_info' => $check, 'notes' => $note]);
        }
        else
        {
         $check = true;
        return view('costumers.show', ['data' => $data[0], 'quote_info' => $check, 'quote_data' => $quoteStatus[0], 'notes' => $note]);
        }
    }catch (Throwable $e) {
        toast('Pleasy try again!','error');
    }

        

    }

    public function show(){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $costumer = DB::table('costumers')->select('id','name','address','cross_street1','cross_street2','gate_code','city','state','zipcode','phone','cellphone','email','referred')->where('costumers.id','=',$id)->first();
            return view('costumers.edit', ['costumer' => $costumer]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
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
        try{
            $costumer = costumer::where('id','=', $id)->first();
            $costumer->fill($request->only('name','address','cross_street1','cross_street2','gate_code','city','state','zipcode','phone','cellphone','email','referred'));
            $costumer->save();
            toast('Costumer updated with success!','success');
    
            return redirect()->route('costumers.index');
            }catch (Throwable $e) {
                toast('Pleasy try again!','error');
            }
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
