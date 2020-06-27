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
    <h1 class="mt-4">Edit Quote</h1>

  <div class="row">
    <div class="col-lg-12">
    <div class="card mb-4">
    <div class="card-header">
      <i class="fas fa-list-ul"></i> Edit Quote
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
                  @foreach($items as $item)
                  @if($item->group_type == "1 - PAVERS") 
                  <tr>
                    <td>
<select required id="supplier"  onchange="getUnitValue()" class="form-control"> <option value="">Select a supplier </option> @foreach($suppliers as $supplier) <option {{ $item->supplier == $supplier->name ? 'selected' : '' }} value="{{$supplier->value}}" > {{$supplier->name}} </option> @endforeach </select>                     </td>
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
                  @endif
                  @endforeach
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
                    @foreach($items as $item)
                    @if($item->group_type == "2 - RETAINING WALL") 
                    <tr>
                      <td>
                        <select required id="supplier"  onchange="getUnitValue()" class="form-control"> <option value="">Select a supplier </option> @foreach($suppliers as $supplier) <option {{ $item->supplier == $supplier->name ? 'selected' : '' }} value="{{$supplier->value}}" > {{$supplier->name}} </option> @endforeach </select>                     </td>
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
                    @endif
                    @endforeach
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
                3 - Grass
                </a>
                <button type="button" onclick="add3()" class="btn btn-primary float-right btn-sm">
                <i class="fas fa-plus"></i> New Item
                </button>
              </div>
              <div id="collapse3" class="collapse" data-parent="#accordion">
                <div class="card-body">
                  <table id="tb3" class="table table-bordered" width="100%" cellspacing="0">
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
                      @foreach($items as $item)
                      @if($item->group_type == "3 - GRASS") 
                      <tr>
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
                      @endif
                      @endforeach
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
                  4 - Tress and Plants
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
                        @foreach($items as $item)
                        @if($item->group_type == "4 - TREES AND PLANTS") 
                        <tr>
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
                        @endif
                        @endforeach
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
                          @foreach($items as $item)
                          @if($item->group_type == "5 - IRRIGATION") 
                          <tr>
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
                          @endif
                          @endforeach
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
                            @foreach($items as $item)
                            @if($item->group_type == "6 - ROCKS") 
                            <tr>
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
                            @endif
                            @endforeach
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
                              @foreach($items as $item)
                              @if($item->group_type == "7 - FIRE PIT") 
                              <tr>
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
                              @endif
                              @endforeach
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
                                @foreach($items as $item)
                                @if($item->group_type == "8 - DRAINAGE") 
                                <tr>
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
                                @endif
                                @endforeach
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
                            9 - transformer and Led Lights
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
                                  @foreach($items as $item)
                                  @if($item->group_type == "9 - TRANSFORMER AND LED LIGHTS") 
                                  <tr>
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
                                  @endif
                                  @endforeach
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
                                <table id="tb10" class="table table-bordered" width="100%" cellspacing="0">
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
                                    @foreach($items as $item)
                                    @if($item->group_type == "10 - DUMPSTER") 
                                    <tr>
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
                                    @endif
                                    @endforeach
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
                                  <table id="tb11" class="table table-bordered" width="100%" cellspacing="0">
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
                                      @foreach($items as $item)
                                      @if($item->group_type == "11 - LABOR") 
                                      <tr>
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
                                      @endif
                                      @endforeach
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
                                        @foreach($items as $item)
                                        @if($item->group_type == "12 - EXTRA") 
                                        <tr>
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
                                        @endif
                                        @endforeach
                                      </tbody>
                                    </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div id="accordion">
                                <div class="card">
                                  <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapse13">
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
                                          @foreach($items as $item)
                                          @if($item->group_type == "13 - OTHERS") 
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
                                          @endif
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