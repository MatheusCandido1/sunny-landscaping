@extends('layouts.partials')
@section('title', 'Quote')
@section('content')
<script>
  window.onload = function() {
  findTotal();
};
</script>
<form  method="POST" class="form-horizontal style-form" action="{{ route('quotes.update',$service->id) }}" >
  @csrf
  @method('PUT')

  <input type="hidden" name="visit_id" value="{{$visit_id}}"/>
  <div class="container-fluid">
  <h1 class="mt-4">Update Quote</h1>

  <div class="card">
    <div class="card-header">
      <a class="card-link" data-toggle="collapse" >
      Items
      </a>
      <button type="button" onclick="add()" class="btn btn-primary float-right btn-sm">
        <i class="fas fa-plus"></i> New Item
        </button>

    </div>
      <div class="card-body">
        <table disabled id="tb13" class="table table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th style="" scope="col" >Supplier</th>
              <th style="" scope="col" >Description</th>
              <th style="" scope="col" >Quantity</th>
              <th style="" scope="col" >Type</th>
              <th style="" scope="col" >Unit Price</th>
              <th style="" scope="col" >Investment</th>
              <th style="" scope="col" >Action</th>
            </tr>
          </thead>
          <tbody  id="item_fields13">
            @foreach($items as $item) 
            <tr>
              <td>
              <input type="text" value="{{$item->supplier}}" placeholder="Supplier" class="form-control" name="supplier[]" >
              </td>
               <td> 
                 <div class="input-group mb-3"> 
                   <div class="input-group-prepend"> 
                    <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                     <input type="hidden" name="id[]" value="{{$item->id}}"> 
                     <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                     </td> 
                     <td> 
                       <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
                        <div id="{{$loop->iteration}}qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> 
                      </td>
                       <td> 
                         <input type="text" value="{{$item->type}}" required name="type[]" placeholder="" class="form-control">
                         </td>
                          <td> 
                            <div class="input-group mb-3">
                               <div class="input-group-prepend">
                                  <span class="input-group-text">$</span>
                                 </div> 
                                 <input type="text" id="{{$loop->iteration}}value"  value="{{number_format($item->unit_price,2)}}" onchange="findTotal()" name="unit_price[]" class="form-control" placeholder="Unit cost"> </div>
                                 </td> 
                                 <td> 
                                   <input type="text" id="{{$loop->iteration}}total" readonly name="investment[]" value="{{number_format($item->investment,2)}}" class="form-control items" placeholder="Investment">
                                   </td>
                                   <td style="text-align: center;" scope="col">
                                   <button onclick="deleteAndRefresh(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                  </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
    </div>
  <br>
  
  <div class="table-responsive">
    <table class="table table-bordered"  width="100%" cellspacing="0">
      <tbody>
        <tr>
          <td >Discount</td>
          <td >
            <div class="input-group mb-3">
            <input name="discount" type="text" class="form-control" id="discount"  value="" placeholder="Discount" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button onclick="Discount()" class="btn btn-success" type="button">Get Discount</button>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td >Total</td>
          <td style="text-align: right"  scope="col" >
          <input type="text" required id="totalwithoutdiscount" name="total" readonly value="" placeholder="Total"   class="form-control">
          </td>
        </tr>
        <tr>
          <td >Accepting Proposal</td>
          <td style="text-align: right"  scope="col" >
            <div class="input-group mb-3">
            <input type="text" value="{{number_format($service->accepting_proposal,2)}}" required name="accepting_proposal" id="accepting_proposal"    class="form-control" placeholder="Accepting Proposal">
              <div class="input-group-append">
                <button onclick="PayDown()" class="btn btn-success" type="button">Get Payment Down</button>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td >Down Payment</td>
          <td >
            <input type="text" id="down_payment" required name="down_payment" value="" readonly class="form-control"  placeholder="Payment Down">
          </td>
        </tr>
        <tr>
          <td >Final Balance</td>
          <td>
            <div class="input-group mb-3">
              <input type="text" id="finalbalance" onkeypress="return false;" required name="final_balance" class="form-control" placeholder="The final balance will be displayed here" value="" >
              <div class="input-group-append">
                <button onclick="getFinalBalance()" class="btn btn-success" type="button">Get Final Balance</button>
              </div>
            </div>
          </td>
        </tr>
        <tr style="display: none">
          <td >Total Without Discount</td>
          <td style="text-align: right" scope="col" >
          <input type="text" value="" id="total"  class="form-control" placeholder="">
          </td>
        </tr>
      </tbody>
    </table>
    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Save Quote</button>

  </div>
</form>
<script type="text/javascript">
  var item = document.getElementById('loopsize').value;

 function getFinalBalance(){
    var final = document.getElementById('totalwithoutdiscount').value - document.getElementById('down_payment').value - document.getElementById('accepting_proposal').value;
    if(final < 0){
      final = final * (-1);
    }else{
      final = final * 1;
    }
    document.getElementById('finalbalance').value = final.toFixed(2);
  }
  
  function PayDown(){
    var pay = 0.30 * document.getElementById('totalwithoutdiscount').value;
    document.getElementById('down_payment').value = pay.toFixed(2);
  }
  function Discount(){
    var new_total = (document.getElementById('total').value) - (document.getElementById('discount').value);
    document.getElementById('totalwithoutdiscount').value = new_total.toFixed(2);
  }

  function deleteAndRefresh(button){
    deleteItem(button);
    findTotal();
  }

  function deleteItem(button){
    var empTab = document.getElementById('tb13');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function add() {
  item++;
      var objTo = document.getElementById('item_fields13')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<td> <input type="text" value="" placeholder="Supplier" class="form-control" name="supplier[]" > </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" onload="findTotal()" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" value="" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" id="'+item+'value" onload="findTotal()" value="0" onchange="findTotal()" name="unit_price[]" class="form-control" placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" value="" class="form-control items" placeholder="Investment"> </td> <td style="text-align: center;" scope="col"> <button onclick="deleteItem(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button> </td>';
      objTo.appendChild(divtest);
  }


  function findTotal(){
      for(i = 1; i <= item; i++){
        if((document.getElementById(i+"value") != null)|| (document.getElementById(i+"qnt") != null )){
          var x = document.getElementById(i+"qntval");
          if(document.getElementById(i+"qnt").value <= 300){
          x.style.display = "block";
        }else{
          x.style.display = "none";
        }
      var value = document.getElementById(i+"value").value;
      var qnt = document.getElementById(i+"qnt").value;
      var investment = parseFloat(value) * parseFloat(qnt);
      document.getElementById(i+"total").value = investment.toFixed(2);   
        }
       
      }
      var total = 0
      for(i = 1; i <= item;i++){
        if((document.getElementById(i+"value") != null)|| (document.getElementById(i+"qnt") != null )){
        total += Number(document.getElementById(i+"total").value);
        }
      }
      document.getElementById('total').value =total.toFixed(2);
    }
</script>
@endsection