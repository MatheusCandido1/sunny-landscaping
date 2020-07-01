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
    public function generateFrontpage()
    {
        $pdf = PDF::loadView('pdfs.front');
        return $pdf->setPaper('a4','landscape')->stream('frontpage.pdf'); 
    }
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
        $data = DB::table('services')
        ->selectRaw('customers.name, customers.address, customers.state, customers.phone, customers.zipcode, cities.name as city, customers.cellphone, services.total')
        ->join('visits','visits.id','=','services.visit_id')
        ->join('customers','customers.id','=','visits.customer_id')
        ->join('cities', 'cities.id','=','customers.city_id')
        ->where('services.id','=', $service_id)
        ->get();

        $serviceData = DB::table('services')->select('id','discount','total','accepting_proposal','down_payment','final_balance')->where('services.visit_id','=',$visit_id)->first();

      $itemData = DB::table('items')
      ->selectRaw('items.group_type,items.id, items.supplier, items.description, items.quantity, items.type, items.unit_price, items.investment')
      ->join('item_service','item_service.item_id','=','items.id')
      ->join('services','services.id','=','item_service.service_id')
      ->where('services.id', '=', $service_id)
      ->get()
      ->groupBy('group_type');


        $customerData = DB::table('visits')
        ->selectRaw('referrals.name as ref_name, cities.name as city_name, customers.state,customers.zipcode,customers.cross_street1, customers.cross_street2,customers.name as customer_name, customers.email, customers.phone, customers.cellphone, customers.address, customers.gate_code, visits.name as visit_name, visits.date, visits.call_customer_in, visits.hoa, visits.water_smart_rebate, visits.id as visit_id')
        ->join('customers','customers.id','=','visits.customer_id')
        ->join('cities', 'customers.city_id','=','cities.id')
        ->join('referrals', 'customers.referral_id','=','referrals.id')
        ->where('visits.id','=', $visit_id)
        ->get();

        $customer = $customerData[0];

        $pdf = PDF::loadView('pdfs.quote', compact('data','customer','itemData','serviceData'));
        if($type == "1")
        return $pdf->setPaper('a4')->stream('quote.pdf'); 
        
        return $pdf->setPaper('a4','landscape')->stream('quote.pdf'); 


    }
}
