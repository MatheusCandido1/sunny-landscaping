@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Quotes</h1>
<div class="card mb-4">
    <div class="card-header">All your quotes are here!
      <a type="button" href="{{ route('services.createQuote', $visit_id) }}" class="btn btn-primary float-right btn-sm">
        New Quote
    </a>
  </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Quote #</th>
                        <th style="text-align: center" scope="col">Total</th>
                        <th style="text-align: center" scope="col">Created at</th>
                        <th style="text-align: center" scope="col">Proposal</th>
                        <th style="text-align: center" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($services->orderBy('created_at') as $service)
                    <tr>
                    <td style="text-align: center"> #{{$service->id}}</td>
                    <td  style="text-align: center">$ {{number_format($service->total,2)}}</td>
                    <td style="text-align: center" >{{ \Carbon\Carbon::parse($service->created_at)->format('m/d/yy h:i A')}}</td>
                    <td style="text-align: center;" scope="col"> <a target="_blank" href="{{ route('pdf.proposal', $service->id)}}" type="button" class="btn btn-success  btn-block"><i class="fas fa-print"></i> Proposal</a>
                    </td>
                    <td style="text-align: center;" scope="col">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-print"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a target="_blank" href="{{ route ('pdf.quote', ['visit'=>$visit_id, 'service'=>$service->id, 'type'=> 1])}}" class="dropdown-item">Portrait</a>
            
                                <a target="_blank" href="{{ route ('pdf.quote', ['visit'=>$visit_id, 'service'=>$service->id, 'type'=> 0])}}" class="dropdown-item">Landscape</a>
                            </div>
                          </div>
                      <a type="button" href="{{route('services.duplicateQuote', ['service'=> $service->id])}}" class="btn btn-primary"><i class="fas fa-copy"></i></a>
                      <a  href="{{route('services.editQuote', ['visit'=>$visit_id, 'service'=> $service->id])}}" type="button" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>  
                      
                      <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this quote?')) { document.getElementById('destroy-form-{{$service->id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                <form id="destroy-form-{{$service->id}}" action="{{ route('services.destroy',$service->id) }}" method="POST" style="display: none;">
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
@endsection