<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Service;

class ServiceController extends Controller
{
    public function storeItems(Request $request)
    {
       
    }

    public function destroy(Service $service)
    {
        $service = Service::where('id','=', $service->id)->first();
        $service->delete();
        return redirect()->back();
    }

}
