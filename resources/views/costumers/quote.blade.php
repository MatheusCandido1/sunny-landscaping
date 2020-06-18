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
                <span class="input-group-text">{{$items[$i]->description}}</span>
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

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse2">
          Retaining Wall #2
        </a>
      </div>
      <div id="collapse2" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 24; $i < 32; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse3">
          Artificial or Natural Grass #3
        </a>
      </div>
      <div id="collapse3" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 32; $i < 42; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse4">
          Trees and Plants #4
        </a>
      </div>
      <div id="collapse4" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 42; $i < 53; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse5">
          Irrigation #5
        </a>
      </div>
      <div id="collapse5" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 53; $i < 63; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse6">
          Rocks #6
        </a>
      </div>
      <div id="collapse6" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 63; $i < 91; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse7">
          Fire Pit #7
        </a>
      </div>
      <div id="collapse7" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 91; $i < 94; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse8">
          Drainage #8
        </a>
      </div>
      <div id="collapse8" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 94; $i < 96; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse9">
          Transformer and Led Lights #9
        </a>
      </div>
      <div id="collapse9" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 96; $i < 101; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse10">
          Dumpster #10
        </a>
      </div>
      <div id="collapse10" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 101; $i < 103; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse11">
          Labor #11
        </a>
      </div>
      <div id="collapse11" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 103; $i < 131; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapse12">
          Extra #12
        </a>
      </div>
      <div id="collapse12" class="collapse" data-parent="#accordion">
        <div class="card-body">
          <div>
            @for ($i = 131; $i < 132; $i++)
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$items[$i]->description}}</span>
              </div>
            <input  name="id[]" type="hidden" value="{{$items[$i]->id}}" >
            <input onblur="findTotal()" value="0" id="{{$items[$i]->id}}qnt"  name="qnt[]" type="text" class="form-control qnt" placeholder="Quantity">
              <span class="input-group-text">{{$items[$i]->type}}</span>
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
            <input type="text" id="{{$items[$i]->id}}value" readonly class="form-control val"  value="{{number_format($items[$i]->unit_cost,2)}}">
              <span class="input-group-text">{{$items[0]->type_per}}</span>
              <input type="text" id="{{$items[$i]->id}}total" readonly name="total[]"  class="form-control items" placeholder="Investment">
              
            </div>
            @endfor
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
                <tr style="display: none">
                  <td >Total Without Discount</td>
                  <td style="text-align: right" scope="col" >
                    <input type="text" id="total"  class="form-control" placeholder="">
                  </td>
              </tr>
                </tbody>
            </table>
          <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Save Quote</button>
        </div>

</ul>
</form>

</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
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
    for(i = 1; i <= 132; i++){
    var value = document.getElementById(i+"value").value;
    var qnt = document.getElementById(i+"qnt").value;
    var investment = parseFloat(value) * parseFloat(qnt);
    document.getElementById(i+"total").value = investment.toFixed(2)   
    }
    var total = 0
    for(i = 1; i <= 132;i++){
      total += Number(document.getElementById(i+"total").value);
    }
    document.getElementById('total').value =total.toFixed(2);
  }
      </script>
@endsection