<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Visit;
use App\ChangeOrder;
use App\Element;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
            $lastchangeorders = ChangeOrder::where('visit_id','=',$visit_id)->orderBy('change_order_key','desc')->first();

            return view('changeorders.index', ['last' =>$lastchangeorders->id, 'changeorders' => $changeorders ,'visit' => $visit_id, 'customer' => $customer_id]);
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createChangeOrder($visit_id, $customer_id){
        try{

            $itemData = DB::table('items')
            ->selectRaw('services.quote_key as service_id, items.group_type,items.id,items.description, items.quantity, items.type, items.unit_price, items.investment')
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
            ->first();


            $total = $amount->total;


            return view('changeorders.create', ['customer'=> $customer_id, 'visit' => $visit_id,'itemData' => $itemData,'change_amount' => $total]);
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
        $visit = $request->visit_id;
        $newChangeOrder = new ChangeOrder();
        $changeOrderKey = $newChangeOrder->getLastChangeOrderKey($visit)->latest()->first();

        if(isset($changeOrderKey)){
        $newChangeOrderKey = 0;
        $newChangeOrderKey = $changeOrderKey->change_order_key + 1;
        $newOriginalAmount = $newChangeOrder->getLastChangeOrderAmount($visit)->latest()->first();
        $originalAmount = $newOriginalAmount->revised_contract_amount;
        $newChangeOrderAmount = $request->change_order_amount;
        $newRevised = $originalAmount + $newChangeOrderAmount;
        }else{
            $newChangeOrderKey = 1;  
        }
        try{
            if(isset($changeOrderKey)){
                $changeOrder = ChangeOrder::create([
                    'change_order_key' => $newChangeOrderKey,
                    'date' => $request->date,
                    'discount' => $request->discount,
                    'subtotal' => $request->subtotal,
                    'original_contract_amount' => $newOriginalAmount->revised_contract_amount,
                    'change_order_amount' => $request->change_order_amount,
                    'revised_contract_amount' => $newRevised,
                    'option_1' => $request->option_1,
                    'status' => 1,
                    'visit_id' => $visit
                ]); 
            }else{
                $changeOrder = ChangeOrder::create([
                    'change_order_key' => $newChangeOrderKey,
                    'date' => $request->date,
                    'discount' => $request->discount,
                    'subtotal' => $request->subtotal,
                    'original_contract_amount' => $request->original_contract_amount,
                    'change_order_amount' => $request->change_order_amount,
                    'revised_contract_amount' => $request->revised_contract_amount,
                    'option_1' => $request->option_1,
                    'status' => 1,
                    'visit_id' => $visit
                ]); 
            }

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

    public function editChangeOrder($changeorder, $visit, $customer) {
        $lastchangeorders = ChangeOrder::where('visit_id','=',$visit)->orderBy('change_order_key','desc')->first();

        if($lastchangeorders->id != $changeorder)
        {
            toast('You cannot edit this Change Order!','error'); 
            return redirect()->back();
        } else {
        $changeorderData = DB::table('change_orders')->select('id','change_order_key','date','discount','subtotal','original_contract_amount','change_order_amount','revised_contract_amount','option_1','status','visit_id')->where('change_orders.id','=',$changeorder)->first();

        $amount = DB::table('services')
            ->selectRaw('sum(services.total) as total')
            ->join('visits', 'visits.id','=','services.visit_id')
            ->where('services.status','=','1')
            ->where('visits.id','=',$visit)
            ->first();


            $total = $amount->total;

        $itemData = DB::table('items')
        ->selectRaw('services.quote_key as service_id, items.group_type,items.id,items.description, items.quantity, items.type, items.unit_price, items.investment')
        ->join('item_service','item_service.item_id','=','items.id')
        ->join('services','services.id','=','item_service.service_id')
        ->join('visits','visits.id','=','services.visit_id')
        ->where('visits.id', '=', $visit) 
        ->where('services.status', '=', 1)
        ->get()
        ->groupBy('group_type');

        $elementData = DB::table('elements')
        ->selectRaw('elements.id, elements.target, elements.investment, elements.quantity, elements.description, elements.unit_price, elements.type')
        ->join('element_changeorder','element_changeorder.element_id','=','elements.id')
        ->join('change_orders','change_orders.id','=','element_changeorder.changeorder_id')
        ->where('change_orders.id', '=', $changeorder)
        ->get(); 

        return view('changeorders.edit', ['change_amount' => $total, 'changeorder_id' => $changeorder, 'elementData'=>$elementData, 'itemData' => $itemData, 'visit' => $visit, 'customer'=>$customer, 'changeorder' => $changeorderData]);
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
    public function update(Request $request, $id)
    {
        $changeorder = ChangeOrder::where('id','=', $id)->first();

        $changeorder->fill($request->only('date','discount','subtotal','original_contract_amount','change_order_amount','revised_contract_amount','option_1','status'));
        $changeorder->save();

      
        $elements = $changeorder->elements()->select('id')->get();
        for($i = 0; $i < count($request->input('id')); $i++){
            if($request->input('id')[$i] != null){
            $changeorder->elements()->detach();
            }
        }

        for($i = 0; $i < $elements->count(); $i++){
            Element::where('id','=', $elements[$i]->id)->delete();
         }

         for ($i = 0; $i < count($request->input('id')); $i++) {
            $element[$i] = new Element();
            $element[$i]->target = $request->input('target')[$i];
            $element[$i]->description = $request->input('description')[$i];
            $element[$i]->quantity = $request->input('quantity')[$i];
            $element[$i]->type = $request->input('type')[$i];
            $element[$i]->unit_price = $request->input('unit_price')[$i];
            $element[$i]->investment = $request->input('investment')[$i];
            $element[$i]->save();
            $changeorder->elements()->attach($element[$i]);
        } 

        toast('Change Order updated with success!','success');

        return redirect()->route('changeorders.changes', ['visit'=>$request->visit_id,'customer'=>$request->customer_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChangeOrder  $changeOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChangeOrder $changeorder)
    {
        try{
            $changeorder = ChangeOrder::where('id','=', $changeorder->id)->first();
            
            $newChangeOrder = new ChangeOrder();
            $changeOrderKey = $newChangeOrder->getLastChangeOrderKey($changeorder->visit_id)->latest()->first();

            if($changeOrderKey->change_order_key == $changeorder->change_order_key){
                $elements = $changeorder->elements()->select('id')->get();
            
                for($i = 0; $i < $elements->count(); $i++){
                Element::where('id','=', $elements[$i]->id)->delete();
                }
                $changeorder->delete();
                
                toast('Change order deleted with success!','success');
                return redirect()->back();
            }else{
                toast('You cannot delete this Change Order!','error'); 
                return redirect()->back();
            }
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
