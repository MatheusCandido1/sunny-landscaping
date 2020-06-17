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

        $items = [];

        for ($i = 0; $i < count($request->input('id')); $i++) {
            if($request->input('qnt')[$i] > 0) {
            $items[$i] = [
                'item_id' => $request->input('id')[$i],
                'quantity' => $request->input('qnt')[$i],
                'subtotal' => $request->input('total')[$i]
                ];
            }
        } 
        $service->items()->sync($items);
        return redirect()->route('costumers.visitByCostumer',$request->visit_id);
    }

    public function destroy(Service $service)
    {
        Service::destroy($service->id);
        return redirect()->back();
    }

}
