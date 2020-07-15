@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
        <div class="container-fluid">
            <h1 class="mt-4">Update Visit</h1>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-home"></i> Visits</div>
        <div class="card-body">
          <form  method="POST" class="form-horizontal style-form" action="{{ route('visits.update', $visit->id) }}" > 
            @csrf     
            @method('PUT')
          <div class="form-row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Date</label>
                  <input name="date" value="{{ date('Y-m-d\TH:i', strtotime($visit->date))}}" class="form-control py-4" id="inputFirstName" type="datetime-local" placeholder="" />
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputLastName">Call Customer in (minutes)</label>
                  <input name="call_customer_in" value="{{$visit->call_customer_in}}" class="form-control py-4" id="inputLastName" type="number" placeholder="" />
                  </div>
              </div>
          </div>
          <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputFirstName">HOA</label>
                    <br>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                          @if($visit->hoa === 1)
                          <input type="radio" checked value="1" class="form-check-input" name="hoa">Yes
                          @else
                          <input type="radio" value="1" class="form-check-input" name="hoa">Yes
                          @endif
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          @if($visit->hoa === 0)
                          <input type="radio" checked value="0" class="form-check-input" name="hoa">No
                          @else
                          <input type="radio" value="0" class="form-check-input" name="hoa">No
                          @endif
                        </label>
                      </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputFirstName">Water Smart Rebate</label>
                    <br>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                          @if($visit->water_smart_rebate === 1)
                          <input value="1" checked type="radio" class="form-check-input" name="water_smart_rebate">Yes
                          @else
                          <input value="1" type="radio" class="form-check-input" name="water_smart_rebate">Yes
                          @endif
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          @if($visit->water_smart_rebate === 0)
                          <input type="radio" checked value="0" class="form-check-input" name="water_smart_rebate">No
                          @else
                          <input type="radio"  value="0" class="form-check-input" name="water_smart_rebate">No
                          @endif
                        </label>
                      </div>
                    </div>
            </div>
        </div>
        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group">
              <label class="" for="">Type</label>
              <select style="width: 100%"  id="selectType" class="form-control" multiple="multiple" name="type[]" id="type[]">
                @foreach($types->sortBy('name') as $type)
              <option  {{in_array($type->id, $selecteds) ? 'selected':''}} value="{{$type->id}}" >{{$type->name}}</option>
                @endforeach
              </select>
        </div>
        </div>
            <div class="col-md-6">
            <input  name="customer_id" value="{{$visit->id}}" class="form-control" type="hidden"  placeholder="" />
           
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Save changes</button>   
      </form>
        </div>
    </div>
    </div>
    </div>
</div>
@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $('#selectType').select2({
      theme: "classic",
      placeholder: "Select a type of service",
      tags: true
    });
    
});
</script>
@endsection
@endsection