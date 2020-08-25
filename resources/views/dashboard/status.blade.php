@extends('layouts.partials')
@section('content')
<style>
    td { text-align: center; }
</style>
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="mt-4" id="monthName"></h1>
        </div>
        <div class="col-md-6">
        <a type="button" href="{{ route('dashboard.total' )}}" class="btn btn-outline-success float-right "><i class="fas fa-calendar-check"></i> Use date range filters</a>
        </div>
    </div>

  <br>
  
      <div class="card-body">
        <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                
                <label class="" for="inputLastName">Status</label>
                <select name="filter_status" id="filter_status" class="form-control" required>
                    <option value="">Select Status</option>
                    <option value="1">Approved</option>
                    <option value="2">Not Approved</option>
                    <option value="3">Waiting</option>
                    <option value="4">Sent Proposal</option>
                </select>
            </div>
        
            </div>
          <div class="col-md-3">
              
            <div class="form-group">
              <label class="" for="inputLastName">&nbsp;</label>
            <button type="button" name="filter" id="filter" class="btn btn-primary btn-block float-">Filter</button>
            </div>
        </div>
          </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="status_data" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th style="text-align: center" scope="col">Quote</th>
                        <th style="text-align: center" scope="col">Customer</th>
                        <th style="text-align: center" scope="col">Date</th>
                        <th style="text-align: center" scope="col">Total</th>
                        <th style="text-align: center" width="20%">action</th>
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

function fill_datatable(filter_status = '')
{
    var dataTable = $('#status_data').DataTable({
        
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{ route('customsearch.index') }}",
            data:{filter_status:filter_status}
        },
        columns: [
            {
                data:'service_id'
            },
            {
                data:'customer_name'
            },
            {
                data:'visit_date'
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

window.onload = function() {
    $('#status_data').DataTable().destroy();

    fill_datatable(1); 

    const today = new Date()
    const month = today.toLocaleString('En', { month: 'long' })
    document.getElementById('monthName').innerHTML = 'Current Month: ' + month;
  };

});
</script>
@endsection
@endsection