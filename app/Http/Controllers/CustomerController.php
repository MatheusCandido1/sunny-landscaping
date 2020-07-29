<?php

namespace App\Http\Controllers;


use App;
use App\Customer;
use App\Item;
use App\Type;
use App\Visit;
use App\City;
use App\Seller;
use App\Status;
use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use PDF;
use TJGazel\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = DB::table('visits')
            ->selectRaw('visits.id as visit_id, customers.id as customer_id, customers.name as customer_name, customers.phone, customers.address, statuses.id as status_id, statuses.name as status_name, visits.proposal_date')
            ->join('customers','customers.id','=','visits.customer_id')
            ->join('cities', 'customers.city_id','=','cities.id')
            ->join('statuses', 'visits.status_id','=','statuses.id')
            ->join('referrals', 'customers.referral_id','=','referrals.id')
            ->get();

            $statusArray = array(1 => 'outline-secondary', 2 => 'outline-primary', 3 => 'outline-success', 4 => 'outline-dark', 5 => 'outline-info', 6 => 'outline-success', 7 => 'outline-danger');

            return view('customers.index', ['statusArray' => $statusArray, 'customers' => $data,'statuses' => Status::all()]);
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create',['cust' => Customer::all(), 'referrals' => Referral::all(),'cities' => City::all(),'sellers' => Seller::all()]);

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
            $data = $request->all();
        if(isset($data['cellphone'])){
            $cellphone = true;
        }else{
            $cellphone = false;

        }

        $customer = Customer::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'cross_street1' => $data['cross_street1'],
            'cross_street2' => $data['cross_street2'],
            'gate_code' => $data['gate_code'],
            'state' => $data['state'],
            'zipcode' => $data['zipcode'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'parcel_number' => $data['parcel_number'],
            'referral_id' => $data['referral_id'],
            'city_id' => $data['city_id'],
            'seller_id' => $data['seller_id'],
            'cellphone' => $cellphone,
            'company' => $data['company'],
            'company_name' => $data['company_name'],
            'company_address' => $data['company_address'],
            'company_state' => $data['company_state'],
            'company_city' => $data['company_city'],
            'company_zipcode' => $data['company_zipcode']
        ]);

        $customer->save();
        toast('New customer added with success!','success');
        return redirect()->route('visits.visitsByCustomer', $customer->id); 
        } catch (Throwable $e) {
            toast('Pleasy try again!','error');

        }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    
    */


    public function show(){

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
            $customer = DB::table('customers')->select('id','gender','name','address','cross_street1','cross_street2','parcel_number','gate_code','city_id','state','zipcode','phone','cellphone','email','company','company_name','company_address','company_state','company_zipcode','company_city','referral_id','seller_id')->where('customers.id','=',$id)->first();
            return view('customers.edit', ['customer' => $customer,'referrals' => Referral::all(),'cities' => City::all(),'sellers' => Seller::all()]);
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
            $customer = customer::where('id','=', $id)->first();
            $customer->fill($request->only('name','gender','address','cross_street1','cross_street2','gate_code','city_id','state','zipcode','phone','cellphone','email', 'company','company_name','company_address','company_state','company_zipcode','company_city','referral_id','seller_id','parcel_number'));
            $customer->save();
            toast('Customer updated with success!','success');
            return redirect()->route('customers.index');
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
        try{
            $customer = Customer::where('id','=', $id)->first();
            $customer->delete();

            toast('Customer deleted with success!','success');
            return redirect()->back();
        }catch (Throwable $e) {
            toast('Pleasy try again!','error');
        }
        
    }
}
