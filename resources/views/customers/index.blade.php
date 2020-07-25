@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Customers</h1>
<br>{{ Breadcrumbs::render('customers') }}

<div class="card mb-4">
    <div class="card-header">All your customers are here!
      <a href="{{ route('customers.create') }}" class="btn btn-primary float-right btn-sm">
        New Customer
    </a>
  </div>
    <div class="card-body">
        <div class="table-responsive">
           
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Name</th>
                        <th style="text-align: center" scope="col">Phone</th>
                        <th style="text-align: center" scope="col">Address</th>
                        <th style="text-align: center" scope="col">Status</th>
                        <th style="text-align: center" scope="col">Projects</th>
                        <th style="text-align: center" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($customers as $customer)
                    <tr>
                        <td >{{$customer->customer_name}}</td>
                        <td >{{$customer->phone}}</td>
                        <td >{{$customer->address}}</td>
                    <td ><a href=""  class="btn btn-{{$statusArray[$customer->status_id]}} btn-sm btn-block rounded-pill" type="button" data-toggle="modal" data-target="#modalStatus{{$customer->customer_id}}">{{$customer->status_name}} </a></td>
                        <td style="text-align: center;" scope="col">
                          <a type="button" href="{{ route('visits.visitsByCustomer',$customer->customer_id) }}" class="btn btn-primary btn-sm btn-block">Projects</a>
                        </td>
                        <td style="text-align: center;" scope="col">
                          <a href="{{route('customers.edit', $customer->customer_id)}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                          <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this quote?')) { document.getElementById('destroy-form-{{$customer->customer_id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                          <form id="destroy-form-{{$customer->customer_id}}" action="{{ route('customers.destroy',$customer->customer_id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                        </td>
                      <div class="modal fade" id="modalStatus{{$customer->customer_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                  <form  method="POST" class="form-horizontal style-form" action="{{ route('visits.updateStatusIndex',['visit'=>$customer->visit_id]) }}" > 
                                      @csrf     
                                      @method('PUT')
                                      <div class="form-row">
                                        <div class="col-md-12">
                                          <label class="" for="inputFirstName">Status:</label>
                                          <div class="input-group mb-3">
                                              <select class="form-control" name="status">
                                                  <option value="">Select...</option>
                                                  @foreach ($statuses->sortBy('id') as $status)
                                                <option {{$customer->status_id == $status->id ? 'selected':''}} value="{{$status->id}}">{{$status->name}}</option>
                                                  @endforeach
                                                </select>      
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection