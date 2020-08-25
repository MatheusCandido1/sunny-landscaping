@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Quotes</h1>
<br>
{{ Breadcrumbs::render('services', $customer, $visit_id) }}
<div class="card mb-4">
    <div class="card-header">All {{$customer_name}}'s quotes are here!
      <a type="button" href="{{ route('services.createQuote', ['visit' => $visit_id, 'customer' => $customer]) }}" class="btn btn-primary float-right btn-sm">
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
                        <th style="text-align: center" scope="col">Actions</th>
                        <th style="text-align: center" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($services as $service)
                    <tr>
                    <td style="text-align: center"> #{{$service->quote_key}}</td>
                    <td  style="text-align: center">$ {{number_format($service->total,2)}}</td>
                    <td style="text-align: center" >{{ \Carbon\Carbon::parse($service->created_at)->format('m/d/yy h:i A')}}</td>
                    
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
                      <a  href="{{route('services.editQuote', ['visit'=>$visit_id, 'service'=> $service->id, 'customer' => $customer])}}" type="button" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>  
                      
                      <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this quote?')) { document.getElementById('destroy-form-{{$service->id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                <form id="destroy-form-{{$service->id}}" action="{{ route('services.destroy',$service->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

                    </td>
                    <td style="text-align: center">
                        @if($service->status == 3)
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Waiting
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to approve this quote?')) { document.getElementById('update-form-{{$service->id}}').submit(); }" >Approved</a>
                              <form id="update-form-{{$service->id}}" action="{{ route('services.approve',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to disapprove this quote?')) { document.getElementById('update-form-{{$service->id+200}}').submit(); }" >Not Approved</a>
                            <form id="update-form-{{$service->id+200}}" action="{{ route('services.disapprove',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to select this quote?')) { document.getElementById('update-form-{{$service->id+300}}').submit(); }" >Send Proposal</a>
                            <form id="update-form-{{$service->id+300}}" action="{{ route('services.select',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          </div>  
                        </div>                     
                        @elseif ($service->status == 1)
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Approved
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to put this quote on waiting?')) { document.getElementById('update-form-{{$service->id}}').submit(); }" >Waiting</a>
                              <form id="update-form-{{$service->id}}" action="{{ route('services.waiting',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to disapprove this quote?')) { document.getElementById('update-form-{{$service->id+400}}').submit(); }" >Not Approved</a>
                            <form id="update-form-{{$service->id+400}}" action="{{ route('services.disapprove',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to select this quote?')) { document.getElementById('update-form-{{$service->id+500}}').submit(); }" >Send Proposal</a>
                            <form id="update-form-{{$service->id+500}}" action="{{ route('services.select',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          </div> 
                        </div>
                        @elseif($service->status == 2)
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Not Approved
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to put this quote on waiting?')) { document.getElementById('update-form-{{$service->id}}').submit(); }" >Waiting</a>
                              <form id="update-form-{{$service->id}}" action="{{ route('services.waiting',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to approve this quote?')) { document.getElementById('update-form-{{$service->id+600}}').submit(); }" >Approved</a>
                            <form id="update-form-{{$service->id+600}}" action="{{ route('services.approve',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to select this quote?')) { document.getElementById('update-form-{{$service->id+700}}').submit(); }" >Send Proposal</a>
                            <form id="update-form-{{$service->id+700}}" action="{{ route('services.select',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          </div> 
                        </div>
                        @elseif($service->status == 4)
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sent Proposal
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to put this quote on waiting?')) { document.getElementById('update-form-{{$service->id}}').submit(); }" >Waiting</a>
                              <form id="update-form-{{$service->id}}" action="{{ route('services.waiting',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                            </form>
                            <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to approve this quote?')) { document.getElementById('update-form-{{$service->id+800}}').submit(); }" >Approved</a>
                            <form id="update-form-{{$service->id+800}}" action="{{ route('services.approve',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          <a class="dropdown-item" href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to disapprove this quote?')) { document.getElementById('update-form-{{$service->id+900}}').submit(); }" >Not Approved</a>
                            <form id="update-form-{{$service->id+900}}" action="{{ route('services.disapprove',['service'=>$service->id, 'visit'=>$visit_id]) }}" method="POST" style="display: none;">
                              @csrf
                              @method('PUT')
                          </form>
                          </div> 
                        </div>
                        @endif
                    </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@section('script')
<script type="text/javascript">
 $('#dataTable').DataTable({
    "order": [[ 0, "desc" ]] 
});
</script>
@endsection

@endsection