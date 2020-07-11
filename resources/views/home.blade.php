@extends('layouts.partials')
@section('content')
<div class="container-fluid">
  <br>
<div class="row">
  <div class="col-lg-6">
  <div class="card text-white bg-success" style="">
    <div class="card-header">Approved  <a type="button" href="" style="color: white" class="btn btn-link float-right btn-sm">
      See all
    </a></div>
    <div class="card-body">
      <h5 class="card-title">Total amount: R$ {{number_format($approved->total,2)}} / Quantity: {{$approved->quantity}}</h5>
      </div>
  </div>
  </div>
  <div class="col-lg-6">
    <div class="card text-white bg-danger" style="">
      <div class="card-header">Disapproved  <a type="button" href="" style="color: white" class="btn btn-link float-right btn-sm">
        See all
      </a></div>
      <div class="card-body">
        <h5 class="card-title">Total amount: {{number_format($disapproved->total,2)}} / Quantity: {{$disapproved->quantity}} </h5>
      </div>
    </div>
    </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>


@endsection
