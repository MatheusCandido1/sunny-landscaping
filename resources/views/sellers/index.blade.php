@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Sellers</h1>
<div class="card mb-4">
    <div class="card-header">All your sellers are here!
      <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right btn-sm">
        New Seller
    </button>
  </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Name</th>
                        <th style="text-align: center; width: 15%" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($sellers as $seller)
                    <tr>
                        <td style="text-align: center">{{ $seller->name}}</td>
                        <td style="text-align: right;" scope="col">
                          <a href="{{route('sellers.edit', $seller->id)}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                          <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this seller?')) { document.getElementById('destroy-form-{{$seller->id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                <form id="destroy-form-{{$seller->id}}" action="{{ route('sellers.destroy',$seller->id) }}" method="POST" style="display: none;">
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
        <h5 class="modal-title" id="exampleModalLabel">Add new Seller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  method="POST" class="form-horizontal style-form" action="{{ route('sellers.store') }}" > 
          @csrf
        <div class="form-row">
          <div class="col-md-12">
            <div class="form-group">
                <label class="" for="inputFirstName">Name</label>
                <input name="name" class="form-control" type="text" placeholder="" />
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