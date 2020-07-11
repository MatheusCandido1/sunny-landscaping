<?php

namespace App\Http\Controllers;
use TJGazel\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Charts\TestChart;


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
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(22,160,133, 1.0)",
        ];
        $fillColors = [
            "rgba(255, 99, 132, 1)",
            "rgba(22,160,133, 1)",
            "rgba(255, 205, 86,1)",
            "rgba(51,105,232, 1)",
            "rgba(244,67,54, 1)",
            "rgba(34,198,246,1)",
            "rgba(22,160,133, 1.0)",

        ];

        $status = DB::table('visits')
        ->selectRaw('statuses.name as status, count(*) as quantity')
        ->join('statuses','statuses.id','=','visits.status_id')
        ->groupBy(DB::raw('statuses.name'))
        ->orderBy('statuses.name', 'ASC')
        ->pluck('quantity','status');


        $chart = new TestChart;
        $chart->labels($status->keys());
        $chart->dataset('Quotes Approved', 'pie',$status->values())
        ->color($borderColors)
        ->backgroundcolor($fillColors);

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

        return view('dashboard.home', compact('approved','disapproved','customers', 'chart'));
    }
}
