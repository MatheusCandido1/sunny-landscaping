<?php

namespace App\Http\Controllers;
use TJGazel\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;
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
        $chart = new TestChart;
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $chart->dataset('Quotes Approved', 'bar',[43,33,45,512,543,243,65,231,54,65,543])->options([
            'backgroundColor' => '#5cb85c',
            'fill' => true
            ]);
        $chart->dataset('Quotes Disapproved', 'bar',[54,3,54,767,8,3,4,231,67,67,543])->options([
            'backgroundColor' => '#d9534f',
            'fill' => true
            ]);

        return view('home', compact('chart'));
    }
}
