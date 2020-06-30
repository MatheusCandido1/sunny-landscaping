@extends('layouts.partials')
@section('title', 'Costumers')
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
<h1 class="mt-4">Projects</h1>
<div class="card mb-4">
  @if(empty($projects[0]->id))
<div class="card-header">Here you can see all projects!
      <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right btn-sm">
        New Project
    </button>
  </div>
  @else
  <div class="card-header">Here you can see all {{$projects[0]->cost_name}}'s projects!
    <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right btn-sm">
      New Project
  </button>
</div>
@endif
    <div class="card-body">

        <div class="table-responsive">
           
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Project's name</th>
                        <th style="text-align: center" scope="col">Date</th>
                        <th style="text-align: center" scope="col">Seller</th>
                        <th style="text-align: center" scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                  @foreach($projects as $project)
                    <tr>
                        <td >{{ $project->name}}</td>
                        <td >{{ \Carbon\Carbon::parse($project->date)->format("m/d/Y")}}</td>
                        <td >{{ $project->seller}}</td>
                        <td style="text-align: center;" scope="col">
                          <a type="button" href="{{ route('costumers.visitByCostumer',$project->id) }}" class="btn btn-primary btn-sm btn-block">Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div><br>
        <div class="btn-group special" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary"><i class="fas fa-print"></i> Print all proposals</button>  
          <button type="button" class="btn btn-success"><i class="fas fa-envelope"></i> Send all proposals to costumer</button>                         
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
                      <label class="" for="inputLastName">Call costumer in (minutes)</label>
                      <input name="call_costumer_in" class="form-control py-4" id="inputLastName" type="number" placeholder="" />
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
            <div class="col-md-4">
              <div class="form-group">
                <label class="" for="">Seller</label>
                <select id="" class="form-control" name="seller">
                  <option value="">Select...</option>
                  <option value="Ray">Ray</option>
                  <option value="Helio">Helio</option>
                  <option value="Glaucia">Glaucia</option>
                </select>
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
            <input  name="costumer_id" value="{{$id[0]}}" class="form-control" type="hidden"  placeholder="" />
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