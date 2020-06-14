@extends('layouts.partials')
@section('title', 'Costumers')
@section('content')
<div class="container-fluid">
  <h1 class="mt-4">Visit</h1>
<div class="row">
<div class="col-lg-12">
<div class="card mb-4">
    <div class="card-header"><i class="fas fa-portrait"></i> Visit</div>
    <div class="card-body">
      <form class="form-horizontal style-form" action="{{ route('visits.store') }}" method="post"> 
        @csrf
        <div class="form-row">
          <div class="form-group">
          <label>Costumer</label>
              
      </div>
        </div>
      <div class="form-row">
          <div class="col-md-6">
              <div class="form-group">
                  <label class="" for="inputFirstName">Date and Time</label>
                  <input name="date" class="form-control py-4" id="inputFirstName" type="datetime-local" placeholder="" />
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
          <label class="col-sm-2 ">HOA: </label>
          <div class="col-sm-10">
          <div class="form-check-inline">
              <label class="form-check-label">
                <input name="hoa" type="radio" class="form-check-input" value="1"/>Yes
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input value="0" type="radio" class="form-check-input" name="hoa"/>No
              </label>
            </div>            
          </div>
      </div>
          </div>
          <div class="col-md-6">
      <div class="form-group">
          <label class="col-sm-12">Water Smart Rebate: </label>
          <div class="col-sm-12">
          <div class="form-check-inline">
              <label class="form-check-label">
                <input value="1" type="radio" class="form-check-input" name="smart"/>Yes
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input value="0" type="radio" class="form-check-input" name="smart"/>No
              </label>
            </div>            
          </div>
      </div>
          </div>
      </div>
      <div class="form-row">
          <div class="col-md-6">
          <div class="form-group">
              <label for="exampleFormControlSelect1">Service type</label>
              <select name="type" onchange="yesnoCheck(this);" class="form-control" id="exampleFormControlSelect1">
                <option value="Pavers">Pavers</option>
                <option value="Artificial Grass">Artificial Grass</option>
                <option value="Landscaping">Landscaping</option>
                <option value="other">Other</option>
              </select>
            </div>
      </div>
      <div id="ifYes" style="display:none;" class="col-md-6">
          <div class="form-group">
              <label class="" for="inputPassword">Other</label>
              <input name="type" class="form-control py-4" id="inputPassword" type="text" placeholder="" />
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
@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
    $('#costumer_id').select2();
});
    </script>
<script> 
  function yesnoCheck(that) {
      if (that.value == "other") {
          document.getElementById("ifYes").style.display = "block";
      } else {
          document.getElementById("ifYes").style.display = "none";
      }
  }
  </script>
@endsection