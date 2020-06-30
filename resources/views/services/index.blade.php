@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Services</h1>
<div class="card mb-4">
    <div class="card-header">All your  are here!
      <a href="{{ route('quotes.create') }}" class="btn btn-primary float-right btn-sm">
        New Quote
    </a>
  </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >#</th>
                        <th style="text-align: center" scope="col">Total</th>
                        <th style="text-align: center" scope="col">Final balance</th>
                        <th style="text-align: center" scope="col">Created at</th>
                        <th style="text-align: center" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($services as $service)
                    <tr>
                    <td style="text-align: center"> {{ $service->id}}</td>
                    <td  style="text-align: center">$ {{number_format($service->total,2)}}</td>
                    <td style="text-align: center" >$ {{number_format($service->final_balance,2)}}</td>
                    <td style="text-align: center" >{{ \Carbon\Carbon::parse($service->created_at)->format('m/d/yy h:i A')}}</td>
                    <td style="text-align: center;" scope="col">
                      <a type="button" href="" class="btn btn-primary"><i class="fas fa-copy"></i></a>
                      <a type="button" href="" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                      <button type="button" class="btn btn-warning"><i class="fas fa-print"></i></button>  
                      <a type="button" href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>

                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection