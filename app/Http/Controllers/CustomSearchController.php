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
        ->whereBetween('visits.date', array($request->start_date, $request->end_date))
        ->where('visits.status_id','=',$request->filter_status)
        ->get();
        return datatables()->of($status)
        ->addColumn('action', function($status){
         $button = '<a href="'. route('visits.visitsByCustomer', [ 'customer' => "$status->customer_id"]).'" type="button"  class="btn btn-info btn-block">See Visit</a>';
         return $button;
     })
     ->rawColumns(['action'])
     ->make(true);
        return view('dashboard.visits');
     }

    function sumByStatusAndData(Request $request){
      
      if($request->filter_status == 1){
         $data = DB::table('services')
         ->selectRaw('(CASE WHEN services.status = 2 THEN  "Not Approved" WHEN services.status = 1 THEN "Approved" WHEN services.status = 3 THEN "Waiting" WHEN services.status = 4 THEN "Sent Proposal" END) as status, CONCAT("$",FORMAT(sum(services.total),2))  as total, count(services.id) as quantity, max(last_day(services.approved_on)) as end_date, min(LAST_DAY(services.approved_on - INTERVAL 1 MONTH) + INTERVAL 1 DAY) as start_date, services.status as new_status')
         ->join('visits', 'visits.id','=','services.visit_id')
         ->whereBetween('services.approved_on', array($request->start_date, $request->end_date))
         ->where('services.status', '=', 1)
         ->groupBy('services.status')
         ->get();
      }else if($request->filter_status == 2){
         $data = DB::table('services')
         ->selectRaw('(CASE WHEN services.status = 2 THEN  "Not Approved" WHEN services.status = 1 THEN "Approved" WHEN services.status = 3 THEN "Waiting" WHEN services.status = 4 THEN "Sent Proposal" END) as status, CONCAT("$",FORMAT(sum(services.total),2))  as total, count(services.id) as quantity, max(last_day(services.not_approved_on)) as end_date, min(LAST_DAY(services.not_approved_on - INTERVAL 1 MONTH) + INTERVAL 1 DAY) as start_date, services.status as new_status')
         ->join('visits', 'visits.id','=','services.visit_id')
         ->whereBetween('services.not_approved_on', array($request->start_date, $request->end_date))
         ->where('services.status', '=', 2)
         ->groupBy('services.status')
         ->get();
      }else if($request->filter_status == 3){
         $data = DB::table('services')
         ->selectRaw('(CASE WHEN services.status = 2 THEN  "Not Approved" WHEN services.status = 1 THEN "Approved" WHEN services.status = 3 THEN "Waiting" WHEN services.status = 4 THEN "Sent Proposal" END) as status, CONCAT("$",FORMAT(sum(services.total),2))  as total, count(services.id) as quantity, max(last_day(services.waiting_on)) as end_date, min(LAST_DAY(services.waiting_on - INTERVAL 1 MONTH) + INTERVAL 1 DAY) as start_date, services.status as new_status')
         ->join('visits', 'visits.id','=','services.visit_id')
         ->whereBetween('services.waiting_on', array($request->start_date, $request->end_date))
         ->where('services.status', '=', 3)
         ->groupBy('services.status')
         ->get();
      }else{
         $data = DB::table('services')
         ->selectRaw('(CASE WHEN services.status = 2 THEN  "Not Approved" WHEN services.status = 1 THEN "Approved" WHEN services.status = 3 THEN "Waiting" WHEN services.status = 4 THEN "Sent Proposal" END) as status, CONCAT("$",FORMAT(sum(services.total),2))  as total, count(services.id) as quantity, max(last_day(services.sent_proposal_on)) as end_date, min(LAST_DAY(services.sent_proposal_on - INTERVAL 1 MONTH) + INTERVAL 1 DAY) as start_date, services.status as new_status')
         ->join('visits', 'visits.id','=','services.visit_id')
         ->whereBetween('services.sent_proposal_on', array($request->start_date, $request->end_date))
         ->where('services.status', '=', 4)
         ->groupBy('services.status')
         ->get();
      }

      return datatables()->of($data)
      ->addColumn('action', function($data){
         $button = '<a href="'. route('dashboard.options', ['start_date' => $data->start_date, 'end_date' => $data->end_date, 'status' => $data->new_status]).'" type="button"  class="btn btn-info">See Details</a>';
         return $button;
     })
      ->make(true);
      return view('dashboard.total');
   }
    
    function index(Request $request)
    {
      $date = Carbon::now();
      $date2 = Carbon::now();

      $firstDay = $date->firstOfMonth(); 
      $lastDay = $date2->endOfMonth();

      $firstDay = $firstDay->toDateString();
      $lastDay = $lastDay->toDateString(); 

      if($request->filter_status == 1){
         $data = DB::table('visits')
            ->selectRaw('CONCAT("#",services.quote_key) as service_id, customers.id as customer_id, visits.id as visit_id, customers.name as customer_name, DATE_FORMAT(services.approved_on, "%m/%d/%Y") as visit_date, CONCAT("$",FORMAT(services.total,2)) as total')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('services', 'visits.id','=','services.visit_id')
            ->where('services.status','=',1)
            ->where('visits.has_services','=', 1)
            ->whereBetween('services.approved_on', array($firstDay, $lastDay))
            ->get();
      }else if ($request->filter_status == 2){
         $data = DB::table('visits')
            ->selectRaw('CONCAT("#",services.quote_key) as service_id, customers.id as customer_id, visits.id as visit_id, customers.name as customer_name, DATE_FORMAT(services.not_approved_on, "%m/%d/%Y") as visit_date, CONCAT("$",FORMAT(services.total,2)) as total')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('services', 'visits.id','=','services.visit_id')
            ->where('services.status','=',2)
            ->where('visits.has_services','=', 0)
            ->whereBetween('services.not_approved_on', array($firstDay, $lastDay))
            ->get();
      }else if ($request->filter_status == 3){
         $data = DB::table('visits')
            ->selectRaw('CONCAT("#",services.quote_key) as service_id, customers.id as customer_id, visits.id as visit_id, customers.name as customer_name, DATE_FORMAT(services.waiting_on, "%m/%d/%Y") as visit_date, CONCAT("$",FORMAT(services.total,2)) as total')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('services', 'visits.id','=','services.visit_id')
            ->where('services.status','=',3)
            ->where('visits.has_services','=', 0)
            ->whereBetween('services.waiting_on', array($firstDay, $lastDay))
            ->get();
      }else {
         $data = DB::table('visits')
            ->selectRaw('CONCAT("#",services.quote_key) as service_id, customers.id as customer_id, visits.id as visit_id, customers.name as customer_name, DATE_FORMAT(services.sent_proposal_on, "%m/%d/%Y") as visit_date, CONCAT("$",FORMAT(services.total,2)) as total')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('services', 'visits.id','=','services.visit_id')
            ->where('services.status','=',4)
            ->where('visits.has_services','=', 0)
            ->whereBetween('services.sent_proposal_on', array($firstDay, $lastDay))
            ->get();
      }

      
      return datatables()->of($data)
      ->addColumn('action', function($data){
         $button = '<a href="'. route('services.servicesByVisit', ['visit' => "$data->visit_id", 'customer' => "$data->customer_id"]).'" type="button"  class="btn btn-info">See Details</a>';
         return $button;
     })->rawColumns(['action'])
      ->make(true);
      
     return view('dashboard.status');
    }
   }
