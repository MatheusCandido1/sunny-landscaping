@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
        <div class="container-fluid">
            <h1 class="mt-4">New Customer</h1>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-user-check"></i> Customers</div>
        <div class="card-body">
            <form  method="POST" class="form-horizontal style-form" action="{{ route('customers.update', $customer->id) }}" > 
                @csrf
                @method('PUT')
          <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputLastName">Name</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        @if($customer->gender == "Mrs")
                                        <input type="radio" checked required value="Mrs" class="form-check-input" name="gender">Mrs
                                        @else
                                        <input type="radio" required value="Mrs" class="form-check-input" name="gender">Mrs
                                        @endif                                    </label>
                                  </div>
                                  <div class="form-check-inline">
                                    <label class="form-check-label">
                                        @if($customer->gender == "Mr")
                                        <input type="radio" checked required value="Mr" class="form-check-input" name="gender">Mr
                                        @else
                                        <input type="radio" required value="Mr" class="form-check-input" name="gender">Mr
                                        @endif
                                    </label>
                                  </div>
                                
                            </span>
                          </div>
                        <input type="text" name="name" class="form-control" value="{{$customer->name}}" placeholder="">
                        
                      </div>
                </div>
            </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="" for="inputLastName">Address</label>
                      <input name="address" class="form-control" type="text" value="{{$customer->address}}" placeholder="" />
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputLastName">Cross Streets</label>
                    <div class="input-group mb-3">
                        <input value="{{$customer->cross_street1}}" type="text" name="cross_street1" class="form-control" placeholder="">
                        <div class="input-group-prepend">
                            <span class="input-group-text">/</span>
                          </div>
                        <input value="{{$customer->cross_street2}}" type="text" name="cross_street2" class="form-control" placeholder="">
                      </div>
                </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputFirstName">Gate Code</label>
                    <input value="{{$customer->gate_code}}" name="gate_code" class="form-control " id="inputFirstName" type="text" placeholder="" />
                </div>
            </div>
            <div class="col-md-4">
                
                <label class="" for="inputFirstName">City / State</label>
                <div class="input-group mb-3">
                    <select required class="form-control" name="city_id" id="">
                        <option value="">Select...</option>
                        @foreach ($cities->sortBy('name') as $city)
                      <option {{ $customer->city_id == $city->id ? 'selected' : ''}} value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                      </select>      
                      <input type="text" name="state" class="form-control" readonly value="Nevada">
                  </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputLastName">Zip Code</label>
                    <input name="zipcode" value="{{$customer->zipcode}}" class="form-control " id="inputLastName" type="text" placeholder="" />
                </div>
            </div>
            
        </div>
        <div class="form-row">
            <div class="col-md-4">
                
                    <label class="" for="inputLastName">Phone</label>
                <div class="input-group mb-3">
                    
                    <input type="text" value="{{$customer->phone}}"  name="phone" class="form-control" aria-label="Text input with checkbox">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Cellphone &nbsp;
                            <input type="hidden" name="cellphone" value="0">
                          <input  {{ $customer->cellphone == 1 ? 'checked' : ''}} value="" onclick="check()"  id="cellphone" type="checkbox"  name="cellphone" >
                        </div>
                      </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputLastName">E-mail</label>
                    <input name="email" value="{{$customer->email}}" class="form-control " id="inputLastName" type="text" placeholder="" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputLastName">Parcel #</label>
                    <input name="parcel_number" value="{{$customer->parcel_number}}" class="form-control" id="inputLastName" type="text" placeholder="" />
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                      <label class="" for="">Referral</label>
                      <select required class="form-control" name="referral_id" id="">
                        <option value="">Select...</option>
                        @foreach ($referrals->sortBy('name') as $referral)
                      <option {{ $customer->referral_id == $referral->id ? 'selected' : ''}} value="{{$referral->id}}">{{$referral->name}}</option>
                        @endforeach
                      </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                      <label class="" for="">Seller</label>
                      <select required class="form-control" name="seller_id" id="">
                        <option value="">Select...</option>
                        @foreach ($sellers->sortBy('name') as $seller)
                        <option  {{ $customer->seller_id == $seller->id ? 'selected' : ''}} value="{{$seller->id}}">{{$seller->name}}</option>
                          @endforeach
                      </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Company</label>
                      <br>
                      <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" {{ $customer->company == 1 ? 'checked' : ''}} value="1" onchange='checkvalue(this.value)' class="form-check-input" name="company">Yes
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" {{ $customer->company == 0 ? 'checked' : ''}}  value="0" onchange='checkvalue(this.value)' class="form-check-input" name="company">No
                          </label>
                        </div>
                  </div>
              </div>
            </div>
            <div id="company" style="display: {{ $customer->company == 1 ? 'block' : 'none'}}">
                <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputLastName">Company's Address</label>
                      <input name="company_address" class="form-control" type="text" value="{{$customer->company_address}}" placeholder="" />
                  </div>
              </div>
            <div class="col-md-6">
                <label class="" for="inputFirstName">Company's City / Company's State</label>
                <div class="input-group mb-3">
                    <select class="form-control" name="company_city" id="">
                        <option value="">Select...</option>
                        @foreach ($cities->sortBy('name') as $city)
                      <option {{ $customer->company_city == $city->name ? 'selected' : ''}}  value="{{$city->name}}">{{$city->name}}</option>
                        @endforeach
                      </select>      
                      <input type="text" name="company_state" class="form-control"  value="{{$customer->company_state}}">
                  </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputLastName">Company's Zip Code</label>
                    <input name="company_zipcode" value="{{$customer->company_zipcode}}" class="form-control " id="inputLastName" type="text" placeholder="" />
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label class="" for="inputLastName">Company's name</label>
                  <input name="company_name" class="form-control" value="{{$customer->company_name}}" id="inputLastName" type="text" placeholder="" />
              </div>
          </div>
            </div>
              </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Save changes</button>   
      </form>
        </div>
    </div>
    </div>
    </div>
</div>
<script type="text/javascript">
function check(){
    if(document.getElementById("cellphone").checked)
    {
    document.getElementById("cellphone").value = '1'
    }
    else{
    document.getElementById("cellphone").value = '0'
    }
}

function checkvalue(val)
{
    if(val==="1")
       document.getElementById('company').style.display='block';
    else
       document.getElementById('company').style.display='none'; 
}
</script>
@endsection