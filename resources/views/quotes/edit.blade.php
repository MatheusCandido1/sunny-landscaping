@extends('layouts.partials')
@section('title', 'Quote')
@section('content')
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
      <button type="button" onclick="" class="btn btn-primary float-right btn-sm">
      <i class="fas fa-plus"></i> New Item
      </button>
    </div>
      <div class="card-body">
        <table id="tb13" class="table table-bordered" width="100%" cellspacing="0">
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
                     <input type="hidden" name="id[]" value="{{$item->id}}"> 
                     <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                     </td> 
                     <td> 
                       <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
                        <div id="qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> 
                      </td>
                       <td> 
                         <input type="text" value="{{$item->type}}" required name="type[]" placeholder="" class="form-control">
                         </td>
                          <td> 
                            <div class="input-group mb-3">
                               <div class="input-group-prepend">
                                  <span class="input-group-text">$</span>
                                 </div> 
                                 <input type="text" id="{{$loop->iteration}}value" value="{{$item->unit_price}}" onchange="findTotal()" name="unit_price[]" class="form-control" placeholder="Unit cost"> </div>
                                 </td> 
                                 <td> 
                                   <input type="text" id="{{$loop->iteration}}total" readonly name="investment[]" value="{{$item->investment}}" class="form-control items" placeholder="Investment">
                                   </td>
                                   <td style="text-align: center;" scope="col">
                                    <button onclick="" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
            <input name="discount" type="text" class="form-control" id="discount"  value="{{$service->discount}}" placeholder="Discount" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button onclick="Discount()" class="btn btn-success" type="button">Get Discount</button>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td >Total</td>
          <td style="text-align: right"  scope="col" >
          <input type="text" required id="totalwithoutdiscount" name="total" readonly value="{{$service->total}}"   class="form-control">
          </td>
        </tr>
        <tr>
          <td >Accepting Proposal</td>
          <td style="text-align: right"  scope="col" >
            <div class="input-group mb-3">
              <input type="text" value="{{$service->accepting_proposal}}" required name="accepting_proposal" id="accepting_proposal"    class="form-control" placeholder="Total with discount">
              <div class="input-group-append">
                <button onclick="PayDown()" class="btn btn-success" type="button">Get Payment Down</button>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td >Down Payment</td>
          <td >
            <input type="text" id="down_payment" required name="down_payment" value="{{$service->down_payment}}" readonly class="form-control"  placeholder="Payment Down">
          </td>
        </tr>
        <tr>
          <td >Final Balance</td>
          <td>
            <div class="input-group mb-3">
              <input type="text" id="finalbalance" onkeypress="return false;" required name="final_balance" class="form-control" placeholder="The final balance will be displayed here" value="{{$service->final_balance}}" >
              <div class="input-group-append">
                <button onclick="getFinalBalance()" class="btn btn-success" type="button">Get Final Balance</button>
              </div>
            </div>
          </td>
        </tr>
        <tr style="display: none">
          <td >Total Without Discount</td>
          <td style="text-align: right" scope="col" >
          <input type="text" value="{{$service->total}}" id="total"  class="form-control" placeholder="">
          </td>
        </tr>
      </tbody>
    </table>
    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Save Quote</button>
  </div>
</form>

<script type="text/javascript">
 var item = 
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
      console.log(value)
      var qnt = document.getElementById(i+"qnt").value;
      var investment = parseFloat(value) * parseFloat(qnt);
      document.getElementById(i+"total").value = investment.toFixed(2);   
      }
      var total = 0
      for(i = 1; i <= item;i++){
        total += Number(document.getElementById(i+"total").value);
      }
      document.getElementById('total').value =total.toFixed(2);
    }
</script>
@endsection