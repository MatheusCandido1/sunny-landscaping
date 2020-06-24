@extends('layouts.partials')
@section('title', 'Quote')
@section('content')
<form  method="POST" class="form-horizontal style-form" action="{{ route('quotes.store') }}" >
  @csrf
  <input type="hidden" name="visit_id" value="{{$visit_id}}"/>
  <div class="container-fluid">
  <h1 class="mt-4">New Quote</h1>

  <div class="row">
  <div class="col-lg-12">
  <div class="card mb-4">
  <div class="card-header">
    <i class="fas fa-list-ul"></i> Quote
  </div>
  
  <div class="card-body">
  <div>
    <div id="accordion">
      <div class="card">
        <div class="card-header">
          <a class="card-link" data-toggle="collapse" href="#collapse1">
          1 - Pavers
          </a>
          <button type="button" onclick="add1()" class="btn btn-primary float-right btn-sm">
          <i class="fas fa-plus"></i> New Item
          </button>
        </div>
        <div id="collapse1" class="collapse" data-parent="#accordion">
          <div class="card-body">
            <table id="tb1" class="table table-bordered" width="100%" cellspacing="0">
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
              <tbody  id="item_fields">
              
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
      <div id="accordion">
        <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#collapse2">
            2 - Retaining Wall
            </a>
            <button type="button" onclick="add2()" class="btn btn-primary float-right btn-sm">
            <i class="fas fa-plus"></i> New Item
            </button>
          </div>
          <div id="collapse2" class="collapse" data-parent="#accordion">
            <div class="card-body">
              <table id="tb2" class="table table-bordered" width="100%" cellspacing="0">
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
                <tbody  id="item_fields2">
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
        <div id="accordion">
          <div class="card">
            <div class="card-header">
              <a class="card-link" data-toggle="collapse" href="#collapse3">
              3 - Artificial or Natural Grass
              </a>
              <button type="button" onclick="add3()" class="btn btn-primary float-right btn-sm">
              <i class="fas fa-plus"></i> New Item
              </button>
            </div>
            <div id="collapse3" class="collapse" data-parent="#accordion">
              <div class="card-body">
                <table  id="tb3" class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="" scope="col" >Description</th>
                      <th style="" scope="col" >Quantity</th>
                      <th style="" scope="col" >Type</th>
                      <th style="" scope="col" >Unit Price</th>
                      <th style="" scope="col" >Investment</th>
                      <th style="" scope="col" >Action</th>
                    </tr>
                  </thead>
                  <tbody  id="item_fields3">
                       
                  </tbody>
                </table>
                </div>
              </div>
            </div>
          </div>

          <div id="accordion">
            <div class="card">
              <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapse4">
                4 - Trees and Plants
                </a>
                <button type="button" onclick="add4()" class="btn btn-primary float-right btn-sm">
                <i class="fas fa-plus"></i> New Item
                </button>
              </div>
              <div id="collapse4" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <table id="tb4" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th style="" scope="col" >Description</th>
                        <th style="" scope="col" >Quantity</th>
                        <th style="" scope="col" >Type</th>
                        <th style="" scope="col" >Unit Price</th>
                        <th style="" scope="col" >Investment</th>
                        <th style="" scope="col" >Action</th>

                      </tr>
                    </thead>
                    <tbody  id="item_fields4">
                         
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div> 

            <div id="accordion">
              <div class="card">
                <div class="card-header">
                  <a class="card-link" data-toggle="collapse" href="#collapse5">
                  5 - Irrigation
                  </a>
                  <button type="button" onclick="add5()" class="btn btn-primary float-right btn-sm">
                  <i class="fas fa-plus"></i> New Item
                  </button>
                </div>
                <div id="collapse5" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    <table id="tb5" class="table table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="" scope="col" >Description</th>
                          <th style="" scope="col" >Quantity</th>
                          <th style="" scope="col" >Type</th>
                          <th style="" scope="col" >Unit Price</th>
                          <th style="" scope="col" >Investment</th>
                          <th style="" scope="col" >Action</th>
                        </tr>
                      </thead>
                      <tbody  id="item_fields5">
                           
                      </tbody>
                    </table>
                    </div>
                  </div>
                </div>
              </div> 

              <div id="accordion">
                <div class="card">
                  <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapse6">
                    6 - Rocks
                    </a>
                    <button type="button" onclick="add6()" class="btn btn-primary float-right btn-sm">
                    <i class="fas fa-plus"></i> New Item
                    </button>
                  </div>
                  <div id="collapse6" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <table id="tb6" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th style="" scope="col" >Description</th>
                            <th style="" scope="col" >Quantity</th>
                            <th style="" scope="col" >Type</th>
                            <th style="" scope="col" >Unit Price</th>
                            <th style="" scope="col" >Investment</th>
                            <th style="" scope="col" >Action</th>
                          </tr>
                        </thead>
                        <tbody  id="item_fields6">
                             
                        </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                </div> 

                <div id="accordion">
                  <div class="card">
                    <div class="card-header">
                      <a class="card-link" data-toggle="collapse" href="#collapse7">
                      7 - Fire Pit
                      </a>
                      <button type="button" onclick="add7()" class="btn btn-primary float-right btn-sm">
                      <i class="fas fa-plus"></i> New Item
                      </button>
                    </div>
                    <div id="collapse7" class="collapse" data-parent="#accordion">
                      <div class="card-body">
                        <table id="tb7" class="table table-bordered" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th style="" scope="col" >Description</th>
                              <th style="" scope="col" >Quantity</th>
                              <th style="" scope="col" >Type</th>
                              <th style="" scope="col" >Unit Price</th>
                              <th style="" scope="col" >Investment</th>
                              <th style="" scope="col" >Action</th>
                            </tr>
                          </thead>
                          <tbody  id="item_fields7">
                               
                          </tbody>
                        </table>
                        </div>
                      </div>
                    </div>
                  </div> 

                  <div id="accordion">
                    <div class="card">
                      <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#collapse8">
                        8 - Drainage
                        </a>
                        <button type="button" onclick="add8()" class="btn btn-primary float-right btn-sm">
                        <i class="fas fa-plus"></i> New Item
                        </button>
                      </div>
                      <div id="collapse8" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          <table id="tb8" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th style="" scope="col" >Description</th>
                                <th style="" scope="col" >Quantity</th>
                                <th style="" scope="col" >Type</th>
                                <th style="" scope="col" >Unit Price</th>
                                <th style="" scope="col" >Investment</th>
                                <th style="" scope="col" >Action</th>
                              </tr>
                            </thead>
                            <tbody  id="item_fields8">
                                 
                            </tbody>
                          </table>
                          </div>
                        </div>
                      </div>
                    </div> 

                    <div id="accordion">
                      <div class="card">
                        <div class="card-header">
                          <a class="card-link" data-toggle="collapse" href="#collapse9">
                          9 - Transformer and Led Lights
                          </a>
                          <button type="button" onclick="add9()" class="btn btn-primary float-right btn-sm">
                          <i class="fas fa-plus"></i> New Item
                          </button>
                        </div>
                        <div id="collapse9" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                            <table id="tb9" class="table table-bordered" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th style="" scope="col" >Description</th>
                                  <th style="" scope="col" >Quantity</th>
                                  <th style="" scope="col" >Type</th>
                                  <th style="" scope="col" >Unit Price</th>
                                  <th style="" scope="col" >Investment</th>
                                  <th style="" scope="col" >Action</th>
                                </tr>
                              </thead>
                              <tbody  id="item_fields9">
                                   
                              </tbody>
                            </table>
                            </div>
                          </div>
                        </div>
                      </div> 

                      <div id="accordion">
                        <div class="card">
                          <div class="card-header">
                            <a class="card-link" data-toggle="collapse" href="#collapse10">
                            10 - Dumpster
                            </a>
                            <button type="button" onclick="add10()" class="btn btn-primary float-right btn-sm">
                            <i class="fas fa-plus"></i> New Item
                            </button>
                          </div>
                          <div id="collapse10" class="collapse" data-parent="#accordion">
                            <div class="card-body">
                              <table class="table table-bordered" id="tb10" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th style="" scope="col" >Description</th>
                                    <th style="" scope="col" >Quantity</th>
                                    <th style="" scope="col" >Type</th>
                                    <th style="" scope="col" >Unit Price</th>
                                    <th style="" scope="col" >Investment</th>
                                    <th style="" scope="col" >Action</th>

                                  </tr>
                                </thead>
                                <tbody  id="item_fields10">
                                     
                                </tbody>
                              </table>
                              </div>
                            </div>
                          </div>
                        </div> 

                        <div id="accordion">
                          <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#collapse11">
                              11 - Labor
                              </a>
                              <button type="button" onclick="add11()" class="btn btn-primary float-right btn-sm">
                              <i class="fas fa-plus"></i> New Item
                              </button>
                            </div>
                            <div id="collapse11" class="collapse" data-parent="#accordion">
                              <div class="card-body">
                                <table class="table table-bordered" id="tb11" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th style="" scope="col" >Description</th>
                                      <th style="" scope="col" >Quantity</th>
                                      <th style="" scope="col" >Type</th>
                                      <th style="" scope="col" >Unit Price</th>
                                      <th style="" scope="col" >Investment</th>
                                      <th style="" scope="col" >Action</th>
                                    </tr>
                                  </thead>
                                  <tbody  id="item_fields11">
                                       
                                  </tbody>
                                </table>
                                </div>
                              </div>
                            </div>
                          </div> 

                          <div id="accordion">
                            <div class="card">
                              <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#collapse12">
                                12 - Extra
                                </a>
                                <button type="button" onclick="add12()" class="btn btn-primary float-right btn-sm">
                                <i class="fas fa-plus"></i> New Item
                                </button>
                              </div>
                              <div id="collapse12" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                  <table id="tb12" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th style="" scope="col" >Description</th>
                                        <th style="" scope="col" >Quantity</th>
                                        <th style="" scope="col" >Type</th>
                                        <th style="" scope="col" >Unit Price</th>
                                        <th style="" scope="col" >Investment</th>
                                        <th style="" scope="col" >Action</th>
                                      </tr>
                                    </thead>
                                    <tbody  id="item_fields12">
                                         
                                    </tbody>
                                  </table>
                                  </div>
                                </div>
                              </div>
                            </div> 


        <div id="accordion">
          <div class="card">
            <div class="card-header">
              <a class="card-link" data-toggle="collapse" href="#collapse13" >
              13 - Others
              </a>
              <button type="button" onclick="add13()" class="btn btn-primary float-right btn-sm">
              <i class="fas fa-plus"></i> New Item
              </button>
            </div>
            <div id="collapse13" class="collapse" data-parent="#accordion">
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
                  </tbody>
                </table>
                </div>
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
            <input type="text" required id="totalwithoutdiscount" name="subtotal" readonly   class="form-control">
          </td>
        </tr>
        <tr>
          <td >Accepting Proposal</td>
          <td style="text-align: right"  scope="col" >
            <div class="input-group mb-3">
              <input type="text" value="500.00" required name="accepting_proposal" id="accepting_proposal" value="0"   class="form-control" placeholder="Total with discount">
              <div class="input-group-append">
                <button onclick="PayDown()" class="btn btn-success" type="button">Get Payment Down</button>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td >Down Payment</td>
          <td >
            <input type="text" id="down_payment" required name="down_payment" readonly class="form-control"  placeholder="Payment Down">
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
        <tr style="display:">
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

<script type="text/javascript">
  var item = 0;
  function add1() {
  item++;
      var objTo = document.getElementById('item_fields')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<td><input type="hidden" id="'+item+'sup" name="supplier[]" value=""> <select required id="'+item+'supplier"  onchange="getUnitValue()" class="form-control"> <option value="">Select a supplier </option> @foreach($suppliers as $supplier) <option value="{{$supplier->value}}" > {{$supplier->name}} </option> @endforeach </select> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value="'+item+'"> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control"  placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div>  </td> <td> <input required type="text" name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td> <td style="text-align: center;" scope="col"><button onclick="deleteItem1(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add2() {
  item++;
      var objTo = document.getElementById('item_fields2')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<td><input type="hidden" id="'+item+'sup" name="supplier[]" value=""> <select required id="'+item+'supplier"  onchange="getUnitValue()" class="form-control"> <option value="">Select a supplier </option> @foreach($suppliers as $supplier) <option value="{{$supplier->value}}" > {{$supplier->name}} </option> @endforeach </select> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value="'+item+'"> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input required type="text" name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td> <td style="text-align: center;" scope="col"><button onclick="deleteItem2(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }
  function add3() {
    item++;
      var objTo = document.getElementById('item_fields3')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem3(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add4() {
    item++;
      var objTo = document.getElementById('item_fields4')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem4(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add5() {
    item++;
      var objTo = document.getElementById('item_fields5')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem5(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add6() {
    item++;
      var objTo = document.getElementById('item_fields6')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem6(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add7() {
    item++;
      var objTo = document.getElementById('item_fields7')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem7(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add8() {
    item++;
      var objTo = document.getElementById('item_fields8')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem8(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add9() {
    item++;
      var objTo = document.getElementById('item_fields9')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem9(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add10() {
    item++;
      var objTo = document.getElementById('item_fields10')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem10(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add11() {
    item++;
      var objTo = document.getElementById('item_fields11')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem11(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add12() {
    item++;
      var objTo = document.getElementById('item_fields12')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem12(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
  }

  function add13() {
  item++;
      var objTo = document.getElementById('item_fields13')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="-" placeholder="Supplier" class="form-control" name="supplier[]" > <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><button onclick="deleteItem13(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest);
  }
  
  function deleteItem1(button){
    var empTab = document.getElementById('tb1');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem2(button){
    var empTab = document.getElementById('tb2');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem3(button){
    var empTab = document.getElementById('tb3');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem4(button){
    var empTab = document.getElementById('tb4');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem5(button){
    var empTab = document.getElementById('tb5');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem6(button){
    var empTab = document.getElementById('tb6');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem7(button){
    var empTab = document.getElementById('tb7');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem8(button){
    var empTab = document.getElementById('tb8');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem9(button){
    var empTab = document.getElementById('tb9');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem10(button){
    var empTab = document.getElementById('tb10');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem11(button){
    var empTab = document.getElementById('tb11');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem12(button){
    var empTab = document.getElementById('tb12');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }

  function deleteItem13(button){
    var empTab = document.getElementById('tb13');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }


  function getUnitValue()
  {
  for(i = 1; i <= item; i++){
    if(document.getElementById(i+"supplier") != null){
    document.getElementById(i+"sup").value = document.getElementById(i+"supplier").options[document.getElementById(i+"supplier").selectedIndex].text;
    document.getElementById(i+"value").value = document.getElementById(i+"supplier").value
    }
   }
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
        total += Number(document.getElementById(i+"total").value);
      }
      document.getElementById('total').value =total.toFixed(2);
    }
        
</script>
@endsection