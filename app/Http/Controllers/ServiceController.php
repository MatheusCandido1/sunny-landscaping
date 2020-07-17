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
    public function createQuote($visit_id, $customer_id)
    {
        try{
       return view('services.create', ['suppliers' => \App\Supplier::all(), 'visit_id' => $visit_id, 'customer_id' => $customer_id]);
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
        toast('Quote duplicated with success!','success');
        return redirect()->back();
    }catch (Throwable $e) {
        toast('Pleasy try again!','error');
    }
        
    }

    public function editQuote($visit_id, $service_id, $customer_id)
    {
        try{
        $serviceData = DB::table('services')->select('id','discount','total','accepting_proposal','down_payment','notes','final_balance')->where('services.id','=',$service_id)->first();

        $itemData = DB::table('items')
        ->selectRaw('items.id, items.supplier, items.description, items.quantity, items.type, items.unit_price, items.investment, items.group_type')
        ->join('item_service','item_service.item_id','=','items.id')
        ->join('services','services.id','=','item_service.service_id')
        ->where('services.id', '=', $service_id)
        ->get();

        return view('services.edit', ['suppliers' => \App\Supplier::all(), 'service_id'=> $service_id,'service' => $serviceData, 'items' => $itemData, 'customer_id' => $customer_id,'visit_id' => $visit_id]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function servicesByVisit($visit_id, $customer_id){
        try {
            $services = Service::where('visit_id','=',$visit_id)->orderBy('created_at','asc')->get();
            return view('services.index', ['customer' => $customer_id,'services' => $services,'visit_id' => $visit_id]);
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function changeOrder(){
        try {
            return view('services.change');
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    

    public function waiting($service_id, $visit_id){
        try{
            $has_service = 0;
            $service = Service::where('id','=',$service_id)->where('visit_id','=',$visit_id)->first();
            $service->status = 3;
            $service->save();

            $services = Service::where('visit_id','=',$visit_id)->orderBy('created_at','asc')->get();
            for($i = 0; $i < $services->count(); $i++){
                if($services[$i]->status == '2' || $services[$i]->status == '3')
                {
                    $has_service++;
                }
            }


            if($has_service == $services->count())
            {
                $visit = Visit::where('id','=', $visit_id)->first();
                $visit->has_services = 0;
                $visit->save();
            }
            alert()->success('Quote waiting','Please let me know when it gets approved or not!');
            return redirect()->back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }


    public function approve($service_id, $visit_id){
        try{
            $service = Service::where('id','=',$service_id)->where('visit_id','=',$visit_id)->first();
            
            $visit = Visit::where('id','=', $visit_id)->first();
            
            $service->status = 1;
            $service->save();
            $visit->has_services = 1;
            $visit->save();
            alert()->success('Quote approved','Now, all the documents will be generated with this quote information!');
            return redirect()->back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function disapprove($service_id, $visit_id){
        try{
            $has_service = 0;
            $service = Service::where('id','=',$service_id)->where('visit_id','=',$visit_id)->first();
            $service->status = 2;
            $service->save();

            $services = Service::where('visit_id','=',$visit_id)->orderBy('created_at','asc')->get();
            for($i = 0; $i < $services->count(); $i++){
                if($services[$i]->status == '2' || $services[$i]->status == '3')
                {
                    $has_service++;
                }
            }


            if($has_service == $services->count())
            {
                $visit = Visit::where('id','=', $visit_id)->first();
                $visit->has_services = 0;
                $visit->save();
            }

            alert()->success('Quote Not Approved','the documents will be generated only with approved quote information!');
            return redirect()->back();
        }catch (Throwable $e) {
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
