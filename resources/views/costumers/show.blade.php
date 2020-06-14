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
            <h1 class="mt-4">Information</h1>
  <div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-portrait"></i> Costumers Information</div>
            <div class="card-body">
                <div class="row">
                <div class="col-12 col-lg-8 col-md-6">
                    <h3 class="mb-0 text-truncated">{{$costumer->name}}</h3>
                    <p class="lead"> <i class="fas fa-envelope-square"></i> E-mail: {{$costumer->email}}</p>
                    <p class="lead"> <i class="fas fa-phone-square"></i> Phone: {{$costumer->phone}}</p>
                    <p class="lead"> <i class="fas fa-mobile-alt"></i> Cellphone: {{$costumer->cellphone}}</p>
                    <p class="lead"> <i class="fas fa-map-marked-alt"></i> Address: {{$costumer->address}}</p>
                    <p class="lead"> <i class="fas fa-warehouse"></i> Gate code: <span class="badge badge-secondary">{{$costumer->gate_code}}</span></p>
                </div>
                <!--/col-->
            </div>
            
            <div class="btn-group special" role="group" aria-label="Basic example">
                <button type="button" disabled class="btn btn-success"><i class="fas fa-list-ul"></i> Quote</button>
              </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-home"></i> Visit</div>
            <div class="card-body">
                    <div class="container">
                      <h1 class="display-4">Please schedule a visit!</h1>
                      <p class="lead">After scheduling a visit, all the information will be displayed here.</p>
                    </div>
                    <div class="btn-group special" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-home"></i> Visit</button>
                    </div>

            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-file-alt"></i> Files and Documents</div>
            <div class="card-body">
                    <div class="container">
                      <h1 class="display-4">Print the documents!</h1>
                      <p class="lead">Click in any button and a PDF will be displayed.</p>
                      <p class="lead">
                          <div class="row">
                        <div class="col-lg-3 text-center">
                            <button type="button" class="btn btn-success  btn-block"><i class="fas fa-print"></i> Proposal</button>
                        </div>
                        <div class="col-lg-9 text-center">
                            <button type="button" class="btn btn-success btn-block"><i class="fas fa-print"></i> Unconditional Waiver and Release</button>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-lg-4 text-center">
                            <button type="button" class="btn btn-success  btn-block"><i class="fas fa-print"></i> Contract</button>
                        </div>
                        <div class="col-lg-4 text-center">
                            <button type="button" class="btn btn-success btn-block"><i class="fas fa-print"></i> Quote</button>
                        </div>
                        <div class="col-lg-4 text-center">
                            <button type="button" class="btn btn-success btn-block"><i class="fas fa-print"></i> Change Order</button>
                        </div>
                    </div>
                      </p>
                    </div>
            </div>
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
          <form method="POST" class="form-horizontal style-form" action="{{ route('visits.store') }}" > 
            @csrf
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
                      <input name="hoa" type="radio" class="form-check-input" value="1">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input value="0" type="radio" class="form-check-input" name="hoa">No
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
                      <input value="1" type="radio" class="form-check-input" name="hoa">Yes
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input value="0" type="radio" class="form-check-input" name="hoa">No
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
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