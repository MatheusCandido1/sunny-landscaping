@extends('layouts.partials')
@section('title', 'Change Order')
@section('content')
<script>
    window.onload = function() {
    findTotal();
  };
  </script>
<form  method="POST" class="form-horizontal style-form" action="{{ route('changeorders.update', ['changeroder' => $changeorder_id ])}}" >
    @csrf
    @method('PUT')
  <input type="hidden" readonly name="visit_id" value="{{$visit}}"/>
  <input type="hidden" readonly name="customer_id" value="{{$customer}}"/>
  <div class="container-fluid">
  <h1 class="mt-4">Edit Change Order #{{$changeorder->change_order_key }}<a type="button" href=""  data-toggle="modal" data-target="#exampleModal" class="btn btn-success float-right btn-sm">
    See Quote(s) Details
  </a></h1>

  <div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-pencil-alt"></i> Change Order 
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
            @foreach($elementData as $element)
            <tr>
                <td style="width: 15%">
                    <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                     <select onchange="findTotal()" name="target[]" id="{{$loop->iteration}}target" class="form-control">
                         <option {{$element->target == "Add" ? 'selected':''}} value="Add">Add</option> 
                         <option {{$element->target == "Remove" ? 'selected':''}} value="Remove">Remove</option> 
                         <option {{$element->target == "Edit" ? 'selected':''}} value="Edit">Edit</option>
                     </select> 
                    </td> 
                    <td> 
                        <div class="input-group">
                        <input type="hidden" name="id[]" value="{{$element->id}}"> 
                            <input type="text" id="" value="{{$element->description}}" name="description[]" placeholder="Description" class="form-control" >
                         </td> 
                         <td>
                            <input type="number" id="{{$loop->iteration}}quantity" value="{{$element->quantity}}" onchange="findTotal()" name="quantity[]" placeholder="Quantity" class="form-control" >
                         </td>
                         <td>
                            <input type="text" id="type" value="{{$element->type}}" name="type[]" placeholder="Type" class="form-control" > 
                        </td> 
                        <td> 
                            <input type="text" id="{{$loop->iteration}}unit_price" value="{{number_format($element->unit_price,2)}}" onchange="findTotal()" name="unit_price[]" placeholder="Unit Price" class="form-control" > 
                        </td> 
                        <td> 
                            <input type="text" id="{{$loop->iteration}}investment" readonly value="{{number_format($element->investment,2)}}" name="investment[]" placeholder="Investment" class="form-control" >
                        </td> 
                            <td style="text-align: center;" scope="col"> <button onclick="deleteItem(this)"  type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </td>
            </tr>   
            @endforeach
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
            <td >Options</td>
            <td style="text-align: right"  scope="col" >
            <div class="row">
              <div class="col-lg-12">
              <select required class="form-control" name="option_1">
                  <option value="" >Choose and option...</option>
                  <option {{$changeorder->option_1 == "Additional" ? 'selected':''}} value="Additional">Additional</option>
                  <option  {{$changeorder->option_1 == "Removal" ? 'selected':''}}   value="Removal">Removal</option>
              </select> 
              </div>
            </div>
            </td>
      </tr>
        <tr>
          <td >Total</td>
          <td style="text-align: right"  scope="col" >
              <input type="text"  value="{{number_format($change_amount,2)}}"   id=""  readonly   class="form-control">
            
          </td>
        </tr>
        <tr>
          <td >Date</td>
          <td style="text-align: right"  scope="col" >
              <input type="date" name="date" value="{{date('Y-m-d', strtotime($changeorder->date))}}" required   class="form-control">
            
          </td>
        </tr>
        <tr>
          <td >Subtotal</td>
          <td style="text-align: right"  scope="col" >
              <input type="text"  required name="subtotal" value="{{number_format($changeorder->subtotal,2)}}"   id="totalWithout"  readonly   class="form-control" placeholder="Total">
            
          </td>
        </tr>
        <tr>
          <td >Discount</td>
          <td style="text-align: right"  scope="col" >
            <div class="input-group mb-3">
            <input type="text" value="{{number_format($changeorder->discount,2)}}" name="discount" id="discount" class="form-control" placeholder="Discount">

              <div class="input-group-append">
                <button onclick="getDiscount()" class="btn btn-success" type="button">Get Discount</button>
              </div>
            </div>
          </td>
        </tr>
        <tr>
        <td >Change Order Amount </td>
          <td style="text-align: right"  scope="col" >
          <input type="text"   name="change_order_amount" value=""   id="total"    class="form-control" placeholder="Total" required>
          <input type="hidden"  required name="revised_contract_amount" value=""   id="revised">
          <input type="hidden" id="original" name="original_contract_amount" value="{{$change_amount}}"/>
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
  
@endsection
@section('script')
<script type="text/javascript">
 $("#total").keydown(function(e){
        e.preventDefault();
    });

  var item = document.getElementById('loopsize').value;
  function add(){
      item++;
      var objTo = document.getElementById('item_rows')
      var divtest = document.createElement("tr");
      divtest.innerHTML ='<td style="width: 15%"> <select onchange="findTotal()" name="target[]" id="'+item+'target" class="form-control"> <option value="Add">Add</option> <option value="Remove">Remove</option> <option value="Edit">Edit</option> </select> </td> <td> <div class="input-group"><input type="hidden" name="id[]" value="'+item+'"> <input type="text" id="" value="" name="description[]" placeholder="Description" class="form-control" > </td> <td> <input type="number" id="'+item+'quantity" value="0" onchange="findTotal()" name="quantity[]" placeholder="Quantity" class="form-control" > </td> <td> <input type="text" id="type" value="" name="type[]" placeholder="Type" class="form-control" > </td> <td> <input type="text" id="'+item+'unit_price" value="0" onchange="findTotal()" name="unit_price[]" placeholder="Unit Price" class="form-control" > </td> <td> <input type="text" id="'+item+'investment" readonly value="" name="investment[]" placeholder="Investment" class="form-control" > </td> <td style="text-align: center;" scope="col"> <button onclick="deleteItem(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button> </td>';
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

    value = value.replace(/[^\d\.\-]/g, ""); 
      qnt = qnt.replace(/[^\d\.\-]/g, ""); 

    var investment = parseFloat(value) * parseFloat(qnt);
    if(document.getElementById(i+"target").value == "Remove")
    investment = (investment * (-1))
    document.getElementById(i+"investment").value = investment.toFixed(2);
      }
    }
    getNewTotal();

  }

  function getDiscount(){
    var new_total = parseFloat(document.getElementById('totalWithout').value) - Number((document.getElementById('discount').value));
    document.getElementById('total').value = new_total.toFixed(2);

    getRevised();
  }

  function getRevised(){
    var revised =  parseFloat(document.getElementById('original').value) + parseFloat(document.getElementById('total').value);
    document.getElementById('revised').value = parseFloat(revised).toFixed(2);
  }


  function getNewTotal(){
    total = 0;
    for(i = 1; i <= item;i++){
        if((document.getElementById(i+"unit_price") != null) || (document.getElementById(i+"quantity") != null )){
        total += Number(document.getElementById(i+"investment").value);
        }
      }
      document.getElementById('totalWithout').value = parseFloat(total.toFixed(2));
  }
</script>
@endsection