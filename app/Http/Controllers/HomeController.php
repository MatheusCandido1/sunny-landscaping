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
    public function index()
    {
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
        ->orderBy('statuses.name', 'ASC')
        ->pluck('quantity','status');

        $chart = new StatusChart;
        $chart->labels($status->keys());
        $chart->dataset('Quotes Approved', 'pie',$status->values())
        ->color($borderColors)
        ->backgroundcolor($fillColors);
        
        $months = DB::table('services')
        ->selectRaw('MONTHNAME(created_at) as month')
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->orderBy('services.created_at','ASC')
        ->pluck('month');


        $monthsStatus = DB::table('services')
        ->selectRaw('MONTHNAME(created_at) as month, count(IF(services.status = 0,1,null)) as approved, count(IF(services.status = 1,1,null)) as disapproved')
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->orderBy('services.created_at','ASC')
        ->pluck('approved','disapproved');


        $chart2 = new StatusChart;
        $chart2->labels($months->values());
        $chart2->dataset('Quotes Approved', 'bar',$monthsStatus->keys())->options([
            'backgroundColor' => '#5cb85c',
            'fill' => true
            ]);
        $chart2->dataset('Quotes Disapproved', 'bar',$monthsStatus->values())->options([
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
    }
}
