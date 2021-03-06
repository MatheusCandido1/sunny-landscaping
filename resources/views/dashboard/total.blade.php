@extends('layouts.partials')
@section('content')
<style>
    td { text-align: center; }
</style>
<script>
 
  </script>
<div class="container-fluid">
  <br>
  <div class="row">
      <div class="col-12">
    <div class="row input-daterange">
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="start_date">Start Date</label>
            <input type="text" name="start_date" id="start_date" class="form-control" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="last_date">End Date</label>
            <input type="text" name="end_date" id="end_date" class="form-control" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="" for="inputLastName">Status</label>
                <select name="filter_status" id="filter_status" class="form-control" required>
                    <option value="">Select Status</option>
                    <option {{$status ==  1 ? 'selected':''}} value="1" >Approved</option>
                    <option value="2">Not Approved</option>
                    <option value="3">Waiting</option>
                    <option {{$status ==  4 ? 'selected':''}} value="4">Sent Proposal</option>
                </select>           
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
      from = $( '#start_date' )
        .datepicker({
          format: "yyyy-mm-dd"
        });
      to = $( "#end_date" ).datepicker({
        format: 'yyyy-mm-dd'
      });



 load_data();

 

 function convertDate(date) {
  var yyyy = date.getFullYear().toString();
  var mm = (date.getMonth()+1).toString();
  var dd  = date.getDate().toString();

  var mmChars = mm.split('');
  var ddChars = dd.split('');

  return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
}

 function load_data(start_date = '', end_date = '', filter_status = '')
 {
  $('#total_data').DataTable({
   processing: true,
   serverSide: true,
   ajax: {
    url:'{{ route("customsearch.total") }}',
    data:{start_date:start_date, end_date:end_date, filter_status:filter_status}
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
  var filter_status = $('#filter_status').val();

  if(start_date != '' &&  end_date != '')
  {
   $('#total_data').DataTable().destroy();
   load_data(start_date, end_date, filter_status);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 window.onload = function() {
    $('#total_data').DataTable().destroy();

    var date = new Date(), y = date.getFullYear(), m = date.getMonth();
    var firstDay = new Date(y, m, 1);
    var lastDay = new Date(y, m + 1, 0);

    firstDay = convertDate(firstDay);
    lastDay = convertDate(lastDay);
  $('#start_date').val(firstDay);

    $('#end_date').val(lastDay);
  var status_val = {!! $status !!}
    load_data(firstDay, lastDay, status_val);
  };

});
  </script>
@endsection
@endsection