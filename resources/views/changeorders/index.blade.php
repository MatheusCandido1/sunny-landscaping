@extends('layouts.partials')
@section('title', 'Change Orders')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Change Orders</h1>
{{ Breadcrumbs::render('services', $customer, $visit) }}

<div class="card mb-4">
    <div class="card-header">All your change orders are here!
    <a type="button" href="{{ route('changeorders.createChange', ['visit' => $visit, 'customer' => $customer])}}" class="btn btn-primary float-right btn-sm">
        New Change Order
    </a>
  </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 18%" scope="col" >Change Order #</th>
                        <th style="text-align: center" scope="col" >Date</th>
                        <th style="text-align: center" scope="col">Change Order Amount</th>
                        <th style="text-align: center" scope="col">Revised Contract Amount</th>
                        <th style="text-align: center" scope="col">Document</th>
                        <th style="text-align: center" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($changeorders as $orders)
                    <tr>
                    <td style="text-align: center; ">#{{$orders->change_order_key}} </td>
                    <td style="text-align: center">{{\Carbon\Carbon::parse($orders->date)->format('m/d/yy')}} </td>
                    <td style="text-align: center">$ {{number_format($orders->change_order_amount,2)}}</td>
                    
                    <td style="text-align: center">$ {{number_format($orders->revised_contract_amount,2)}}</td>
                    <td style="text-align: center;" scope="col">
                        <a target="_blank" href="{{ route ('pdf.change', ['changeorder'=> $orders->id,'visit' => $visit])}}" class="btn btn-success btn-block"><i class="fas fa-print"></i></a>
 
                    </td>
                    <td style="text-align: center;" scope="col">
                        @if($orders->id == $last)
                        <a  href="{{route('changeorders.editChange', ['changeorder' => $orders->id ,'visit'=>$visit, 'customer' => $customer])}}" type="button" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a>  
                        @endif
                        <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this change order?')) { document.getElementById('destroy-form-{{$orders->id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                        <form id="destroy-form-{{$orders->id}}" action="{{ route('changeorders.destroy',$orders->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
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