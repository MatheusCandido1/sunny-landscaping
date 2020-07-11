<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Visit;
use App\ChangeOrder;
use App\Element;
use RealRashid\SweetAlert\Facades\Alert;

class ChangeOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function changeOrderByVisit($visit_id, $customer_id){
        try {
            $changeorders = ChangeOrder::where('visit_id','=',$visit_id)->orderBy('created_at','asc')->get();
            return view('changeorders.index', ['changeorders' => $changeorders ,'visit' => $visit_id, 'customer' => $customer_id]);
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try{
            return view('services.create', ['suppliers' => \App\Supplier::all(), 'visit_id' => $id]);
             }catch (Throwable $e) {
                 toast('Pleasy try again!','error');
             }
    }

    public function createChangeOrder($visit_id, $customer_id){
        try{

            $itemData = DB::table('items')
            ->selectRaw('services.id as service_id, items.group_type,items.id, items.supplier, items.description, items.quantity, items.type, items.unit_price, items.investment')
            ->join('item_service','item_service.item_id','=','items.id')
            ->join('services','services.id','=','item_service.service_id')
            ->join('visits','visits.id','=','services.visit_id')
            ->where('visits.id', '=', $visit_id) 
            ->where('services.status', '=', 1)
            ->get()
            ->groupBy('group_type');
            

            $amount = DB::table('services')
            ->selectRaw('sum(services.total) as total')
            ->join('visits', 'visits.id','=','services.visit_id')
            ->where('services.status','=','1')
            ->where('visits.id','=',$visit_id)
            ->get();

            return view('changeorders.create', ['customer'=> $customer_id, 'visit' => $visit_id,'itemData' => $itemData,'amount' => $amount]);
         }catch (Throwable $e) {
          toast('Pleasy try again!','error');
      }
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
            $changeOrder = ChangeOrder::create([
                'date' => $request->date,
                'discount' => $request->discount,
                'original_contract_amount' => $request->original_contract_amount,
                'change_order_amount' => $request->change_order_amount,
                'revised_contract_amount' => $request->revised_contract_amount,
                'status' => 1,
                'visit_id' => $request->visit_id
            ]); 

            for ($i = 0; $i < count($request->input('id')); $i++) {
                $element[$i] = new Element();
                $element[$i]->target = $request->input('target')[$i];
                $element[$i]->description = $request->input('description')[$i];
                $element[$i]->quantity = $request->input('quantity')[$i];
                $element[$i]->type = $request->input('type')[$i];
                $element[$i]->unit_price = $request->input('unit_price')[$i];
                $element[$i]->investment = $request->input('investment')[$i];
                $element[$i]->save();
                $changeOrder->elements()->attach($element[$i]);
            } 

            toast('Change Order created with success!','success');
            return redirect()->route('changeorders.changes', ['visit'=>$request->visit_id,'customer'=>$request->customer_id]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChangeOrder  $changeOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ChangeOrder $changeOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChangeOrder  $changeOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(ChangeOrder $changeOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChangeOrder  $changeOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChangeOrder $changeOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChangeOrder  $changeOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChangeOrder $changeOrder)
    {
        //
    }
}
