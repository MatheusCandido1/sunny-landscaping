<?php

namespace App\Http\Controllers;

use App;
use App\Visit;
use App\Type;
use App\Customer;
use App\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    public function visitsByCustomer($id){
        try {
            $visits = Visit::with('customers','types')->where('customer_id','=',$id)->get();
            
            return view('visits.index', ['customer' => $id, 'visits' => $visits,'types' => Type::all()]);
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
        $visit = Visit::create([
            'date' => $request->date,
            'call_customer_in' => $request->call_customer_in,
            'hoa' => $request->hoa,
            'water_smart_rebate' => $request->water_smart_rebate,
            'customer_id' => $request->customer_id,
            'status_id' => 1
        ]);

        for($i = 0; $i < count($request->type); $i++){
            $visit->types()->attach($request->type[$i]);
        }
        toast('Project created with success!','success');
        return redirect()->back();
    }
     catch (Throwable $e) {
        return redirect()->back();
        toast('Pleasy try again!','error');
    }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function details($id){
        try{
            $data = DB::table('visits')
            ->selectRaw('customers.id as customer_id, referrals.name as ref_name, cities.name as city_name, customers.state,customers.zipcode,customers.cross_street1, customers.cross_street2,customers.name as customer_name, customers.email, customers.phone, customers.cellphone, customers.address, customers.gate_code, visits.date, visits.invoice_number, statuses.id as visits_status, statuses.name as status_name, visits.contract_date, visits.call_customer_in, visits.hoa, visits.project_name, visits.water_smart_rebate, visits.id as visit_id')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'customers.city_id','=','cities.id')
            ->join('statuses', 'visits.status_id','=','statuses.id')
            ->join('referrals', 'customers.referral_id','=','referrals.id')
            ->where('visits.id','=', $id)
            ->get();
    
            $note = DB::table('notes')
            ->selectRaw('notes.id, notes.note, notes.created_at')
            ->join('visits', 'visits.id','=','notes.visit_id')
            ->where('notes.visit_id','=',$id)
            ->orderBy('created_at','ASC')
            ->get();


            $quoteStatus = DB::table('services')
            ->selectRaw('services.status')
            ->join('visits','visits.id','=','services.visit_id')
            ->where('services.status','=',1)
            ->where('visits.id', '=', $id)
            ->first();
            
    
            return view('visits.details', ['allow'=>$quoteStatus,'data' => $data[0],  'notes' => $note, 'statuses' => Status::all()]);
            }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
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
        $visit = Visit::where('visits.id','=',$id)->first();
        $typesSelected = $visit->types()->select('type_id')->get();
        
        for($i = 0; $i < count($typesSelected); $i++){
            $selecteds[$i] = $typesSelected[$i]->type_id;
        }
        return view('visits.edit', ['types' => Type::all(),'visit' => $visit, 'selecteds' => $selecteds]);
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
        $visit = Visit::where('id','=', $id)->first();
        $visit->fill($request->only('date','call_customer_in','hoa','status','water_smart_rebate'));
        $visit->save();

        for($i = 0; $i < count($request->type); $i++){
            $visit->types()->detach();
        }

        for($i = 0; $i < count($request->type); $i++){
            $visit->types()->attach($request->type[$i]);
        }
        toast('Visit updated with success!','success');
        return redirect()->route('visits.visitsByCustomer',$visit->customer_id);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function updateInformation(Request $request, $id)
    {
        try{
        $visit = Visit::where('id','=', $id)->first();
        $visit->fill($request->only('invoice_number','contract_date','project_name'));
        $visit->save();

        toast('Informations added with success!','success');
        return back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function updateStatus(Request $request, $visit_id, $status_id)
    {
        try{
            $visit = Visit::where('id','=', $visit_id)->first();
            $visit->status_id = $status_id;
            $visit->save();
            alert()->success('Visit updated!','Status updated with success');
            return redirect()->back();
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
    public function destroy(Visit $visit)
    {
        try{
        Visit::destroy($visit->id);
        toast('Visit deleted with success!','success');
        return back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
