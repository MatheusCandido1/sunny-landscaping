<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;


class CustomSearchController extends Controller
{
   function visitsByStatus(Request $request){
      $status = DB::table('visits')
        ->selectRaw('customers.id as customer_id, customers.name as customer_name, customers.address as project_address')
        ->join('customers', 'customers.id','=','visits.customer_id')
        ->join('statuses','statuses.id','=','visits.status_id')
        ->where('visits.status_id','=',$request->filter_status)
        ->get();
        return datatables()->of($status)
        ->addColumn('action', function($data){
         $button = '<a href="'. route('visits.visitsByCustomer', [ 'customer' => "$data->customer_id"]).'" type="button"  class="btn btn-info btn-block">See Visit</a>';
         return $button;
     })
     ->rawColumns(['action'])
     ->make(true);
        return view('dashboard.visits');
     }

    function sumByStatusAndData(Request $request){

      $data = DB::table('services')
      ->selectRaw('(CASE WHEN services.status = 2 THEN  "Not Approved" WHEN services.status = 1 THEN "Approved" WHEN services.status = 3 THEN "Waiting" WHEN services.status = 4 THEN "Sent Proposal" END) as status, CONCAT("$",FORMAT(sum(services.total),2))  as total, count(services.id) as quantity')
      ->join('visits', 'visits.id','=','services.visit_id')
      ->whereBetween('services.created_at', array($request->start_date, $request->end_date))
      ->groupBy('services.status')
      ->get();

      return datatables()->of($data)
      ->addColumn('action', function($data){
         $button = '<a href="'. route('dashboard.options', ['start_date' => 1, 'end_date' => 1, 'status' => 1]).'" type="button"  class="btn btn-info">See Details</a>';
         return $button;
     })
      ->make(true);
      return view('dashboard.total');
   }
    
    function index(Request $request)
    {
      if($request->filter_status == 1)
      {
         $data = DB::table('visits')
            ->selectRaw('services.status, CONCAT("#",services.quote_key) as service_id,customers.id as customer_id, visits.id as visit_id, customers.name as customer_name, DATE_FORMAT(visits.date, "%m/%d/%Y") as visit_date, CONCAT("$",FORMAT(services.total,2)) as total')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('services', 'visits.id','=','services.visit_id')
            ->where('services.status','=',$request->filter_status)
            ->where('visits.has_services','=', 1)
            ->get();
      return datatables()->of($data)
      ->addColumn('action', function($data){
         $button = '<a href="'. route('services.servicesByVisit', ['visit' => "$data->visit_id", 'customer' => "$data->customer_id"]).'" type="button"  class="btn btn-info">See Details</a>';
         return $button;
     })
     ->rawColumns(['action'])
     ->make(true);
     }
     else if ($request->filter_status == 0){
      $data2 = DB::table('visits')
      ->selectRaw('services.status, CONCAT("#",services.quote_key) as service_id,customers.id as customer_id, visits.id as visit_id, customers.name as customer_name, DATE_FORMAT(visits.date, "%m/%d/%Y") as visit_date, CONCAT("$",FORMAT(services.total,2)) as total')
      ->join('customers','customers.id','=','visits.customer_id')
      ->join('services', 'visits.id','=','services.visit_id')
      ->where('services.status','=',2)
      ->where('visits.has_services','=', 0)
      ->get();


      
return datatables()->of($data2)
->addColumn('action', function($data2){
   $button = '<a href="'. route('services.servicesByVisit', ['visit' => "$data2->visit_id", 'customer' => "$data2->customer_id"]).'" type="button"  class="btn btn-info">See Details</a>';
   return $button;
})
->rawColumns(['action'])
->make(true);
     }else if ($request->filter_status == 2){
      $data3 = DB::table('visits')
      ->selectRaw('services.status, CONCAT("#",services.quote_key) as service_id,customers.id as customer_id, visits.id as visit_id, customers.name as customer_name, DATE_FORMAT(visits.date, "%m/%d/%Y") as visit_date, CONCAT("$",FORMAT(services.total,2)) as total')
      ->join('customers','customers.id','=','visits.customer_id')
      ->join('services', 'visits.id','=','services.visit_id')
      ->where('services.status','=',3)
      ->where('visits.has_services','=', 0)
      ->get();
return datatables()->of($data3)
->addColumn('action', function($data3){
   $button = '<a href="'. route('services.servicesByVisit', ['visit' => "$data3->visit_id", 'customer' => "$data3->customer_id"]).'" type="button"  class="btn btn-info">See Details</a>';
   return $button;
})
->rawColumns(['action'])
->make(true);
     }
     return view('dashboard.status');
    }
}
