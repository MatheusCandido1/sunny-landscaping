@extends('layouts.partials')
@section('content')
<style>
    td { text-align: center; }
</style>
<div class="container-fluid">
  <br>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="status_data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th style="text-align: center" scope="col">Quote</th>
                        <th style="text-align: center" scope="col">Customer</th>
                        <th style="text-align: center" scope="col">Date</th>
                        <th style="text-align: center" scope="col">Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection