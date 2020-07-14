@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
<style>
    .btn-group.special {
  display: flex;
}

.special .btn {
  flex: 1
}
ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 20px;
}
ul.timeline > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #5cb85c;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}
.scroll {
    max-height: 250px;
    overflow-y: scroll;
}
</style>
        <div class="container-fluid">
            <h1 class="mt-4">Details</h1>

            <br>{{ Breadcrumbs::render('details', $data->customer_id, $data->visit_id ) }}

            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-compass"></i> Project Status: {{$data->status_name}} </div>
                        <div class="card-body">
                <div class="btn-toolbar" role="toolbar">
                    <div class="btn-group mr-5" role="group">
                        @foreach($statuses->slice(0,5) as $status)
                    <a href="" type="button" class="btn btn-{{$data->visits_status == $status->id ? 'success':'secondary'}}" onclick="event.preventDefault(); if(confirm('Are you sure you want to update the status?')) { document.getElementById('update-form-{{$status->id}}').submit(); }">{{$status->name}}</a>
                    <form id="update-form-{{$status->id}}" action="{{ route('visits.updateStatus',['visit'=>$data->visit_id, 'status'=>$status->id]) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                    </form>
                    @endforeach
                    </div>
                        
                    <div class="btn-group " role="group">
                        <a href="" type="button" class="btn btn-{{$data->visits_status == 6 ? 'danger':'link'}}" onclick="event.preventDefault(); if(confirm('Are you sure you want to update the status?')) { document.getElementById('update-form-x').submit(); }">Project Declined</a>
                        <form id="update-form-x" action="{{ route('visits.updateStatus',['visit'=>$data->visit_id, 'status'=>6]) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                        </form>
                    </div>
                </div>
                </div>
                    </div>
                </div>
             </div>
             <br>
  <div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-portrait"></i> Customer Information</div>
            <div class="card-body">
                <div class="row">
                <div class="col-12 col-lg-8 col-md-6">
                    <h3 class="mb-0 text-truncated">{{$data->customer_name}}</h3>
                    <p class="lead"> <i class="fas fa-envelope-square"></i> E-mail: {{$data->email}}</p>
                    <p class="lead"> <i class="fas fa-phone-square"></i> Phone: {{$data->phone}} (Cellphone: {{ $data->cellphone == 0 ? 'No' : 'Yes'}})</p>
                <p class="lead"> <i class="fas fa-map-marked-alt"></i> Address: {{$data->address}}, {{$data->city_name}}, {{$data->state}} - {{$data->zipcode}}</p>
                <p class="lead"> <i class="fas fa-warehouse"></i> Gate code: <span class="badge badge-secondary">{{$data->gate_code}}</span></p>
                <p class="lead"> <i class="fas fa-road"></i> Cross Streets: {{$data->cross_street1}}/{{$data->cross_street2}}</p>
                <p class="lead"> <i class="fas fa-globe"></i> Referred: {{$data->ref_name}}</p>
                </div>
                <!--/col-->
            </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-home"></i> Visit and Quotes

            </div>
            
            <div class="card-body">
                <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <p class="lead"><i class="fas fa-calendar"></i> Date: {{ \Carbon\Carbon::parse($data->date)->format('l, jS \\of F Y h:i:s A')}}</p>
                    <p class="lead"> <i class="fas fa-phone-square"></i> Call customer in : {{$data->call_customer_in}} minutes</p>
                    <p class="lead"> <i class="fas fa-mobile-alt"></i> HOA: {{ $data->hoa == 0 ? 'No' : 'Yes'}}</p>
                <p class="lead"> <i class="fas fa-map-marked-alt"></i> Water Smart Rebate: {{$data->water_smart_rebate == 0 ? 'No' : 'Yes'}}                 
                    </p>
                </div>
                <!--/col-->
            </div>
            <div class="btn-group special" role="group" aria-label="Basic example">
                <a href="{{ route('services.servicesByVisit',['visit' => $data->visit_id, 'customer' => $data->customer_id])}}" type="button" class="btn btn-success"><i class="fas fa-list-ul"></i> Manage Quotes</a>                
              </div> 
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header"><i class="fas fa-file-alt"></i> Files and Documents</div>
            <div class="card-body">
                    <div class="container">
                      <h1 class="display-4">Print the documents!</h1>
                      <p class="lead">Click in any button and a PDF will be displayed.</p>
                      <p class="lead">
                          <div class="row">
                            <div class="col-lg-4 text-center">
                                @if($allow == null)
                                <button  type="button" href="" class="btn btn-danger btn-block" disabled><i class="fas fa-print"></i> Estimate Request</button>  
                                @else
                                <a target="_blank" type="button" href="{{route('pdf.estimate', $data->visit_id)}}" class="btn btn-success btn-block"><i class="fas fa-print"></i> Estimate Request</a>  
                                @endif
                            </div>
                            <div class="col-lg-4 text-center">
                           
                            <a target="_blank" type="button" href="{{route('pdf.front', $data->visit_id)}}" class="btn btn-success btn-block"><i class="fas fa-print"></i> Project Front Page</a> 
                            </div>

                            <div class="col-lg-4 text-center">
                                @if($allow == null)
                                <button type="button"  href="" class="btn btn-danger btn-block" disabled><i class="fas fa-print"></i> Proposal</button>    
                                @else
                                <a target="_blank" type="button"  href="{{route('pdf.full', $data->visit_id)}}" class="btn btn-success btn-block"><i class="fas fa-print"></i> Proposal</a>    
                                @endif
                             </div>

                        
                       
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-lg-3 text-center">
                            @if($allow == null)
                            <button type="button"  href="" class="btn btn-danger btn-block" disabled><i class="fas fa-print"></i> Sunny Contract</button>  
                            @else
                            <a target="_blank" type="button"  href="{{route('pdf.nevadacontract', $data->visit_id)}}" class="btn btn-success btn-block"><i class="fas fa-print"></i> Sunny Contract</a>  
                            @endif
                            </div>
                        <div class="col-lg-3 text-center">
                            @if($allow == null)
                            <button target="_blank" type="button" href="" class="btn btn-danger btn-block" disabled><i class="fas fa-print"></i> Contractor's Board</button>  
                            @else 
                            <a target="_blank" type="button" href="{{route('pdf.contract', $data->visit_id)}}" class="btn btn-success btn-block"><i class="fas fa-print"></i> Contractor's Board</a>  
                            @endif
                        </div>
                        <div class="col-lg-3 text-center">
                            @if($allow == null)
                            <button type="button" href="" class="btn btn-danger btn-block" disabled><i class="fas fa-print"></i> Change Order</button>
                            @else 
                            <a type="button" href="{{route('changeorders.changes', ['visit' => $data->visit_id, 'customer' => $data->customer_id])}}" class="btn btn-success btn-block"><i class="fas fa-print"></i> Change Order</a>
                            @endif
                        </div>
                        <div class="col-lg-3 text-center">
                            @if($allow == null)
                            <button type="button"  href="" class="btn btn-danger btn-block" disabled><i class="fas fa-print"></i>Waiver Release</button>    
                            @else
                            <a target="_blank" type="button"  href="{{route('pdf.waiver', $data->visit_id)}}" class="btn btn-success btn-block"><i class="fas fa-print"></i> Waiver Release</a>    
                            @endif
                         </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a type="button" href=""  data-toggle="modal" data-target="#exampleModal" class="btn btn-info btn-block"><i class="fas fa-info-circle"></i> Informations </a>  
                        </div>
                    </div>
                      </p>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card mb-4 ">
            <div class="card-header"><i class="fas fa-sticky-note"></i> Notes</div>
            <div class="card-body">
                    <div class="container">
                        <div>
                            <ul class="timeline scroll">
                                @foreach($notes as $note)
                                <li>
                                    <a style="color: #5cb85c" href="">Note #{{$loop->iteration}}</a>
                                <a style="color: #5cb85c" href="" class="float-right">{{ \Carbon\Carbon::parse($note->created_at)->format(' m/d/Y h:i:s')}}</a>

                                    <p>{{$note->note}}</p>
                                    <div class="text-right">
                                        <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this note?')) { document.getElementById('destroy-form-{{$note->id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                        <form id="destroy-form-{{$note->id}}" action="{{ route('notes.destroy',$note->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>                                    
                                    </div>
                                </li>
                                <hr>
                                @endforeach
                            </ul>
                            <form  method="POST" class="form-horizontal style-form" action="{{ route('notes.store') }}" >
                                @csrf 
                            <div class="input-group">
                                <input type="hidden" value="{{$data->visit_id}}" name="visit_id">
                                <textarea required class="form-control" name="note" rows="3" style="resize:none"></textarea>     
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane" aria-hidden="true"></i></button>
                            </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Information for documents</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form  method="POST" class="form-horizontal style-form" action="{{ route('visits.updateInformation', $data->visit_id) }}" > 
                @csrf     
                @method('PUT')
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="" for="inputFirstName">Invoice Number</label>
                        <input name="invoice_number" class="form-control py-4" value="{{$data->invoice_number}}"  type="text" placeholder="" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="" for="inputLastName">Project's Name</label>
                            <input name="project_name" class="form-control py-4" type="text" value="{{$data->project_name}}" placeholder="" />
                        </div>
                    </div>
                </div>
                <div class="form-row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="" for="inputLastName">Sunny Contract's Date</label>
                        <input name="contract_date" class="form-control py-4" type="date" value="{{$data->contract_date}}" placeholder="" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="" for="inputLastName">Contractor's Board Date</label>
                        <input name="board_date" class="form-control py-4" type="date" value="{{$data->board_date}}" placeholder="" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="" for="inputLastName">Waiver's Release Date</label>
                        <input name="waiver_date" class="form-control py-4" type="date" value="{{$data->waiver_date}}" placeholder="" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="" for="inputLastName">Proposal's Date</label>
                        <input name="proposal_date" class="form-control py-4" type="date" value="{{$data->proposal_date}}" placeholder="" />
                    </div>
                </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save changes</button>   
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @section('script')
<script type="text/javascript">

</script>
@endsection
@endsection