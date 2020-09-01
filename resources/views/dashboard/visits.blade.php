@extends('layouts.partials')
@section('content')
<style>
    td { text-align: center; }
</style>
<div class="container-fluid">
  <br>
  <div class="row">
    <div class="col-lg-12">
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
        <label class="" for="inputLastName">Status</label>
        <select name="filter_status" id="filter_status" class="form-control" required>
            <option value="">Select Status</option>
            @foreach ($status->sortBy('id') as $s)
          <option {{ $s->id == $id ? 'selected':''}} value="{{$s->id}}">{{$s->name}}</option>
            @endforeach
        </select>
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
            <table class="table table-bordered" id="status_data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col">Customer</th>
                        <th style="text-align: center" scope="col">Address</th>
                        <th style="text-align: center" width="20%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
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

fill_datatable();

function convertDate(date) {
  var yyyy = date.getFullYear().toString();
  var mm = (date.getMonth()+1).toString();
  var dd  = date.getDate().toString();

  var mmChars = mm.split('');
  var ddChars = dd.split('');

  return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
}


function fill_datatable(start_date = '', end_date = '', filter_status = '')
{
    var dataTable = $('#status_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{ route('customsearch.visits') }}",
            data:{start_date:start_date, end_date:end_date, filter_status:filter_status}
        },
        columns: [
            {
                data:'customer_name'
            },
            {
                data:'project_address'
            },
            {
                data: 'action',
                name: 'Action',
                orderable: false
            }
        ]
    });
}
$('#filter').click(function(){
    var start_date = $('#start_date').val();
  var end_date = $('#end_date').val();
  var filter_status = $('#filter_status').val();
    if(filter_status != '' && start_date != '' &&  end_date != '')
    {
        $('#status_data').DataTable().destroy();
        fill_datatable(start_date, end_date,filter_status);
    }
    else
    {
        alert('Select at least one filter option');
    }
});


window.onload = function() {
    $('#status_data').DataTable().destroy();

    var date = new Date(), y = date.getFullYear(), m = date.getMonth();
    var firstDay = new Date(y, m, 1);
    var lastDay = new Date(y, m + 1, 0);

    firstDay = convertDate(firstDay);
    lastDay = convertDate(lastDay);
    $('#start_date').val(firstDay);

    $('#end_date').val(lastDay);

    var status_id_value = {!! $id !!}

    fill_datatable(firstDay, lastDay, status_id_value);
  };

});
</script>
@endsection