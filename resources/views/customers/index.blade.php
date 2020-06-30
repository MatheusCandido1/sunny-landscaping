@extends('layouts.partials')
@section('title', 'Costumers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Costumers</h1>
<div class="card mb-4">
    <div class="card-header">All your costumers are here!
      <a href="{{ route('customers.create') }}" class="btn btn-primary float-right btn-sm">
        New Costumer
    </a>
  </div>
    <div class="card-body">
        <div class="table-responsive">
           
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Name</th>
                        <th style="text-align: center" scope="col">Phone</th>
                        <th style="text-align: center" scope="col">Email</th>
                        <th style="text-align: center" scope="col">Projects</th>
                        <th style="text-align: center" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($customers as $customer)
                    <tr>
                        <td >{{ $customer->name}}</td>
                        <td >{{ $customer->phone}}</td>
                        <td >{{ $customer->email}}</td>
                        <td style="text-align: center;" scope="col">
                          <a type="button" href="{{ route('visits.visitsByCostumer',$customer->id) }}" class="btn btn-primary btn-sm btn-block">Projects</a>
                        </td>
                        <td style="text-align: center;" scope="col">
                          <a href="{{route('customers.edit', $customer->id)}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                          <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this quote?')) { document.getElementById('destroy-form-{{$customer->id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                          <form id="destroy-form-{{$customer->id}}" action="{{ route('customers.destroy',$customer->id) }}" method="POST" style="display: none;">
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