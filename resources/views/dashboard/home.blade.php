@extends('layouts.partials')
@section('content')
<div class="container-fluid">
  <br>
  @if(!isset($approved) || !isset($disapproved))
  <div class="alert alert-info" role="alert">
    <h4 class="alert-heading">Ops!</h4>
    <p>The dashboard will be showed when data exists.</p>
    <hr>
    <p class="mb-0">After creating new customers, visits and quotes, the dashboard will be available.</p>
  </div>
  @else
<div class="row">
  <div class="col-lg-6">
  <div class="card text-white bg-success" style="">
  <div class="card-header">Approved on {{$approved->month}}  <a type="button" href="{{ route('dashboard.status')}}" style="color: white" class="btn btn-link float-right btn-sm">
      See all
    </a></div>
    <div class="card-body">
      <h5 class="card-title">Total amount: US$ {{number_format($approved->total,2)}} </h5> 
      <h5>Quantity: {{$approved->quantity}}</h5>
      </div>
  </div>
  </div>
  <div class="col-lg-6">
    <div class="card text-white bg-danger" style="">
    <div class="card-header">Not Approved on {{$disapproved->month}} <a type="button" href="" style="color: white" class="btn btn-link float-right btn-sm">
        See all
      </a></div>
      <div class="card-body">
        <h5 class="card-title">Total amount: US$ {{number_format($disapproved->total,2)}} </h5>
        <h5> Quantity: {{$disapproved->quantity}} </h5>
      </div>
    </div>
    </div>
</div>
<br>
<div class="row">
  <div class="col-lg-12">
    <div class="card border-dark" style="">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-6">
            <i class="fas fa-chart-bar"></i> Approved and Disapproved by Month
          </div>
          <div class="col-lg-6">
            <i class="fas fa-chart-pie"></i> Projects by Status
              </div>
        </div>
      </div>
      <div class="card-body text-dark">
       <div class="row">
         <div class="col-lg-6">
          {!! $chart2->container() !!}

           </div>
           <div class="col-lg-6">
            {!! $chart->container() !!}

          </div>
           </div>
  </div>
</div>
  </div>
</div>
@endif
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart2->script() !!}
{!! $chart->script() !!}



@endsection
