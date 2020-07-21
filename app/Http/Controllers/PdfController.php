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
    public function generateFrontpage($visit_id)
    {
        try{
        $data = DB::table('visits')
            ->selectRaw('sellers.name as sel_name, referrals.name as ref_name, cities.name as city_name, customers.state,customers.zipcode,customers.cross_street1, customers.cross_street2,customers.name as customer_name, customers.email, customers.phone, customers.parcel_number, customers.cellphone, customers.address, customers.gate_code, visits.project_name, visits.date, visits.call_customer_in, visits.hoa, visits.water_smart_rebate, visits.id as visit_id')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'customers.city_id','=','cities.id')
            ->join('referrals', 'customers.referral_id','=','referrals.id')
            ->join('sellers','customers.seller_id','=','sellers.id')
            ->where('visits.id','=', $visit_id)
            ->get();
        

        $pdf = PDF::loadView('pdfs.front', compact('data'));
        return $pdf->setPaper('a4','landscape')->stream('frontpage.pdf'); 
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function generateProposal($service_id) 
    {
        try{
        $data = DB::table('services')
        ->selectRaw('services.updated_at, customers.name, customers.address, customers.state, customers.phone, customers.zipcode, cities.name as city, customers.cellphone, services.total, customers.company, customers.company_name,customers.company_address,customers.company_state, customers.company_city, customers.company_zipcode')
        ->join('visits','visits.id','=','services.visit_id')
        ->join('customers','customers.id','=','visits.customer_id')
        ->join('cities', 'cities.id','=','customers.city_id')
        ->where('services.id','=', $service_id)
        ->get();
        $pdf = PDF::loadView('pdfs.proposal', compact('data'));
        return $pdf->setPaper('a4')->stream('items.pdf');
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function generateFullProposal($visit_id) 
    {
        try{
        $data = DB::table('services')
        ->selectRaw('services.updated_at, customers.name, customers.address, customers.state, customers.phone, customers.zipcode, cities.name as city, customers.cellphone, services.total, customers.company, customers.company_name,customers.company_address,customers.company_state, customers.company_city, customers.company_zipcode')
        ->join('visits','visits.id','=','services.visit_id')
        ->join('customers','customers.id','=','visits.customer_id')
        ->join('cities', 'cities.id','=','customers.city_id')
        ->where('visits.id','=', $visit_id)
        ->get();

        $customer = DB::table('visits')
        ->selectRaw('referrals.name as ref_name, cities.name as city_name, customers.state,customers.zipcode,customers.cross_street1, customers.cross_street2,customers.name as customer_name, customers.email, customers.phone, customers.cellphone, customers.address, customers.gate_code, visits.date, visits.call_customer_in, visits.hoa, visits.water_smart_rebate, visits.id as visit_id')
        ->join('customers','customers.id','=','visits.customer_id')
        ->join('cities', 'customers.city_id','=','cities.id')
        ->join('referrals', 'customers.referral_id','=','referrals.id')
        ->where('visits.id','=', $visit_id)
        ->first();

        $serviceGroup = DB::table('services')
        ->selectRaw('services.id as id')
        ->join('visits','visits.id','=','services.visit_id')
        ->where('visits.id', '=', $visit_id)
        ->where('services.status', '=',4)
        ->orWhere('services.status','=',1)
        ->get();

        $itemData = DB::table('items')
            ->selectRaw('services.id as service, items.group_type,items.id, items.supplier, items.description, items.quantity, items.type, items.unit_price, items.investment')
            ->join('item_service','item_service.item_id','=','items.id')
            ->join('services','services.id','=','item_service.service_id')
            ->join('visits','visits.id','=','services.visit_id')
            ->where('visits.id', '=', $visit_id)
            ->where('services.status',4)
            ->orWhere('services.status','=',1)
            ->get()
            ->groupBy(['service','group_type']);
        

        $serviceData = DB::table('services')
            ->select('services.notes', 'services.id as service_id','discount','total','accepting_proposal','down_payment','final_balance')
            ->where('services.visit_id','=',$visit_id)
            ->where('services.status','=',4)
            ->orWhere('services.status','=',1)
            ->get();

        $amount = DB::table('services')
            ->selectRaw('sum(services.total) as total')
            ->join('visits', 'visits.id','=','services.visit_id')
            ->where('visits.id','=',$visit_id)
            ->where('services.status','=','4')
            ->orWhere('services.status','=','1')
            ->get();


        $pdf = PDF::loadView('pdfs.fullproposal', compact('amount','serviceData','serviceGroup','data','customer', 'itemData'));
        return $pdf->setPaper('a4')->stream('fullproposal.pdf');
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function generateWaiver($visit_id){
        try{
            $data = DB::table('visits')
            ->selectRaw('cities.name as city_name, customers.state,customers.zipcode,customers.name as customer_name, customers.address,  visits.invoice_number, visits.waiver_date, visits.id as visit_id')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'customers.city_id','=','cities.id')
            ->join('referrals', 'customers.referral_id','=','referrals.id')
            ->join('sellers','customers.seller_id','=','sellers.id')
            ->where('visits.id','=', $visit_id)
            ->get();

            $amount = DB::table('services')
            ->selectRaw('sum(services.total) as total')
            ->join('visits', 'visits.id','=','services.visit_id')
            ->where('services.status','=','1')
            ->where('visits.id','=',$visit_id)
            ->get();

            
            $pdf = PDF::loadView('pdfs.waiver',compact('data','amount'));
            return $pdf->setPaper('a4')->stream('waiver.pdf');
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function generateEstimate($visit_id){
        try{
            $data = DB::table('visits')
            ->selectRaw('sellers.name as sel_name, referrals.name as ref_name, cities.name as city_name, customers.gender, customers.state,customers.zipcode,customers.cross_street1, customers.cross_street2,customers.name as customer_name, customers.email, customers.phone, customers.parcel_number, customers.cellphone, customers.address, customers.gate_code, visits.date, visits.call_customer_in, visits.hoa, visits.water_smart_rebate, visits.id as visit_id')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'customers.city_id','=','cities.id')
            ->join('referrals', 'customers.referral_id','=','referrals.id')
            ->join('sellers','customers.seller_id','=','sellers.id')
            ->where('visits.id','=', $visit_id)
            ->get();

            
        $visits = Visit::with('types')->where('id','=',$visit_id)->get();

            $pdf = PDF::loadView('pdfs.estimate', compact('data','visits'));
            return $pdf->setPaper('a4')->stream('estimate.pdf');
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function generateNevadaContract($visit_id){
        try{
            $data = DB::table('visits')
            ->selectRaw('customers.company, customers.company_name, visits.parties, cities.name as city_name, customers.state,customers.zipcode,customers.name as customer_name, customers.address,  visits.invoice_number, visits.contract_date, visits.id as visit_id')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'customers.city_id','=','cities.id')
            ->join('referrals', 'customers.referral_id','=','referrals.id')
            ->join('sellers','customers.seller_id','=','sellers.id')
            ->where('visits.id','=', $visit_id)
            ->get();
            

            $amount = DB::table('services')
            ->selectRaw('sum(services.total) as total')
            ->join('visits', 'visits.id','=','services.visit_id')
            ->where('services.status','=','1')
            ->where('visits.id','=',$visit_id)
            ->get();

            $pdf = PDF::loadView('pdfs.nevadacontract',compact('data','amount'));
            return $pdf->setPaper('a4')->stream('nevada.pdf');
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function generateContract($visit_id){
        try{
            $data = DB::table('visits')
            ->selectRaw('cities.name as city_name, customers.state,customers.zipcode,customers.name as customer_name, customers.address,  visits.invoice_number, visits.board_date, visits.id as visit_id')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'customers.city_id','=','cities.id')
            ->join('referrals', 'customers.referral_id','=','referrals.id')
            ->join('sellers','customers.seller_id','=','sellers.id')
            ->where('visits.id','=', $visit_id)
            ->get();

            $amount = DB::table('services')
            ->selectRaw('sum(services.total) as total')
            ->join('visits', 'visits.id','=','services.visit_id')
            ->where('services.status','=','1')
            ->where('visits.id','=',$visit_id)
            ->get();

            
            $pdf = PDF::loadView('pdfs.contract',compact('data','amount'));
            return $pdf->setPaper('a4')->stream('contract.pdf');
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function generateChangeOrder($change_id, $visit_id)
    {
        try{
            $data = DB::table('change_orders')
            ->selectRaw('change_orders.date as order_date, id, discount, original_contract_amount, change_order_amount, revised_contract_amount')
            ->where('change_orders.id','=', $change_id)
            ->first();

            $customerData = DB::table('visits')
            ->selectRaw('cities.name as city_name, customers.state,customers.zipcode,customers.name as customer_name, customers.address, visits.project_name')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'customers.city_id','=','cities.id')
            ->where('visits.id','=', $visit_id)
            ->get();

            $elementData = DB::table('elements')
            ->selectRaw('elements.target, elements.description, elements.quantity, elements.type, elements.unit_price, elements.investment')
            ->join('element_changeorder','element_changeorder.element_id','=','elements.id')
            ->join('change_orders','change_orders.id','=','element_changeorder.changeorder_id')
            ->where('change_orders.id', '=', $change_id)
            ->get();


            $pdf = PDF::loadView('pdfs.change', compact('data','customerData','elementData'));
            return $pdf->setPaper('a4')->stream('change.pdf');
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
    
    public function generateFullDoc($service_id,$visit_id){
        try{
            $data = DB::table('services')
            ->selectRaw('services.updated_at, customers.name, customers.address, customers.state, customers.phone, customers.zipcode, cities.name as city, customers.cellphone, services.total, customers.company, customers.company_name,customers.company_address,customers.company_state, customers.company_city, customers.company_zipcode')
            ->join('visits','visits.id','=','services.visit_id')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'cities.id','=','customers.city_id')
            ->where('services.id','=', $service_id)
            ->get();

            $serviceData = DB::table('services')->select('services.notes', 'id','notes','discount','total','accepting_proposal','down_payment','final_balance')->where('services.id','=', $service_id)->where('services.visit_id','=',$visit_id)->first();

            $itemData = DB::table('items')
            ->selectRaw('items.group_type,items.id, items.supplier, items.description, items.quantity, items.type, items.unit_price, items.investment')
            ->join('item_service','item_service.item_id','=','items.id')
            ->join('services','services.id','=','item_service.service_id')
            ->where('services.id', '=', $service_id)
            ->get()
            ->groupBy('group_type');


            $customerData = DB::table('visits')
            ->selectRaw('referrals.name as ref_name, cities.name as city_name, customers.state,customers.zipcode,customers.cross_street1, customers.cross_street2,customers.name as customer_name, customers.email, customers.phone, customers.cellphone, customers.address, customers.gate_code, visits.date, visits.call_customer_in, visits.hoa, visits.water_smart_rebate, visits.id as visit_id')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'customers.city_id','=','cities.id')
            ->join('referrals', 'customers.referral_id','=','referrals.id')
            ->where('visits.id','=', $visit_id)
            ->get();

            $customer = $customerData[0];
            $id = $service_id;
            $pdf = PDF::loadView('pdfs.fulldoc', compact('data','customer','itemData','serviceData','id'));
            return $pdf->setPaper('a4')->stream('doc.pdf');
            }catch (Throwable $e) {
                toast('Pleasy try again!','error');
            }
    }

    public function generateQuote($service_id,$visit_id, $type) 
    {
        try{
        $data = DB::table('services')
        ->selectRaw('customers.name, customers.address, customers.state, customers.phone, customers.zipcode, cities.name as city, customers.cellphone, services.total')
        ->join('visits','visits.id','=','services.visit_id')
        ->join('customers','customers.id','=','visits.customer_id')
        ->join('cities', 'cities.id','=','customers.city_id')
        ->where('services.id','=', $service_id)
        ->get();

        $serviceData = DB::table('services')->select('id','discount','total','notes','accepting_proposal','down_payment','final_balance')->where('services.id','=', $service_id)->where('services.visit_id','=',$visit_id)->first();

      $itemData = DB::table('items')
      ->selectRaw('items.group_type,items.id, items.supplier, items.description, items.quantity, items.type, items.unit_price, items.investment')
      ->join('item_service','item_service.item_id','=','items.id')
      ->join('services','services.id','=','item_service.service_id')
      ->where('services.id', '=', $service_id)
      ->get()
      ->groupBy('group_type');


        $customerData = DB::table('visits')
        ->selectRaw('referrals.name as ref_name, cities.name as city_name, customers.state,customers.zipcode,customers.cross_street1, customers.cross_street2,customers.name as customer_name, customers.email, customers.phone, customers.cellphone, customers.address, customers.gate_code, visits.date, visits.call_customer_in, visits.hoa, visits.water_smart_rebate, visits.id as visit_id')
        ->join('customers','customers.id','=','visits.customer_id')
        ->join('cities', 'customers.city_id','=','cities.id')
        ->join('referrals', 'customers.referral_id','=','referrals.id')
        ->where('visits.id','=', $visit_id)
        ->get();

        $customer = $customerData[0];
        $id = $service_id;
        $pdf = PDF::loadView('pdfs.quote', compact('data','customer','itemData','serviceData','id'));
        if($type == "1")
        return $pdf->setPaper('a4')->stream('quote.pdf'); 
        
        return $pdf->setPaper('a4','landscape')->stream('quote.pdf'); 
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
