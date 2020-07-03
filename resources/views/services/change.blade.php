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
  <h1 class="mt-4">Change Order</h1>

  <div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-pencil-alt"></i> Changer Order
      <button type="button" class="btn btn-primary float-right btn-sm">
        <i class="fas fa-plus"></i> New Item
        </button>
    </div>
    
    
    <div class="card-body">
      <table id="tb" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="text-align: center" scope="col" >Action</th>
            <th style="text-align: center" scope="col" >Value</th>
            <th style="text-align: center" scope="col" >Item</th>
            <th style="text-align: center" scope="col" >Unit Price</th>
            <th style="text-align: center" scope="col" >Type</th>
            <th style="" scope="col" >Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
             <select class="form-control"> 
             <option value="">Select...</option> 
             <option value="">Add</option> 
             <option value="">Remove</option> 
             <option value="">Edit</option> 
            </select>
            </td>
            <td>
              <div class="input-group">
                  <input type="number" id=""  value="" name="" class="form-control" > 
            </td>
            <td>
            <input type="number" id=""  value=""  name="" class="form-control" > 
            </td>
            <td>
              <input type="text" id=""  value="" name="" class="form-control" > 
              </td>
              <td>
                <input type="number" id=""  value="" name="" class="form-control" > 
                </td>
                <td style="text-align: center;" scope="col">
                  <button onclick="" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                 </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<div class="table-responsive">
    <table class="table table-bordered"  width="100%" cellspacing="0">
      <tbody>
        <tr>
          <td >ORIGINAL CONTRACT AMOUNT</td>
          <td style="text-align: right"  scope="col" >
          <input type="number" required id="totalwithoutdiscount" name="" readonly value=""   class="form-control">
          </td>
        </tr>
        <tr>
          <td >CHANGE ORDER AMOUNT #1</td>
          <td style="text-align: right"  scope="col" >
          <input type="number" required id="totalwithoutdiscount" name="" readonly value=""  class="form-control">
          </td>
        </tr>
      </tbody>
    </table>
    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Save Change Order</button>

  </div>
</div>
</form>
<script type="text/javascript"></script>
@endsection