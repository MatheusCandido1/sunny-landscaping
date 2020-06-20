@extends('layouts.partials')
@section('title', 'Costumers')
@section('content')
<form  method="POST" class="form-horizontal style-form" action="{{ route('service.storeItems') }}" > 
  @csrf
  <input type="hidden" name="visit_id" value="{{$visit_id}}"/>
<div class="container-fluid">
  <h1 class="mt-4">New Quote</h1>
<div class="row">
<div class="col-lg-12">
<div class="card mb-4">
<div class="card-header">
  <i class="fas fa-list-ul"></i> Quote</div>
<div class="card-body">
<div> 
  <div id="accordion">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse1">
          Pavers #1
        </a>
      </div>
      <div id="collapse1" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 0; $i < 24; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <input type="text" class="form-control" value="{{$items[$i]->description}}"/>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">           
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>
    <div id="accordion">
      <div class="card">
        <div class="card-header">
          <a class="card-link" data-toggle="collapse" >
            Others
          </a>
            <button type="button" onclick="addNewInput()" class="btn btn-primary float-right btn-sm">
              <i class="fas fa-plus"></i> New Item
        </button>
        </div>
        
          
          <div class="card-body">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="" scope="col" >Item description</th>
                  <th style="" scope="col" >Quantity</th>
                  <th style="" scope="col" >Type</th>
                  <th style="" scope="col" >Unit Price</th>
                  <th style="" scope="col" >Per type</th>
                  <th style="" scope="col" >Investment</th>
              </tr>
              </thead>
              <tbody  id="item_fields">
<tr>
  <td>
    <div class="input-group mb-3">
    <div class="input-group-prepend">
      <input type="text" class="form-control" value="" placeholder="Description"/>
    </div>
  </td>
 <td> <input  id="25qnt" value="0"  name="qnt[]"  type="text" class="form-control" placeholder="Quantity"></td>
    <td>
<input type="text" class="form-control">
    </td>
 <td>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">$</span>
    </div>
    <input type="text" value="0"  onchange="findTotal()"   id="25value" class="form-control"   placeholder="Unit cost">
  </div>
</td>
    <td><input type="text" class="form-control">
    </td>
    <td> <input type="text" id="25total" readonly name="total[]"  class="form-control items" placeholder="Investment"> </td>    
  
</tr>

              </tbody>
            </table>
          </div>
    </div>
    </div>
    </div>
    </div>
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
                      <input name="discount" type="text" class="form-control" id="discount" value="0.00" placeholder="Discount" aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button onclick="Discount()" class="btn btn-success" type="button">Get Discount</button>
                      </div>
                    </div>
                  </td>
              </tr>
              <tr>
                <td >Total</td>
                <td style="text-align: right"  scope="col" >
                  <input type="text" id="totalwithoutdiscount" name="subtotal" readonly   class="form-control">

                </td>
            </tr>
                  <tr>
                        <td >Accepting Proposal</td>
                        <td style="text-align: right"  scope="col" >
                          <div class="input-group mb-3">
                            <input type="text" value="500.00" name="accepting_proposal" id="accepting_proposal" value="0"   class="form-control" placeholder="Total with discount">
                            <div class="input-group-append">
                              <button onclick="PayDown()" class="btn btn-success" type="button">Get Payment Down</button>
                            </div>
                          </div>

                        </td>
                    </tr>
                    <tr>
                      <td >Down Payment</td>
                      <td >
                        <input type="text" id="down_payment" name="down_payment" readonly class="form-control"  placeholder="Payment Down">

                      </td>
                  </tr>
                  <tr>
                    <td >Final Balance</td>
                    <td>
                    <div class="input-group mb-3">
                      <input type="text" id="finalbalance" name="final_balance" class="form-control" placeholder="The final balance will be displayed here" value="0" >
                      <div class="input-group-append">
                        <button onclick="getFinalBalance()" class="btn btn-success" type="button">Get Final Balance</button>
                      </div>
                    </div>
                  </td>
                </tr>
                  <td >Total Without Discount</td>
                  <td style="text-align: right" scope="col" >
                    <input type="text" id="total"  class="form-control" placeholder="">
                  </td>
                </tbody>
            </table>
          <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Save Quote</button>
        </div>

</ul>
</form>
<script type="text/javascript">
var item= 25;
function addNewInput() {
item++;
    var objTo = document.getElementById('item_fields')
    var divtest = document.createElement("tr");
    divtest.innerHTML = '<td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="text" class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" name="qnt[]" type="text" class="form-control" placeholder="Quantity"></td> <td> <input type="text" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" onchange="findTotal()" id="'+item+'value" class="form-control" placeholder="Unit cost"> </div> </td> <td><input type="text" class="form-control"> </td> <td> <input type="text" id="'+item+'total" readonly name="total[]" class="form-control items" placeholder="Investment"> </td>';
    objTo.appendChild(divtest)
}
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
  function findTotal(){
    for(i = 1; i <= item; i++){
    var value = document.getElementById(i+"value").value;
    var qnt = document.getElementById(i+"qnt").value;
    var investment = parseFloat(value) * parseFloat(qnt);
    document.getElementById(i+"total").value = investment.toFixed(2)   
    }
    var total = 0
    for(i = 1; i <= item;i++){
      total += Number(document.getElementById(i+"total").value);
    }
    document.getElementById('total').value =total.toFixed(2);
  }
      </script>
@endsection