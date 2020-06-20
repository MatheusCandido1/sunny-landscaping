<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Costumer;
use App\Item;
use App\Service;
use App\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;

class PdfController extends Controller
{
    public function generateProposal($id) 
    {
        $data = DB::table('costumer_visit')
        ->selectRaw('costumers.name, costumers.address, costumers.city, costumers.cellphone, services.final_balance')
        ->join('visits','visits.id','=','costumer_visit.visit_id')
        ->join('costumers','costumers.id','=','costumer_visit.costumer_id')
        ->join('services','services.visit_id','=','visits.id')
        ->where('visits.id','=', $id)
        ->get();

        $pdf = PDF::loadView('pdfs.proposal', compact('data'));
       // $pdf->setWatermarkImage(public_path('img/watermark.jpg'));
        return $pdf->setPaper('a4')->stream('items.pdf');
    }

    public function generateQuote() 
    {
       

        $pdf = PDF::loadView('pdfs.quote');
       // $pdf->setWatermarkImage(public_path('img/watermark.jpg'));
        return $pdf->setPaper('a4')->stream('quote.pdf');
    }
}
