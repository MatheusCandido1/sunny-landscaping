<?php

namespace App\Http\Controllers;
use TJGazel\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;


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

        return view('home', compact('approved','disapproved'));
    }
}
