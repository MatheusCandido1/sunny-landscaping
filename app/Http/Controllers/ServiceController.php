<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Service;

class ServiceController extends Controller
{
    public function storeItems(Request $request)
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

    public function destroy(Service $service)
    {
        Service::destroy($service->id);
        return redirect()->back();
    }

}
