@extends('layouts.partials')
@section('title', 'Change Orders')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Change Orders</h1>
<div class="card mb-4">
    <div class="card-header">All your change orders are here!
    <a type="button" href="{{ route('changeorders.createChange', $visit_id)}}" class="btn btn-primary float-right btn-sm">
        New Change Order
    </a>
  </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Change Order #</th>
                        <th style="text-align: center" scope="col">Original Amount</th>
                        <th style="text-align: center" scope="col">Change Order Amount</th>
                        <th style="text-align: center" scope="col">Document</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($changeorders as $orders)
                    <tr>
                    <td style="text-align: center"> </td>
                    <td style="text-align: center"> </td>
                    <td style="text-align: center"> </td>
                    
                    <td style="text-align: center"> </td>
                    <td style="text-align: center;" scope="col">
                        
                  
                      <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this quote?')) { document.getElementById('destroy-form-').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
             

                    </td>
                    <td style="text-align: center">
                     
                    </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script>
</script>

@endsection