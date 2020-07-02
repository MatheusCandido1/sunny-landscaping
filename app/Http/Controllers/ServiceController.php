<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Service;
use App\Supplier;
use App\Visit;
use RealRashid\SweetAlert\Facades\Alert;


class ServiceController extends Controller
{
    public function createQuote($id)
    {
        try{
       return view('services.create', ['suppliers' => \App\Supplier::all(), 'visit_id' => $id]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }


    public function duplicateQuote($service_id)
    {
        try{
        $service = Service::find($service_id);
        $newService = $service->replicate();
        $newService->push();

        $items = $service->items()->select('id')->get();

        for($i = 0; $i < count($items); $i++){
        $item = Item::find($items[$i]->id);
        $newItem = $item->replicate();
        $newItem->push();
        $newService->items()->attach($newItem);
        }

        return redirect()->back();
    }catch (Throwable $e) {
        toast('Pleasy try again!','error');
    }
        
    }

    public function editQuote($id, $service_id)
    {
        try{
        $serviceData = DB::table('services')->select('id','discount','total','accepting_proposal','down_payment','final_balance')->where('services.visit_id','=',$id)->first();

        $itemData = DB::table('items')
        ->selectRaw('items.id, items.supplier, items.description, items.quantity, items.type, items.unit_price, items.investment, items.group_type')
        ->join('item_service','item_service.item_id','=','items.id')
        ->join('services','services.id','=','item_service.service_id')
        ->where('services.id', '=', $service_id)
        ->get();

        return view('services.edit', ['suppliers' => \App\Supplier::all(), 'service' => $serviceData, 'items' => $itemData,'visit_id' => $id]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function servicesByVisit($id){
        try {
            $services = Service::where('visit_id','=',$id)->get();
            return view('services.index', ['services' => $services,'visit_id' => $id]);
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');

        }
    }

    

    public function destroy(Service $service)
    {
        try{
        $service = Service::where('id','=', $service->id)->first();
        $items = $service->items()->select('id')->get();

        for($i = 0; $i < $items->count(); $i++){
           Item::where('id','=', $items[$i]->id)->delete();
        }
        $service->delete();
        
        toast('Quote deleted with success!','success');
        return redirect()->back();
    }catch (Throwable $e) {
        toast('Pleasy try again!','error');
    }
    }

}
