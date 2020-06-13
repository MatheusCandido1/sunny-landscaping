@extends('layouts.partials')
@section('title', 'Costumers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Costumers</h1>
<div class="card mb-4">
    <div class="card-header">All your costumers are here!
      <a href="" class="btn btn-primary float-right btn-sm">
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
                        <th style="text-align: center" scope="col">Information</th>
                        <th style="text-align: center" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($costumers as $costumer)
                    <tr>
                        <td >{{ $costumer->name}}</td>
                        <td >{{ $costumer->phone}}</td>
                        <td >{{ $costumer->email}}</td>
                        <td style="text-align: center;" scope="col">
                          <button type="button"  class="btn btn-outline-primary btn-sm btn-block">Details</button>
                        </td>
                        <td style="text-align: center;" scope="col">
                          <button class="btn btn-success"><i class="fas fa-pencil-alt"></i></button>
                          <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
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