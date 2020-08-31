<?php

namespace App\Http\Controllers;
use TJGazel\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Charts\StatusChart;
use App\Status;
use Carbon\Carbon;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function optionsByStatus($start_date, $end_date, $options) {
        try {
            $data = DB::table('visits')
            ->selectRaw('visits.id as visit_id, CONCAT("#",services.quote_key) as service_id, (CASE WHEN services.status = 2 THEN  "Not Approved" WHEN services.status = 1 THEN "Approved" WHEN services.status = 3 THEN "Waiting" WHEN services.status = 4 THEN "Sent Proposal" END) as status, customers.id as customer_id, customers.name as customer_name')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('services', 'visits.id','=','services.visit_id')
            ->where('services.status','=',$options)
            ->whereBetween('services.created_at', array($start_date, $end_date))
            ->get();

            return view('dashboard.options', ['data' => $data]);
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');
            return redirect()->back();
        }
    }

    public function quotes(){
        try{
            $date = Carbon::now();
      $date2 = Carbon::now();
            $firstDay = $date->firstOfMonth(); 
            $lastDay = $date2->endOfMonth();

            $firstDay = $firstDay->toDateString();
            $lastDay = $lastDay->toDateString(); 

            $data = DB::table('visits')
            ->selectRaw('visits.id as visit_id, CONCAT("#",services.quote_key) as service_id, (CASE WHEN services.status = 2 THEN  "Not Approved" WHEN services.status = 1 THEN "Approved" WHEN services.status = 3 THEN "Waiting" WHEN services.status = 4 THEN "Sent Proposal" END) as status, customers.id as customer_id, customers.address as address, customers.name as customer_name, services.approved_on, services.not_approved_on, services.sent_proposal_on, services.waiting_on')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('services', 'visits.id','=','services.visit_id')
            ->whereBetween('services.created_at', array($firstDay, $lastDay))
            ->get();
           // dd($data); 

            return view('dashboard.quotes', ['quotes' => $data]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function projectsByStatus(){
        try{
            return view('dashboard.status');

        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function visitsByStatus($status){
        try{
            return view('dashboard.visits', ['status' => Status::all(), 'id' => $status]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function totalByStatus(){
        try{
           
            return view('dashboard.total');
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
    

    public function index()
    {
        try{ 

        


        $quotesByStatus = DB::table('services')
        ->selectRaw('(CASE WHEN services.status = 2 THEN  "Not Approved" WHEN services.status = 1 THEN "Approved" WHEN services.status = 3 THEN "Waiting" WHEN services.status = 4 THEN "Sent Proposal" END) as status, count(services.id) as total')
        ->where(DB::raw('MONTHNAME(services.created_at)'),'=',\Carbon\Carbon::now()->format('F'))
        ->groupBy('status')
        ->orderBy('services.status','ASC')
        ->get();

        $visitsByStatus = DB::table('visits')
        ->selectRaw('statuses.name as status, count(*) as quantity')
        ->join('statuses','statuses.id','=','visits.status_id')
        ->groupBy(DB::raw('statuses.name'))
        ->orderBy('statuses.id', 'ASC')
        ->pluck('quantity','status');


        $quotesApproved = DB::table('services')
        ->selectRaw('count(services.id) as total')
        ->where(DB::raw('MONTHNAME(services.approved_on)'),'=',\Carbon\Carbon::now()->format('F'))
        ->where('services.status','=',1)
        ->first();

        $quotesNotApproved = DB::table('services')
        ->selectRaw('count(services.id) as total')
        ->where(DB::raw('MONTHNAME(services.not_approved_on)'),'=',\Carbon\Carbon::now()->format('F'))
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=',2)
        ->where('visits.has_services','=',0)
        ->first();

        $quotesSentProposal = DB::table('services')
        ->selectRaw('count(services.id) as total')
        ->where(DB::raw('MONTHNAME(services.sent_proposal_on)'),'=',\Carbon\Carbon::now()->format('F'))
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=',4)
        ->where('visits.has_services','=',0)
        ->first();

        $quotesWaiting = DB::table('services')
        ->selectRaw('count(services.id) as total')
        ->where(DB::raw('MONTHNAME(services.waiting_on)'),'=',\Carbon\Carbon::now()->format('F'))
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=',3)
        ->where('visits.has_services','=',0)
        ->first();

        $monthsDis = DB::table('visits')
        ->selectRaw('MONTHNAME(visits.date) as month, count(*) as sent_proposal')
        ->join('customers','customers.id','=','visits.customer_id')
        ->where('visits.status_id','=', 2)
        ->groupBy(DB::raw('MONTHNAME(visits.date)'))
        ->orderBy('visits.date','asc')
        ->get();

        $monthsAp = DB::table('visits')
        ->selectRaw('MONTHNAME(visits.date) as month, count(*) as approved')
        ->join('customers','customers.id','=','visits.customer_id')
        ->where('visits.status_id','=', 3)
        ->groupBy(DB::raw('MONTHNAME(visits.date)'))
        ->orderBy('visits.date','asc')
        ->get();

        $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
       
        for($i = 0; $i < 12; $i++){
            for($j = 0; $j < count($monthsAp); $j++){
                if($months[$i] == $monthsAp[$j]->month)
                {
                    $newApproved[$i] = $monthsAp[$j]->approved;
                    break;
                }else{
                    $newApproved[$i] = 0;
                }
            }
        }

        for($i = 0; $i < 12; $i++){
            for($j = 0; $j < count($monthsDis); $j++){
                if($months[$i] == $monthsDis[$j]->month)
                {
                    $newSent[$i] = $monthsDis[$j]->sent_proposal;
                    break;
                }else{
                    $newSent[$i] = 0;
                }
            }
        }

        
        $chart2 = new StatusChart;
        $chart2->labels($months);
        $chart2->dataset('Project Approved', 'bar',$newApproved)->options([
            'backgroundColor' => '#5cb85c',
            'fill' => true
            ]);
        $chart2->dataset('Sent Proposal', 'bar',$newSent)->options([
            'backgroundColor' => '#0275d8',
            'fill' => true
            ]);

        $approved = DB::table('services')
        ->selectRaw('MONTHNAME(services.approved_on) as month,sum(services.total) as total, count(services.id) as quantity')
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=','1')
        ->where('visits.has_services','=',1)
        ->where(DB::raw('MONTHNAME(services.approved_on)'),'=',\Carbon\Carbon::now()->format('F'))
        ->groupBy(DB::raw('MONTHNAME(services.approved_on)'))
        ->first();

        $selected = DB::table('services')
        ->selectRaw('MONTHNAME(services.created_at) as month, sum(services.total) as total, count(services.id) as quantity')
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=',4)
        ->where('visits.has_services','=',0)
        ->where(DB::raw('MONTHNAME(services.sent_proposal_on)'),'=',\Carbon\Carbon::now()->format('F'))
        ->groupBy(DB::raw('MONTHNAME(services.sent_proposal_on)'))
        ->first();

        $borderColors = [
            "rgba(2, 117, 216, 1.0)",
            "rgba(91, 192, 222, 1.0)",
            "rgba(92, 184, 92, 1.0)",
            "rgba(41, 43, 44, 1.0)",
            "rgba(240, 173, 78, 1.0)",
            "rgba(78, 51, 87, 1.0)",
            "rgba(179, 210, 14, 1.0)",
            "rgba(217, 83, 79, 1.0)"
        ];
        $fillColors = [
            "rgba(2, 117, 216, 0.5)",
            "rgba(91, 192, 222, 0.5)",
            "rgba(92, 184, 92,0.5)",
            "rgba(41, 43, 44, 0.5)",
            "rgba(240, 173, 78, 0.5)",
            "rgba(78, 51, 87, 0.5)",
            "rgba(179, 210, 14, 0.5)",
            "rgba(217, 83, 79, 0.5)"
        ];

        for($i = 1; $i < 9; $i++){
        $quantityByStatus[$i] = DB::table('visits')
        ->selectRaw('count(*) as quantity')
        ->join('customers','customers.id','=','visits.customer_id')
        ->where('visits.status_id','=',$i)
        ->where(DB::raw('YEAR(visits.date)'),'=',\Carbon\Carbon::now()->format('Y'))
        ->first();
        }

        return view('dashboard.home', ['quantityByStatus' => $quantityByStatus,'quotesApproved' => $quotesApproved,'quotesNotApproved' => $quotesApproved,'quotesWaiting' => $quotesWaiting,'quotesSentProposal' => $quotesWaiting,'approved' => $approved,'selected' => $selected,'chart2' => $chart2]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
