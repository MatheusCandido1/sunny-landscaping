@extends('layouts.partials')
@section('content')
<style>
    td { text-align: center; }
</style>
<div class="container-fluid">
  <br>
  <div class="row">
    <div class="col-md-9">
      <div class="form-group">
        
        <label class="" for="inputLastName">Status</label>
        <select name="filter_status" id="filter_status" class="form-control" required>
            <option value="">Select Status</option>
            @foreach ($status->sortBy('id') as $s)
          <option value="{{$s->id}}">{{$s->name}}</option>
            @endforeach
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
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="status_data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="text-align: center" scope="col">Customer</th>
                        <th style="text-align: center" scope="col">Visits's Date</th>
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
fill_datatable();
function fill_datatable(filter_status = '')
{
    var dataTable = $('#status_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{ route('customsearch.visits') }}",
            data:{filter_status:filter_status}
        },
        columns: [
            {
                data:'customer_name'
            },
            {
                data:'visit_date'
            }
        ]
    });
}
$('#filter').click(function(){
    var filter_status = $('#filter_status').val();
    if(filter_status != '')
    {
        $('#status_data').DataTable().destroy();
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