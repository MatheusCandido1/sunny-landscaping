@extends('layouts.partials')
@section('content')
<div class="container-fluid">
  <br>
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
    <div class="card text-white bg-primary" style="">
    <div class="card-header">Sent Proposal on {{$selected->month}} <a type="button" href="{{ route('dashboard.total')}}" style="color: white" class="btn btn-link float-right btn-sm">
        See all
      </a></div>
      <div class="card-body">
        <h5 class="card-title">Total amount: US$ {{number_format($selected->total,2)}} </h5>
        <h5> Quantity: {{$selected->quantity}} </h5>
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
            <i class="fas fa-chart-pie"></i> Projects by Status <a type="button" href="{{ route('dashboard.visits')}}">
              (Click here to see details)
            </a>
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
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart2->script() !!}
{!! $chart->script() !!}



@endsection
