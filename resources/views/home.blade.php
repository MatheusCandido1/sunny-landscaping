@extends('layouts.partials')
@section('content')
<div class="container-fluid">
  <h1 class="mt-4">Dashboard</h1>
<div class="row">
  <div class="col-lg-6">
    <div class="card mb-4">
      <div class="card-header"><i class="fas fa-chart-bar"></i> Quote numbers by month</div>
      <div class="card-body">
  {!! $chart->container() !!}
      </div>
    </div>
  </div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart->script() !!}


@endsection
