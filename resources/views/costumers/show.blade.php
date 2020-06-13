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
                <button type="button" class="btn btn-primary"><i class="fas fa-home"></i> Visit</button>
                <button type="button" class="btn btn-success"><i class="fas fa-list-ul"></i> Quote</button>
              </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
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
@endsection