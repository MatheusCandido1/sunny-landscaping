@extends('layouts.partials')
@section('title', 'Referrals')
@section('content')
        <div class="container-fluid">
            <h1 class="mt-4">Edit Supplier</h1>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-truck"></i> Suppliers</div>
        <div class="card-body">
            <form  method="POST" class="form-horizontal style-form" action="{{ route('suppliers.update', $supplier->id) }}" > 
                @csrf
                @method('PUT')
          <div class="form-row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Name</label>
                  <input name="name" class="form-control" id="inputFirstName" type="text" value="{{$supplier->name}}" />
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Unit Price</label>
                  <input name="value" class="form-control" id="inputFirstName" type="text" value="{{$supplier->value}}" />
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