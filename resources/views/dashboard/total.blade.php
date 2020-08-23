@extends('layouts.partials')
@section('content')
<style>
    td { text-align: center; }
</style>
<div class="container-fluid">
  <br>
  <div class="row">
      <div class="col-12">
    <div class="row input-daterange">
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="inputLastName">Start Date</label>
            <input type="text" name="start_date" id="start_date" class="form-control" placeholder="" readonly />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="inputLastName">End Date</label>
            <input type="text" name="end_date" id="end_date" class="form-control" placeholder="" readonly />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="inputLastName">&nbsp;</label>
            <button type="button" name="filter" id="filter" class="btn btn-primary btn-block">Filter</button>    
        </div>
        </div>
    </div>
      </div>
  </div>

      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="total_data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col">Status</th>
                      <th style="text-align: center" scope="col">Quantity</th>
                        <th style="text-align: center" scope="col">Total</th>
                        <th style="text-align: center" scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@section('script')
<script type="text/javascript">
 $(document).ready(function(){
 $('.input-daterange').datepicker({
  todayBtn:'linked',
  format:'yyyy-mm-dd',
  autoclose:true
 });

 load_data();

 function load_data(start_date = '', end_date = '')
 {
  $('#total_data').DataTable({
   processing: true,
   serverSide: true,
   ajax: {
    url:'{{ route("customsearch.total") }}',
    data:{start_date:start_date, end_date:end_date}
   },
   columns: [
    {
     data:'status'
    },
    {
     data:'quantity'
    },
    {
     data:'total'
    },
    {
     data: 'action',
     name: 'action',
     orderable: false
    }

   ]
  });
 }

 $('#filter').click(function(){
  var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  if(start_date != '' &&  end_date != '')
  {
   $('#total_data').DataTable().destroy();
   load_data(start_date, end_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#start_date').val('');
  $('#end_date').val('');
  $('#total_data').DataTable().destroy();
  load_data();
 });

});
  </script>
@endsection
@endsection