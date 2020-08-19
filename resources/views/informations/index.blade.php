@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Company Informations</h1>
<div class="card mb-4">
    <div class="card-header">All company's informations are here!
      
  </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Address</th>
                        <th style="text-align: center" scope="col" >Address</th>
                        <th style="text-align: center" scope="col" >Phone </th>
                        <th style="text-align: center" scope="col" >Phone (2) </th>
                        <th style="text-align: center; width: 15%" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="text-align: center" >{{ $info->address}}</td>
                        <td style="text-align: center" >{{ $info->address2}}</td>
                        <td style="text-align: center" >{{ $info->phone1}}</td>
                        <td style="text-align: center" >{{ $info->phone2}}</td>
                        <td style="text-align: right;" scope="col">
                          <a href="{{route('informations.edit', $info->id)}}" class="btn btn-primary btn-block"><i class="fas fa-pencil-alt"></i></a>
                          
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


@endsection