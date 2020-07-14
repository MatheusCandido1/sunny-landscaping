@extends('layouts.partials')
@section('content')
<div class="container-fluid">
  <br>
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Approved</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Disapproved</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th style="text-align: center" scope="col">Quote #</th>
                        <th style="text-align: center" scope="col">Customer</th>
                        <th style="text-align: center" scope="col">Visit's Date - (Month)</th>
                        <th style="text-align: center" scope="col">Total</th>
                        <th style="text-align: center" scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($infos as $info)
                    @if($info->status == 1)
                    <tr>
                    <td style="text-align: center">#{{$info->service_id}}</td>
                    <td style="text-align: center">{{$info->customer_name}}</td>
                    <td  style="text-align: center">{{\Carbon\Carbon::parse($info->visit_date)->format("m/d/Y")}} - ({{$info->month}})</td>
                    <td style="text-align: center">$ {{number_format($info->total,2)}}</td>
                    <td style="text-align: center">
                    <a  href="{{ route('services.servicesByVisit', ['visit' => $info->visit_id, 'customer' => $info->customer_id])}}" type="button" class="btn btn-info btn-block">See Details</a>
                    </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th style="text-align: center" scope="col">Quote #</th>
                        <th style="text-align: center" scope="col">Customer</th>
                        <th style="text-align: center" scope="col">Visit's Date - (Month)</th>
                        <th style="text-align: center" scope="col">Total</th>
                        <th style="text-align: center" scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($infos as $info)
                    @if($info->status == 2)
                    <tr>
                      <td style="text-align: center">#{{$info->service_id}}</td>
                    <td style="text-align: center">{{$info->customer_name}}</td>
                    <td  style="text-align: center">{{\Carbon\Carbon::parse($info->visit_date)->format("m/d/Y")}} - ({{$info->month}})</td>
                    <td style="text-align: center">$ {{number_format($info->total,2)}}</td>
                    <td style="text-align: center">
                      <a  href="{{ route('services.servicesByVisit', ['visit' => $info->visit_id, 'customer' => $info->customer_id])}}" type="button" class="btn btn-info btn-block">See Details</a>
                    </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>
</div>
@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTable1').DataTable();
} );
$(document).ready(function() {
    $('#dataTable2').DataTable();
} );

</script>
@endsection
@endsection