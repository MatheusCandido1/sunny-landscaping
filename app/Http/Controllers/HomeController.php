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
            return view('dashboard.status');
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
        ->selectRaw('count(IF(services.status = 2,1,null)) as disapproved')
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
        ->selectRaw('MONTHNAME(services.created_at) as month,sum(services.total) as total, count(services.id) as quantity')
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=','1')
        ->where(DB::raw('MONTHNAME(services.created_at)'),'=',\Carbon\Carbon::now()->format('F'))
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->first();

        $disapproved = DB::table('services')
        ->selectRaw('MONTHNAME(services.created_at) as month, sum(services.total) as total, count(services.id) as quantity')
        ->join('visits', 'visits.id','=','services.visit_id')
        ->where('services.status','=','2')
        ->where(DB::raw('MONTHNAME(services.created_at)'),'=',\Carbon\Carbon::now()->format('F'))
        ->groupBy(DB::raw('MONTHNAME(services.created_at)'))
        ->first();


        return view('dashboard.home', compact('approved','disapproved','chart2'));
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }
}
