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
        Service::destroy($service->id);
        return redirect()->back();
    }

}
