@extends('layouts.partials')
@section('title', 'Quote')
@section('content')
<script>
  window.onload = function() {
  findTotal();
};
</script>
<form  method="POST" class="form-horizontal style-form" action="" >
  @csrf
  <div class="container-fluid">
  <h1 class="mt-4">Create Change Order</h1>

  <div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-list-ul"></i> Edit Quote
    </div>
    
    <div class="card-body">
  <div class="table-responsive">
    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Save Quote</button>
  </div>
</div>
</div>
</div>
</div>
</div>
</form>
<script type="text/javascript"></script>
@endsection