<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Service;
use App\Visit;
use App\Customer;
use RealRashid\SweetAlert\Facades\Alert;


class ServiceController extends Controller
{
    public function createQuote($visit_id, $customer_id)
    {
        try{
       return view('services.create', [ 'visit_id' => $visit_id, 'customer_id' => $customer_id]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }


    public function duplicateQuote($service_id)
    {
        $quote = new Service();
        $quote_key = $quote->getLastQuoteKey()->latest()->first();

        try{
        $service = Service::find($service_id);
        $service->quote_key = $quote_key->quote_key + 1;
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
        $serviceData = DB::table('services')->select('id','quote_key','discount','subtotal','total','accepting_proposal','down_payment','notes','final_balance')->where('services.id','=',$service_id)->first();

        $itemData = DB::table('items')
        ->selectRaw('items.id, items.description, items.quantity, items.type, items.unit_price, items.investment, items.group_type')
        ->join('item_service','item_service.item_id','=','items.id')
        ->join('services','services.id','=','item_service.service_id')
        ->where('services.id', '=', $service_id)
        ->get();

        $pavers = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','1 - PAVERS')->groupBy('items.group_type')->first();
        $walls = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','2 - RETAINING WALL')->groupBy('items.group_type')->first();
        $grass = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','3 - GRASS')->groupBy('items.group_type')->first();
        $trees = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','4 - TREES AND PLANTS')->groupBy('items.group_type')->first();
        $irrigation = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','5 - IRRIGATION')->groupBy('items.group_type')->first();
        $rocks = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','6 - ROCKS')->groupBy('items.group_type')->first();
        $fire = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','7 - FIRE PIT')->groupBy('items.group_type')->first();
        $drainage = DB::table('items')->selectRaw('items.group_type, count(*) as quantity') ->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','8 - DRAINAGE')->groupBy('items.group_type')->first();
        $trans = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','9 - TRANSFORMER AND LED LIGHTS')->groupBy('items.group_type')->first();
        $dumpster = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','10 - DUMPSTER')->groupBy('items.group_type')->first();
        $labor = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','11 - LABOR')->groupBy('items.group_type')->first();
        $extra = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','12 - EXTRA')->groupBy('items.group_type')->first();
        $others = DB::table('items')->selectRaw('items.group_type, count(*) as quantity')->join('item_service','item_service.item_id','=','items.id')->join('services','services.id','=','item_service.service_id')->where('services.id', '=', $service_id)->where('items.group_type','=','13 - OTHERS')->groupBy('items.group_type')->first();

        //dd($others);
        return view('services.edit', ['extra' => $extra, 'others' => $others, 'grass' => $grass, 'trees' => $trees, 'irrigation' => $irrigation, 'rocks' => $rocks, 'fire' => $fire, 'trans' => $trans, 'dumpster' => $dumpster,'labor' => $labor,'drainage' => $drainage, 'pavers' => $pavers, 'walls' => $walls,  'service_id'=> $service_id,'service' => $serviceData, 'items' => $itemData, 'customer_id' => $customer_id,'visit_id' => $visit_id]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function servicesByVisit($visit_id, $customer_id){
        try {

            $customer_name = Customer::where('id','=', $customer_id)->first();
            $services = Service::where('visit_id','=',$visit_id)->orderBy('created_at','desc')->get();
            return view('services.index', ['customer_name' => $customer_name->name, 'customer' => $customer_id,'services' => $services,'visit_id' => $visit_id]);
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

    public function select($service_id, $visit_id){
        try{
            $service = Service::where('id','=',$service_id)->where('visit_id','=',$visit_id)->first();
            $service->status = 4;
            $service->save();
            alert()->success('Quote selected','Now, all the documents will be generated with this quote information!');
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
            $visit->status_id = 3;
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
                $visit->status_id = 7;
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

            $quote = new Service();
            $quote_key = $quote->getLastQuoteKey()->latest()->first();
            
            
        if($service->quote_key != $quote_key->quote_key ) {
            toast('You can only delete the latest created quote!','info');
            return redirect()->back();
        } else {
        $items = $service->items()->select('id')->get();

        for($i = 0; $i < $items->count(); $i++){
           Item::where('id','=', $items[$i]->id)->delete();
        }
        $service->delete();
        
        toast('Quote deleted with success!','success');
        return redirect()->back();
        }
    }catch (Throwable $e) {
        toast('Pleasy try again!','error');
    }
    }

}
