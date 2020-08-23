@extends('layouts.partials')
@section('content')
<style>
    td { text-align: center; }
</style>
<div class="container-fluid">
  <br>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th style="text-align: center" scope="col">Quote</th>
                        <th style="text-align: center" scope="col">Customer</th>
                        <th style="text-align: center" scope="col">Status</th>
                        <th style="text-align: center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td style="text-align: center" >{{ $d->service_id}}</td>
                        <td style="text-align: center" >{{ $d->customer_name}}</td>
                        @if ($d->status == "Approved")
                        <td style="text-align: center" ><span class="btn btn-success">{{ $d->status}} </span></td>
                        @elseif($d->status == "Not Approved")
                        <td style="text-align: center" ><span class="btn btn-danger">{{ $d->status}} </span></td>
                        @elseif($d->status == "Sent Proposal")
                        <td style="text-align: center" ><span class="btn btn-primary">{{ $d->status}} </span></td>
                        @elseif($d->status == "Waiting")
                        <td style="text-align: center" ><span class="btn btn-secondary">{{ $d->status}} </span></td>
                        @endif
                        <td>
                        <a type="button" href="{{ route('visits.details',$d->visit_id) }}" class="btn btn-primary btn-sm btn-block">Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection