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

    public function projectsByStatus(){
        try{
            $date = Carbon::now();
            

            return view('dashboard.status', ['currentMonth' => $date]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    public function visitsByStatus(){
        try{
            return view('dashboard.visits', ['status' => Status::all()]);
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
        
        $months = DB::table('services')
        ->selectRaw('MONTHNAME(created_at) as month')
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->orderBy('services.created_at','ASC')
        ->pluck('month');

        $monthsDis = DB::table('services')
        ->selectRaw('count(IF(services.status = 4,1,null)) as sent_proposal')
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->orderBy('services.created_at','ASC')
        ->pluck('sent_proposal');

        $monthsAp = DB::table('services')
        ->selectRaw('count(IF(services.status = 1,1,null)) as approved')
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->orderBy('services.created_at','ASC')
        ->pluck('approved');

        $chart2 = new StatusChart;
        $chart2->labels($months->values());
        $chart2->dataset('Quotes Approved', 'bar',$monthsAp->values())->options([
            'backgroundColor' => '#5cb85c',
            'fill' => true
            ]);
        $chart2->dataset('Sent Proposal', 'bar',$monthsDis->values())->options([
            'backgroundColor' => '#0275d8',
            'fill' => true
            ]);


        $approved = DB::table('services')
        ->selectRaw('MONTHNAME(services.created_at) as month,sum(services.total) as total, count(services.id) as quantity')
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=','1')
        ->where('visits.has_services','=',1)
        ->where(DB::raw('MONTHNAME(services.created_at)'),'=',\Carbon\Carbon::now()->format('F'))
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->first();

        

        $selected = DB::table('services')
        ->selectRaw('MONTHNAME(services.created_at) as month, sum(services.total) as total, count(services.id) as quantity')
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=',4)
        ->where('visits.has_services','=',0)
        ->where(DB::raw('MONTHNAME(services.created_at)'),'=',\Carbon\Carbon::now()->format('F'))
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->first();



        $borderColors = [
            "rgba(2, 117, 216, 1.0)",
            "rgba(91, 192, 222, 1.0)",
            "rgba(92, 184, 92, 1.0)",
            "rgba(41, 43, 44, 1.0)",
            "rgba(240, 173, 78, 1.0)",
            "rgba(217, 83, 79, 1.0)"
        ];
        $fillColors = [
            "rgba(2, 117, 216, 0.5)",
            "rgba(91, 192, 222, 0.5)",
            "rgba(92, 184, 92,0.5)",
            "rgba(41, 43, 44, 0.5)",
            "rgba(240, 173, 78, 0.5)",
            "rgba(217, 83, 79, 0.5)"
        ];

        $status = DB::table('visits')
        ->selectRaw('statuses.name as status, count(*) as quantity')
        ->join('statuses','statuses.id','=','visits.status_id')
        ->groupBy(DB::raw('statuses.name'))
        ->orderBy('statuses.id', 'ASC')
        ->pluck('quantity','status');


        $chart = new StatusChart;
        $chart->labels($status->keys());
        $chart->dataset('Quotes Approved', 'doughnut',$status->values())
        ->color($borderColors)
        ->backgroundcolor($fillColors);
       
        return view('dashboard.home', compact('approved','selected','chart','chart2'));
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
