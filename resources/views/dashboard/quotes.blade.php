@extends('layouts.partials')
@section('content')
<style>
    td { text-align: center; }
</style>
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="mt-4" id="monthName"></h1>
        </div>
    </div>
  <br>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th style="text-align: center" scope="col">Quote</th>
                        <th style="text-align: center" scope="col">Customer</th>
                        <th style="text-align: center" scope="col">Address</th>
                        <th style="text-align: center" scope="col">Status</th>
                        <th style="text-align: center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotes as $quote)
                    <tr>
                        <td >{{$quote->service_id}}</td>
                        <td >{{$quote->customer_name}}</td>
                        <td >{{$quote->address}}</td>
                        @if ($quote->status == "Approved")
                        <td style="text-align: center" ><span class="btn btn-success">{{ $quote->status}} </span></td>
                        @elseif($quote->status == "Not Approved")
                        <td style="text-align: center" ><span class="btn btn-danger">{{ $quote->status}} </span></td>
                        @elseif($quote->status == "Sent Proposal")
                        <td style="text-align: center" ><span class="btn btn-primary">{{ $quote->status}} </span></td>
                        @elseif($quote->status == "Waiting")
                        <td style="text-align: center" ><span class="btn btn-secondary">{{ $quote->status}} </span></td>
                        @endif
                        <td>
                            <a href=" {{ route('services.servicesByVisit', ['visit' => $quote->visit_id, 'customer' => $quote->customer_id]) }}" type="button"  class="btn btn-info">See Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('script')
<script type="text/javascript">

$(document).ready(function(){
    
window.onload = function() {
    const today = new Date()
    const month = today.toLocaleString('En', { month: 'long' })
    document.getElementById('monthName').innerHTML = 'Quotes on ' + month;
  };

});
</script>
@endsection
@endsection