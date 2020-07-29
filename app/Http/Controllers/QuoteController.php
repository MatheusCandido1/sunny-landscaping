<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Service;
use RealRashid\SweetAlert\Facades\Alert;
use App\Supplier;

class QuoteController extends Controller
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
        $service = Service::create([
            'discount' => $request->discount,
            'total' => $request->subtotal,
            'subtotal' => $request->total,
            'accepting_proposal' => $request->accepting_proposal,
            'down_payment' => $request->down_payment,
            'final_balance' => $request->final_balance,
            'notes' => $request->notes,
            'status' => 4,
            'visit_id' => $request->visit_id
        ]); 


        for ($i = 0; $i < count($request->input('id')); $i++) {
            $item[$i] = new Item();
            $item[$i]->description = $request->input('description')[$i];
            $item[$i]->quantity = $request->input('qnt')[$i];
            $item[$i]->type = $request->input('type')[$i];
            $item[$i]->unit_price = $request->input('unit_price')[$i];
            $item[$i]->investment = $request->input('investment')[$i];
            $item[$i]->group_type = $request->input('group_type')[$i];
            $item[$i]->save();
            $service->items()->attach($item[$i]);
        } 
        toast('Quote created with success!','success');

        return redirect()->route('services.servicesByVisit',['visit' => $request->visit_id, 'customer' => $request->customer_id]);
    }catch (Throwable $e) {
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

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
        $service = Service::where('id','=', $id)->first();
        $service->fill($request->only('discount','total','subtotal','accepting_proposal','down_payment','status','notes','visit','final_balance'));
        $service->save();
        $items = $service->items()->select('id')->get();
        for($i = 0; $i < count($request->input('id')); $i++){
            if($request->input('id')[$i] != null){
            $service->items()->detach();
            }
        }

        for($i = 0; $i < $items->count(); $i++){
            Item::where('id','=', $items[$i]->id)->delete();
         }

         for ($i = 0; $i < count($request->input('id')); $i++) {
            $item[$i] = new Item();
            $item[$i]->description = $request->input('description')[$i];
            $item[$i]->quantity = $request->input('qnt')[$i];
            $item[$i]->type = $request->input('type')[$i];
            $item[$i]->unit_price = $request->input('unit_price')[$i];
            $item[$i]->investment = $request->input('investment')[$i];
            $item[$i]->group_type = $request->input('group_type')[$i];
            $item[$i]->save();
         $service->items()->attach($item[$i]);
        } 

        toast('Quote updated with success!','success');

        return redirect()->route('services.servicesByVisit',['visit' => $request->visit_id, 'customer' => $request->customer_id]);
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
