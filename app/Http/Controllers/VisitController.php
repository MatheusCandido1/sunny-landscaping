<?php

namespace App\Http\Controllers;

use App;
use App\Visit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            return view('visits.create', ['costumers' => \App\Costumer::all()]);
        }
        catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            if($request->type == "Others"){
                $type = $request->type2;
            }else{
                $type = $request->type;
            }
        $visit = Visit::create([
            'name' => $request->name,
            'date' => $request->date,
            'call_costumer_in' => $request->call_costumer_in,
            'hoa' => $request->hoa,
            'water_smart_rebate' => $request->water_smart_rebate
        ]);
        $visit->costumers()->sync($request->costumer_id);

        for($i = 0; $i < count($request->type); $i++){
            $visit->types()->attach($request->type[$i]);
        }
        toast('Project created with success!','success');
        return redirect()->route('costumers.projectsByCostumer', [$request->costumer_id]);

        }catch(\Exception $e) {
            toast('Pleasy try again!','error');

        return redirect()->route('costumers.projectsByCostumer', [$request->costumer_id]);
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
        $visit = DB::table('visits')->select('id','name','date','call_costumer_in','hoa','water_smart_rebate')->where('visits.id','=',$id)->first();
        return view('visits.edit', ['visit' => $visit]);
    }catch (Throwable $e) {
        toast('Pleasy try again!','error');
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
        $visit = Visit::where('id','=', $id)->first();
        $visit->fill($request->only('name','date','call_costumer_in','hoa','status','water_smart_rebate'));
        $visit->save();

        toast('Project updated with success!','success');

        return redirect()->route('costumers.visitByCostumer',$id);
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
