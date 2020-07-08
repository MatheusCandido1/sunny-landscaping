@extends('layouts.partials')
@section('title', 'Quote')
@section('content')
<form  method="POST" class="form-horizontal style-form" action="{{route('changeorders.store')}}" >
  @csrf
  <input type="hidden" readonly name="visit_id" value="{{$visit_id}}"/>
  <input type="hidden" readonly id="original" name="original_contract_amount" value="{{$amount[0]->total}}"/>
  <div class="container-fluid">
  <h1 class="mt-4">Change Order<a type="button" href=""  data-toggle="modal" data-target="#exampleModal" class="btn btn-success float-right btn-sm">
    See Quote(s) Details
  </a></h1>

  <div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-pencil-alt"></i> Changer Order
      <button onclick="add()" type="button" class="btn btn-primary float-right btn-sm">
        <i class="fas fa-plus"></i> New Item
        </button>
    </div>
    
    
    <div class="card-body">
      <table id="tb" class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th style="text-align: center" scope="col" >Action</th>
            <th style="text-align: center" scope="col" >Description</th>
            <th style="text-align: center" scope="col" >Quantity</th>
            <th style="text-align: center" scope="col" >Type</th>
            <th style="text-align: center" scope="col" >Unit Price</th>
            <th style="text-align: center" scope="col" >Investment</th>
            <th style="text-align: center" scope="col" >Options</th>
          </tr>
        </thead>
        <tbody id="item_rows">
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
          <td >Date</td>
          <td style="text-align: right"  scope="col" >
              <input type="date" name="date"  required   class="form-control">
            
          </td>
        </tr>
        <tr>
          <td >Total Without Discount</td>
          <td style="text-align: right"  scope="col" >
              <input type="text"  required   id="totalWithout"  readonly   class="form-control" placeholder="Total Without Discount">
            
          </td>
        </tr>
        <tr>
          <td >Discount</td>
          <td style="text-align: right"  scope="col" >
            <div class="input-group mb-3">
              <input type="text" value="0" name="discount" id="discount" class="form-control" placeholder="Discount">

              <div class="input-group-append">
                <button onclick="getDiscount()" class="btn btn-success" type="button">Get Discount</button>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td >Change Order Amount</td>
          <td style="text-align: right"  scope="col" >
              <input type="text"  required name="change_order_amount"   id="total"  readonly   class="form-control" placeholder="Total">
              <input type="hidden"  required name="revised_contract_amount"   id="revised">

            </td>
        </tr>

      </tbody>
    </table>
    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Save Change Order</button>

  </div>
</div>
</form>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approved Quotes Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @foreach($itemData as $group_type => $items)
        <h6 class="text-center">{{$group_type}} </h6>
        <table class="table" width="" class="table">
          <thead>
            <tr>
              <th style="text-align: left" scope="col" >Quote</th>
              @if($group_type == "1 - PAVERS" || $group_type == "2 - RETAINING WALL")
              <th style="text-align: left" scope="col" >Supplier</th>
              @endif
              <th style="text-align: left" scope="col" >Description</th>
              <th style="" scope="col" >Quantity</th>
              <th style="" scope="col" >Unit Price</th>
              <th style="text-align: right" scope="col" >Investment</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
            <tr>
              <td>#{{$item->service_id}}</td>
              @if($item->group_type == "1 - PAVERS" || $item->group_type == "2 - RETAINING WALL")
              <td>{{$item->supplier}}</td>
              @endif
              <td>{{$item->description}} </td>
              <td>{{$item->quantity}} {{$item->type}} </td>
              <td>$ {{number_format($item->unit_price,2)}} </td>
              <td style="text-align: right">$ {{number_format($item->investment,2)}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endforeach
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
<script type="text/javascript">
  var item = 0;

  function add(){
    item++;
      var objTo = document.getElementById('item_rows')
      var divtest = document.createElement("tr");
      divtest.innerHTML ='<td style="width: 15%"> <select onchange="findTotal()" name="target" id="'+item+'target" class="form-control"> <option value="add">Add</option> <option value="rm">Remove</option> <option value="mv">Edit</option> </select> </td> <td> <div class="input-group"> <input type="text" id="" value="" name="description[]" placeholder="Description" class="form-control" > </td> <td> <input type="number" id="'+item+'quantity" value="0" onchange="findTotal()" name="quantity[]" placeholder="Quantity" class="form-control" > </td> <td> <input type="text" id="type" value="" name="type[]" placeholder="Type" class="form-control" > </td> <td> <input type="number" id="'+item+'unit_price" value="0" onchange="findTotal()" name="unit_price[]" placeholder="Unit Price" class="form-control" > </td> <td> <input type="text" id="'+item+'investment" readonly value="" name="investment[]" placeholder="Investment" class="form-control" > </td> <td style="text-align: center;" scope="col"> <button onclick="deleteItem(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button> </td>';
      objTo.appendChild(divtest)  
  }

  function deleteItem(button){
    var empTab = document.getElementById('tb');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
    getNewTotal();
  }

  function findTotal(){
    for(i = 1; i <= item; i++){
      if((document.getElementById(i+"unit_price") != null) && (document.getElementById(i+"quantity") != null)){
    var value = document.getElementById(i+"unit_price").value;
    var qnt = document.getElementById(i+"quantity").value;
    var investment = parseFloat(value) * parseFloat(qnt);
    if(document.getElementById(i+"target").value == "rm")
    investment = (investment * (-1))
    document.getElementById(i+"investment").value = investment.toFixed(2);
      }
    }
    getNewTotal();

  }

  function getDiscount(){
    var new_total = (document.getElementById('totalWithout').value) - (document.getElementById('discount').value);
    document.getElementById('total').value = new_total.toFixed(2);
    getRevised();
    
  }

  function getRevised(){
    var revised =  ((document.getElementById('original').value) - (document.getElementById('total').value));
    document.getElementById('revised').value = revised.toFixed(2)
  }


  function getNewTotal(){
    total = 0;
    for(i = 1; i <= item;i++){
        if((document.getElementById(i+"unit_price") != null) || (document.getElementById(i+"quantity") != null )){
        total += Number(document.getElementById(i+"investment").value);
        }
      }
      document.getElementById('totalWithout').value = total.toFixed(2);
  }
</script>
@endsection