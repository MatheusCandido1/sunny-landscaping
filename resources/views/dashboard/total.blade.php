@extends('layouts.partials')
@section('content')
<style>
    td { text-align: center; }
</style>
<div class="container-fluid">
  <br>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        
        <label class="" for="inputLastName">Status</label>
        <select name="filter_status" id="filter_status" class="form-control" required>
            <option value="">Select Status</option>
            <option value="0">Not Approved</option>
            <option value="1">Approved</option>
            <option value="3">Waiting</option>
            <option value="4">Selected</option>
        </select>
    </div>

    </div>
    <div class="col-md-3">
      <label class="" for="inputLastName">Start Date</label>
        <div class="form-group">
            <input type="date" name="start_date" id="start_date" class="form-control"/>
        </div>
        
    </div>
    <div class="col-md-3">
      
      <label class="" for="inputLastName">End Date</label>
      <div class="form-group">
          <input type="date" name="end_date" id="end_date" class="form-control"/>
      </div>
      
  </div>
  <div class="col-md-3">
      
    <div class="form-group">
      <label class="" for="inputLastName">&nbsp;</label>
    <button type="button" name="filter" id="filter" class="btn btn-primary btn-block">Filter</button>
    </div>
</div>
  </div>
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="total_data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th style="text-align: center" scope="col">Quantity</th>
                        <th style="text-align: center" scope="col">Total</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
  fill_datatable();
  function fill_datatable(filter_status = '', start_date = '', end_date = '')
  {
      var dataTable = $('#total_data').DataTable({
          processing: true,
          serverSide: true,
          ajax:{
              url: "{{ route('customsearch.total') }}",
              data:{filter_status:filter_status, start_date:start_date, end_date:end_date}
          },
          columns: [
              {
                  data:'quantity'
              },
              {
                  data:'total'
              }
          ]
      });
  }
  $('#filter').click(function(){
      var filter_status = $('#filter_status').val();
      if(filter_status != '')
      {
          $('#total_data').DataTable().destroy();
          fill_datatable(filter_status);
      }
      else
      {
          alert('Select at least one filter option');
      }
  });
  
  });
  </script>
@endsection
@endsection