@extends('layouts.partials')
@section('title', 'Costumers')
@section('content')
        <div class="container-fluid">
            <h1 class="mt-4">New Visit</h1>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-portrait"></i> Visit</div>
        <div class="card-body">
          <form  method="POST" class="form-horizontal style-form" action="{{ route('visits.store') }}" > 
            @csrf
          <div class="form-row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Date</label>
                      <input name="date" class="form-control py-4" id="inputFirstName" type="date" placeholder="" />
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputLastName">Call costumer in</label>
                      <input name="call_costumer_in" class="form-control py-4" id="inputLastName" type="number" placeholder="" />
                  </div>
              </div>
          </div>
          <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputFirstName">HOA</label>
                    <input name="hoa" class="form-control py-4" id="inputFirstName" type="text" placeholder="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputLastName">Water</label>
                    <input name="water_smart_rebate" class="form-control py-4" id="inputLastName" type="text" placeholder="" />
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputFirstName">Type</label>
                    <input name="type" class="form-control py-4" id="inputFirstName" type="text" placeholder="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputLastName">Costumer</label>
                    <input name="costumer_id" class="form-control py-4" id="inputLastName" type="number" placeholder="" />
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
@endsection