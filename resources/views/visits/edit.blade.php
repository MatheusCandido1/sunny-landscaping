@extends('layouts.partials')
@section('title', 'Costumers')
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
            <div class="col-md-4">
              <div class="form-group">
                  <label class="" for="inputFirstName">Name</label>
              <input name="name" class="form-control py-4" value="{{$visit->name}}" type="text" placeholder="" />
              </div>
          </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Date</label>
                  <input name="date" value="{{ date('Y-m-d\TH:i', strtotime($visit->date))}}" class="form-control py-4" id="inputFirstName" type="datetime-local" placeholder="" />
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="" for="inputLastName">Call costumer in (minutes)</label>
                  <input name="call_costumer_in" value="{{$visit->call_costumer_in}}" class="form-control py-4" id="inputLastName" type="number" placeholder="" />
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
                  <select required class="form-control" name="type" id="type" onchange='checkvalue(this.value)'>
                    <option value="">Select...</option>
                    <option {{ $visit->type == "Pavers" ? 'selected' : '' }} value="Pavers">Pavers</option>
                    <option {{ $visit->type == "Artificial Grass" ? 'selected' : '' }} value="Artificial Grass">Artificial Grass</option>
                    <option {{ $visit->type == "Landscaping" ? 'selected' : '' }} value="Landscaping">Landscaping</option>
                    <option {{ $visit->type == "Others" ? 'selected' : '' }} value="Others">Others</option>
                  </select>
            </div>
        </div>
            <div class="col-md-6">
            <input  name="costumer_id" value="{{$visit->id}}" class="form-control" type="hidden"  placeholder="" />
            <div id="color"  style='display:none'>
              <label class="" for="">Other type</label>
            <input name="type2" class="form-control py-4" type="text"/>
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