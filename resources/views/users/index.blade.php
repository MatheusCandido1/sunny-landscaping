@extends('layouts.partials')
@section('title', 'Customers')
@section('content')
<div class="container-fluid">
<h1 class="mt-4">Users</h1>
<div class="card mb-4">
    <div class="card-header">All users are here!
      <button data-toggle="modal" data-target="#exampleModal" class="btn btn-primary float-right btn-sm">
        New User
    </button>
  </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col" >Name</th>
                        <th style="text-align: center" scope="col" >E-mail</th>
                        <th style="text-align: center; width: 15%" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                    <tr>
                        <td style="text-align: center">{{ $user->name}}</td>
                        <td style="text-align: center">{{ $user->email}}</td>
                        <td style="text-align: center;" scope="col">
                          <a href="{{route('users.edit', $user->id)}}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                          <a href="" type="button" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('destroy-form-{{$user->id}}').submit(); }" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                <form id="destroy-form-{{$user->id}}" action="{{ route('users.destroy',$user->id) }}" method="POST" style="display: none;">
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
        <h5 class="modal-title" id="exampleModalLabel">Add user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('users.store') }}" aria-label="{{ __('Register') }}">
          @csrf
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                  <label class="" for="inputFirstName">Name</label>
                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputFirstName">E-mail</label>
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
                    </div>
              </div>
          </div>
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                  <label class="" for="inputFirstName">Password</label>
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                  @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label class="" for="inputFirstName">Confirm Password</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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