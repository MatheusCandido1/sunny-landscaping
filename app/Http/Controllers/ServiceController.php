<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Item;
use App\Service;

class ServiceController extends Controller
{

    public function destroy(Service $service)
    {
        $service = Service::where('id','=', $service->id)->first();
        $items = $service->items()->select('id')->get();

        for($i = 0; $i < $items->count(); $i++){
           Item::where('id','=', $items[$i]->id)->delete();
        }
        $service->delete();
        
        return redirect()->back();
    }

}
