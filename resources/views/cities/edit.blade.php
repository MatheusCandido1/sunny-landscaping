@extends('layouts.partials')
@section('title', 'Referrals')
@section('content')
        <div class="container-fluid">
            <h1 class="mt-4">Edit City</h1>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-city"></i> Cities</div>
        <div class="card-body">
            <form  method="POST" class="form-horizontal style-form" action="{{ route('cities.update', $city->id) }}" > 
                @csrf
                @method('PUT')
          <div class="form-row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Name</label>
                  <input name="name" class="form-control" id="inputFirstName" type="text" value="{{$city->name}}" />
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