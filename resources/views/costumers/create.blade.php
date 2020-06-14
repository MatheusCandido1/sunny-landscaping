@extends('layouts.partials')
@section('title', 'Costumers')
@section('content')
        <div class="container-fluid">
            <h1 class="mt-4">New costumer</h1>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-portrait"></i> Visit</div>
        <div class="card-body">
          <form  method="POST" class="form-horizontal style-form" action="{{ route('costumers.store') }}" > 
            @csrf
          <div class="form-row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Name</label>
                      <input name="name" class="form-control py-4" id="inputFirstName" type="text" placeholder="" />
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputLastName">Address</label>
                      <input name="address" class="form-control py-4" id="inputLastName" type="text" placeholder="" />
                  </div>
              </div>
          </div>
          <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputFirstName">Gate Code</label>
                    <input name="gate_code" class="form-control py-4" id="inputFirstName" type="text" placeholder="" />
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
                    <label class="" for="inputFirstName">Phone</label>
                    <input name="phone" class="form-control py-4" id="inputFirstName" type="text" placeholder="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputLastName">Cellphone</label>
                    <input name="cellphone" class="form-control py-4" id="inputLastName" type="text" placeholder="" />
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