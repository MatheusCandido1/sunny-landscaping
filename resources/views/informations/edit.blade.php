@extends('layouts.partials')
@section('title', 'Referrals')
@section('content')
        <div class="container-fluid">
            <h1 class="mt-4">Edit Company Information</h1>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-comments"></i> Informations</div>
        <div class="card-body">
            <form  method="POST" class="form-horizontal style-form" action="{{ route('informations.update', $info->id) }}" > 
                @csrf
                @method('PUT')
          <div class="form-row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="address">Address</label>
                  <input name="address" class="form-control" id="inputFirstName" type="text" value="{{$info->address}}" />
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="address2">City/State/Zipcode</label>
                <input name="address2" class="form-control" id="inputFirstName" type="text" value="{{$info->address2}}" />
                </div>
            </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="phone1">Phone</label>
                    <input name="phone1" class="form-control" id="inputFirstName" type="text" value="{{$info->phone1}}" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="phone2">Phone (2)</label>
                    <input name="phone2" class="form-control" id="inputFirstName" type="text" value="{{$info->phone2}}" />
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