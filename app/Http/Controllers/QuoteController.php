<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Service;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = Service::create([
            'discount' => $request->discount,
            'total' => $request->subtotal,
            'accepting_proposal' => $request->accepting_proposal,
            'down_payment' => $request->down_payment,
            'final_balance' => $request->final_balance,
            'status' => 1,
            'visit_id' => $request->visit_id
        ]); 

        for ($i = 0; $i < count($request->input('id')); $i++) {
            $item[$i] = new Item();
            $item[$i]->supplier = $request->input('supplier')[$i];
            $item[$i]->description = $request->input('description')[$i];
            $item[$i]->quantity = $request->input('qnt')[$i];
            $item[$i]->type = $request->input('type')[$i];
            $item[$i]->unit_price = $request->input('unit_price')[$i];
            $item[$i]->investment = $request->input('investment')[$i];
            $item[$i]->save();
         $service->items()->attach($item[$i]);
        } 

        return redirect()->route('costumers.visitByCostumer',$request->visit_id);
        
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
    public function edit($id, $service_id)
    {
        $serviceData = DB::table('services')->select('discount','total','accepting_proposal','down_payment','final_balance')->where('services.visit_id','=',$id)->first();

        $itemData = DB::table('items')
        ->selectRaw('items.id, items.supplier, items.description, items.quantity, items.type, items.unit_price, items.investment')
        ->join('item_service','item_service.item_id','=','items.id')
        ->join('services','services.id','=','item_service.service_id')
        ->where('services.id', '=', $service_id)
        ->get();
        
        return view('quotes.edit', ['services' => $serviceData, 'items' => $itemData,'visit_id' => $id]);
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
