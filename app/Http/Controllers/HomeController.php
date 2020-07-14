<?php

namespace App\Http\Controllers;
use TJGazel\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Charts\StatusChart;


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

     

    public function projectsByStatus(){
        try{
            $infos = DB::table('services')
            ->selectRaw('services.id as service_id,customers.id as customer_id, visits.id as visit_id, customers.name as customer_name, visits.date as visit_date, MONTHNAME(visits.date) as month, services.total, services.status as status')
            ->join('visits','visits.id','=','services.visit_id')
            ->join('customers','customers.id','=','visits.customer_id')
            ->get();


            return view('dashboard.status',['infos' => $infos]);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
    

    public function index()
    {
        try{ 
        $borderColors = [
            "rgba(91, 192, 222, 1.0)",
            "rgba(92, 184, 92, 1.0)",
            "rgba(217, 83, 79, 1.0)",
            "rgba(2, 117, 216, 1.0)",
            "rgba(240, 173, 78, 1.0)",
        ];
        $fillColors = [
            "rgba(91, 192, 222, 0.5)",
            "rgba(92, 184, 92, 0.5)",
            "rgba(217, 83, 79,0.5)",
            "rgba(2, 117, 216, 0.5)",
            "rgba(240, 173, 78, 0.5)",

        ];

        $status = DB::table('visits')
        ->selectRaw('statuses.name as status, count(*) as quantity')
        ->join('statuses','statuses.id','=','visits.status_id')
        ->groupBy(DB::raw('statuses.name'))
        ->orderBy('statuses.id', 'ASC')
        ->pluck('quantity','status');

       // dd($status->keys());

        $chart = new StatusChart;
        $chart->labels($status->keys());
        $chart->dataset('Quotes Approved', 'bar',$status->values())
        ->color($borderColors)
        ->backgroundcolor($fillColors);
        
        $months = DB::table('services')
        ->selectRaw('MONTHNAME(created_at) as month')
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->orderBy('services.created_at','ASC')
        ->pluck('month');



        $monthsDis = DB::table('services')
        ->selectRaw('count(IF(services.status = 0,1,null)) as disapproved')
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->orderBy('services.created_at','ASC')
        ->pluck('disapproved');

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
        $chart2->dataset('Quotes Disapproved', 'bar',$monthsDis->values())->options([
            'backgroundColor' => '#d9534f',
            'fill' => true
            ]);


        $approved = DB::table('services')
        ->selectRaw('sum(services.total) as total, count(services.id) as quantity')
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=','1')
        ->first();

        $disapproved = DB::table('services')
        ->selectRaw('sum(services.total) as total, count(services.id) as quantity')
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=','0')
        ->first();

        $customers = DB::table('customers')->count();

        return view('dashboard.home', compact('approved','disapproved','customers', 'chart','chart2'));
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
