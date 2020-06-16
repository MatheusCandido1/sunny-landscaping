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
                    <h3 class="mb-0 text-truncated">{{$data->name}}</h3>
                    <p class="lead"> <i class="fas fa-envelope-square"></i> E-mail: {{$data->email}}</p>
                    <p class="lead"> <i class="fas fa-phone-square"></i> Phone: {{$data->phone}}</p>
                    <p class="lead"> <i class="fas fa-mobile-alt"></i> Cellphone: {{$data->cellphone}}</p>
                    <p class="lead"> <i class="fas fa-map-marked-alt"></i> Address: {{$data->address}}</p>
                    <p class="lead"> <i class="fas fa-warehouse"></i> Gate code: <span class="badge badge-secondary">{{$data->gate_code}}</span></p>
                </div>
                <!--/col-->
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-home"></i> Visit</div>
            <div class="card-body">
                <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <p class="lead"><i class="fas fa-calendar"></i> Date: {{ \Carbon\Carbon::parse($data->date)->format('l, jS \\of F Y h:i:s A')}}</p>
                    <p class="lead"> <i class="fas fa-phone-square"></i> Call costumer in : {{$data->call_costumer_in}} minutes</p>
                    <p class="lead"> <i class="fas fa-mobile-alt"></i> HOA: {{ $data->hoa == 0 ? 'No' : 'Yes'}}</p>
                    <p class="lead"> <i class="fas fa-map-marked-alt"></i> Water Smart Rebate: {{$data->water_smart_rebate == 0 ? 'No' : 'Yes'}}</p>
                </div>
                <!--/col-->
            </div>
            
            <div class="btn-group special" role="group" aria-label="Basic example">
                <a href="{{ route('costumers.quote') }}" type="button" disabled class="btn btn-success"><i class="fas fa-list-ul"></i> Quote</a>
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
                            <a href="{{ route('costumers.pdfquote', $data->visit_id)}}" type="button" class="btn btn-success  btn-block"><i class="fas fa-print"></i> Proposal</a>
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