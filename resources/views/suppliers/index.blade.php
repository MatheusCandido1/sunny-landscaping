@extends('layouts.partials')
@section('title', 'Costumers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Suppliers</h1>
<div class="card mb-4">
    <div class="card-header">All your suppliers are here!
      <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right btn-sm">
        New Supplier
    </button>
  </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Name</th>
                        <th style="text-align: center" scope="col">Unit price</th>
                        <th style="text-align: center; width: 10%" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($suppliers as $supplier)
                    <tr>
                        <td >{{ $supplier->name}}</td>
                        <td style="text-align: center;" >${{ number_format($supplier->value,2)}}</td>
                        <td style="text-align: right;" scope="col">
                          <button class="btn btn-success"><i class="fas fa-pencil-alt"></i></button>
                          <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this supplier?')) { document.getElementById('destroy-form-{{$supplier->id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                <form id="destroy-form-{{$supplier->id}}" action="{{ route('suppliers.destroy',$supplier->id) }}" method="POST" style="display: none;">
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method="POST" class="form-horizontal style-form" action="{{ route('visits.store') }}" > 
          @csrf
        <div class="form-row">
          <div class="col-md-6">
            <div class="form-group">
                <label class="" for="inputFirstName">Name</label>
                <input name="name" class="form-control py-4" type="text" placeholder="" />
            </div>
        </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="inputFirstName">Value</label>
                    <input name="value" class="form-control py-4" type="number" placeholder="" />
                  </div>
            </div>
        </div>
      
      <button type="submit" class="btn btn-primary btn-block">Save</button>   
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection