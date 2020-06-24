@extends('layouts.partials')
@section('title', 'Costumers')
@section('content')
        <div class="container-fluid">
            <h1 class="mt-4">New costumer</h1>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-user-check"></i> Costumers</div>
        <div class="card-body">
          <form  method="POST" class="form-horizontal style-form" action="{{ route('costumers.store') }}" > 
            @csrf
          <div class="form-row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Name</label>
                      <input name="name" class="form-control py-4" id="inputFirstName" type="text" placeholder="" />
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="" for="inputLastName">Address</label>
                      <input name="address" class="form-control py-4" id="inputLastName" type="text" placeholder="" />
                  </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputLastName">Cross Streets</label>
                    <div class="input-group mb-3">
                        <input type="text" name="cross_street1" class="form-control py-4" placeholder="">
                        <div class="input-group-prepend">
                            <span class="input-group-text">/</span>
                          </div>
                        <input type="text" name="cross_street2" class="form-control py-4" placeholder="">
                      </div>
                </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputFirstName">Gate Code</label>
                    <input name="gate_code" class="form-control py-4" id="inputFirstName" type="text" placeholder="" />
                </div>
            </div>
            <div class="col-md-4">
                
                <label class="" for="inputFirstName">City / State</label>
                <div class="input-group mb-3">
                    <input type="text" name="city" class="form-control py-4" placeholder="">
                    <input type="text" name="state" class="form-control py-4" value="Nevada">
                  </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputLastName">Zip Code</label>
                    <input name="zipcode" class="form-control py-4" id="inputLastName" type="text" placeholder="" />
                </div>
            </div>
            
        </div>
        <div class="form-row">
            <div class="col-md-6">
                
                    <label class="" for="inputLastName">Phone</label>
                <div class="input-group mb-3">
                    
                    <input type="text"  name="phone" class="form-control py-4" aria-label="Text input with checkbox">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Cellphone &nbsp;
                          <input type="checkbox"  name="cellphone" >
                        </div>
                      </div>
                  </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputLastName">E-mail</label>
                    <input name="email" class="form-control py-4" id="inputLastName" type="text" placeholder="" />
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                      <label class="" for="">Referral</label>
                      <select required class="form-control" name="referred" id="referred" onchange='checkvalue(this.value)'>
                        <option value="">Select...</option>
                        <option value="Craiglist">Craigslist</option>
                        <option value="Friend">Friend</option>
                        <option value="From Advertisement">From Advertisement</option>
                        <option value="Google">Google</option>
                        <option value="Home Advertisement">Home Advertisement</option>
                        <option value="Neighbor">Neighbor</option>
                        <option value="Yelp">Yelp</option>
                        <option value="Past Costumer">Past Costumer</option>
                        <option value="Others">Others</option>
                      </select>
                </div>
            </div>
            <div id="color" class="col-md-6" style='display:none'>
                <label class="" for="inputLastName">New Referral</label>
                <input type="text" class="form-control" name="referred2" />
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Save changes</button>   
      </form>
        </div>
    </div>
    </div>
    </div>
</div>
    <script>
        function checkvalue(val)
{
    if(val==="Others")
       document.getElementById('color').style.display='block';
    else
       document.getElementById('color').style.display='none'; 
}
    </script>
@endsection