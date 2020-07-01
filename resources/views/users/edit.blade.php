@extends('layouts.partials')
@section('title', 'Referrals')
@section('content')
        <div class="container-fluid">
            <h1 class="mt-4">Edit User</h1>
<div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-users"></i> Users</div>
        <div class="card-body">
            <form  method="POST" class="form-horizontal style-form" action="{{ route('users.update', $user->id) }}" > 
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label class="" for="inputFirstName">Name</label>
                          <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>
        
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
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>
        
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
        <button type="submit" class="btn btn-primary btn-block">Save changes</button>   
      </form>
        </div>
    </div>
    </div>
    </div>
</div>
@endsection