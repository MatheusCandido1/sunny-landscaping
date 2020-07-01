<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Customer;
use App\Item;
use App\Service;
use App\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;

class PdfController extends Controller
{
    public function generateProposal($service_id) 
    {
        $data = DB::table('services')
        ->selectRaw('customers.name, customers.address, customers.state, customers.phone, customers.zipcode, cities.name as city, customers.cellphone, services.total')
        ->join('visits','visits.id','=','services.visit_id')
        ->join('customers','customers.id','=','visits.customer_id')
        ->join('cities', 'cities.id','=','customers.city_id')
        ->where('services.id','=', $service_id)
        ->get();
        $pdf = PDF::loadView('pdfs.proposal', compact('data'));
       // $pdf->setWatermarkImage(public_path('img/watermark.jpg'));
        return $pdf->setPaper('a4')->stream('items.pdf');
    }

    public function generateQuote($service_id,$visit_id, $type) 
    {
        $data = DB::table('costumer_visit')
        ->selectRaw('costumers.name, costumers.address, costumers.state, costumers.phone, costumers.zipcode, costumers.city, costumers.cellphone, services.final_balance')
        ->join('visits','visits.id','=','costumer_visit.visit_id')
        ->join('costumers','costumers.id','=','costumer_visit.costumer_id')
        ->join('services','services.visit_id','=','visits.id')
        ->where('visits.id','=', $visit_id)
        ->get();

        $serviceData = DB::table('services')->select('id','discount','total','accepting_proposal','down_payment','final_balance')->where('services.visit_id','=',$visit_id)->first();

        $itemData = DB::table('items')
        ->selectRaw('items.group_type,items.id, items.supplier, items.description, items.quantity, items.type, items.unit_price, items.investment')
        ->join('item_service','item_service.item_id','=','items.id')
        ->join('services','services.id','=','item_service.service_id')
        ->where('services.id', '=', $service_id)
        ->get()
        ->groupBy('group_type');


        $costumerData = DB::table('costumer_visit')
        ->selectRaw('costumers.referred, costumers.city, costumers.state,costumers.zipcode,costumers.cross_street1, costumers.cross_street2,costumers.name as costumer_name, costumers.email, costumers.phone, costumers.cellphone, costumers.address, costumers.gate_code, visits.name as visit_name, visits.date, visits.call_costumer_in, visits.hoa, visits.water_smart_rebate, visits.id as visit_id')
        ->join('visits','visits.id','=','costumer_visit.visit_id')
        ->join('costumers','costumers.id','=','costumer_visit.costumer_id')
        ->where('visits.id','=', $visit_id)
        ->first();

        $pdf = PDF::loadView('pdfs.quote', compact('data','serviceData','itemData','costumerData'));
        if($type == "1")
        return $pdf->setPaper('a4')->stream('quote.pdf'); 
        
        return $pdf->setPaper('a4','landscape')->stream('quote.pdf'); 


    }
}
