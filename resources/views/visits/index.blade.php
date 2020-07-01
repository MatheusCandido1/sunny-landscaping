@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
<style>
  .btn-group.special {
display: flex;
}

.special .btn {
flex: 1
}
</style>
<div class="container-fluid">
<h1 class="mt-4">Visits</h1>
<div class="card mb-4">
  @if(empty($visits))
<div class="card-header">Here you can see all visits!
      <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right btn-sm">
        New Visit
    </button>
  </div>
  @else
<div class="card-header">Here you can see all customer's visits!
    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right btn-sm">
      New Visit
  </button>
</div>
@endif
    <div class="card-body">

        <div class="table-responsive">
           
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Visit's name</th>
                        <th style="text-align: center" scope="col">Date</th>
                        <th style="text-align: center" scope="col">Type</th>
                        <th style="text-align: center" scope="col">Information</th>
                        <th style="text-align: center" scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                  @foreach($visits as $visit)
                    <tr>
                        <td >{{ $visit->name}}</td>
                        <td >{{ \Carbon\Carbon::parse($visit->date)->format("m/d/Y")}}</td>
                        <td></td>
                        <td>                        
                          <a type="button" href="{{ route('visits.details',$visit->id) }}" class="btn btn-primary btn-sm btn-block">Details</a>
                        </td>
                        <td style="text-align: center;" scope="col">
                        <a  href="{{route('visits.edit', $visit->id)}}" type="button" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                        <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this visit?')) { document.getElementById('destroy-form-{{$visit->id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        <form id="destroy-form-{{$visit->id}}" action="{{ route('visits.destroy',$visit->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form> 

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div><br>
        <div class="btn-group special" role="group" aria-label="Basic example">
        <a target="_blank" type="button" href="{{route('pdf.front')}}" class="btn btn-info"><i class="fas fa-file"></i> Project Front Page</a>  
          <button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Print all proposals</button>  
          <button type="button" class="btn btn-success"><i class="fas fa-envelope"></i> Send all proposals to customer</button>                         
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Schedule Visit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form  method="POST" class="form-horizontal style-form" action="{{ route('visits.store') }}" > 
            @csrf
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                  <label class="" for="inputFirstName">Name</label>
                  <input name="name" class="form-control py-4" type="text" placeholder="" />
              </div>
          </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Date</label>
                      <input name="date" class="form-control py-4" id="inputFirstName" type="datetime-local" placeholder="" />
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group">
                      <label class="" for="inputLastName">Call customer in (minutes)</label>
                      <input name="call_customer_in" class="form-control py-4" id="inputLastName" type="number" placeholder="" />
                  </div>
              </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputFirstName">HOA</label>
                    <br>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" value="1" class="form-check-input" name="hoa">Yes
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" value="0" class="form-check-input" name="hoa">No
                        </label>
                      </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="" for="inputFirstName">Water Smart Rebate</label>
                    <br>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                          <input value="1" type="radio" class="form-check-input" name="water_smart_rebate">Yes
                        </label>
                      </div>
                      <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" value="0" class="form-check-input" name="water_smart_rebate">No
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
                    @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                  </select>
            </div>
          <input  name="customer_id" value="{{$customer[0]}}" class="form-control" type="hidden"  placeholder="" />
        </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Save changes</button>   
      </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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