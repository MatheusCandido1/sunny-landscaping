@extends('layouts.partials')
@section('title', 'Quote')
@section('content')
<script>
  window.onload = function() {
  findTotal();
};
</script>
<form  method="POST" class="form-horizontal style-form" action="{{ route('quotes.update',$service_id) }}" >
  @csrf
  @method('PUT')
  <input type="hidden" name="visit_id" value="{{$visit_id}}"/>
  <input type="hidden" name="customer_id" value="{{$customer_id}}"/>

  <div class="container-fluid">
  <h1 class="mt-4">Edit Quote #{{$service->quote_key}}</h1>

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
            <a class="card-link" aria-expanded="true" data-toggle="collapse" href="#collapse1">
            1 - Pavers
            </a>
            <button type="button" onclick="add1()" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> New Item
            </button>
          </div>
        <div id="collapse1" class="collapse {{ (isset($pavers)) ? 'show':''}}">
            <div class="card-body">
              <table id="tb1" class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th style="" scope="col" >Description</th>
                    <th style="" scope="col" >Quantity</th>
                    <th style="" scope="col" >Type</th>
                    <th style="" scope="col" >Unit Price</th>
                    <th style="" scope="col" >Investment</th>
                    <th style="text-align: center; width: 18%" scope="col" >Action</th>
                  </tr>
                </thead>
                <tbody  id="item_fields">
                  @foreach($items as $item)
                  @if($item->group_type == "1 - PAVERS")
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
                                  <input type="hidden" value="1 - PAVERS" name="group_type[]"/>
                                  <div class="input-group mb-3">
                                     <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                       </div> 
                                       <input type="text" id="{{$loop->iteration}}value"  value="{{number_format($item->unit_price,2)}}" onchange="findTotal()" name="unit_price[]" class="form-control" placeholder="Unit cost"> 
                                      </div>
                                       </td> 
                                       <td> 
                                         <input type="text" id="{{$loop->iteration}}total" readonly name="investment[]" value="{{number_format($item->investment,2)}}" class="form-control items" placeholder="Investment">
                                         </td>
                                         <td style="text-align: center;" scope="col">
                                          <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                          <button onclick="deleteAndRefresh(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"></i></button>
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
              <button type="button" onclick="add2()" class="btn btn-primary btn-sm">
              <i class="fas fa-plus"></i> New Item
              </button>
            </div>
            <div id="collapse2" class="collapse {{ (isset($walls)) ? 'show':''}}">
              <div class="card-body">
                <table id="tb2" class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="" scope="col" >Description</th>
                      <th style="" scope="col" >Quantity</th>
                      <th style="" scope="col" >Type</th>
                      <th style="" scope="col" >Unit Price</th>
                      <th style="" scope="col" >Investment</th>
                      <th style="text-align: center; width: 18%" scope="col" >Action</th>
    
                    </tr>
                  </thead>
                  <tbody  id="item_fields2">
                    @foreach($items as $item)
                    @if($item->group_type == "2 - RETAINING WALL") 
                    <tr>
                       <td> 
                         <div class="input-group mb-3"> 
                           <div class="input-group-prepend"> 
                            <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                             <input type="hidden" name="id[]" value="{{$item->id}}"> 
                             <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                             <input type="hidden" value="2 - RETAINING WALL" name="group_type[]"/>
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
                                            <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                            <button onclick="deleteAndRefresh2(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"></i></button>
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
                <button type="button" onclick="add3()" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> New Item
                </button>
              </div>
              <div id="collapse3" class="collapse {{ (isset($grass)) ? 'show':''}}">
                <div class="card-body">
                  <table id="tb3" class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th style="" scope="col" >Description</th>
                        <th style="" scope="col" >Quantity</th>
                        <th style="" scope="col" >Type</th>
                        <th style="" scope="col" >Unit Price</th>
                        <th style="" scope="col" >Investment</th>
                        <th style="text-align: center; width: 18%" scope="col" >Action</th>
      
                      </tr>
                    </thead>
                    <tbody  id="item_fields3">
                      @foreach($items as $item)
                      @if($item->group_type == "3 - GRASS") 
                      <tr>
                         <td> 
                          <input type="hidden" value="3 - GRASS" name="group_type[]">
                           <div class="input-group mb-3"> 
                             <div class="input-group-prepend"> 
                              <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                               <input type="hidden" name="id[]" value="{{$item->id}}"> 
                               <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                               </td> 
                               <td> 
                                 <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">

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
                                              <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                             <button onclick="deleteAndRefresh3(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"></i></button>
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
                  <button type="button" onclick="add4()" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus"></i> New Item
                  </button>
                </div>
                <div id="collapse4" class="collapse {{ (isset($trees)) ? 'show':''}}">
                  <div class="card-body">
                    <table id="tb4" class="table table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="" scope="col" >Description</th>
                          <th style="" scope="col" >Quantity</th>
                          <th style="" scope="col" >Type</th>
                          <th style="" scope="col" >Unit Price</th>
                          <th style="" scope="col" >Investment</th>
                          <th style="text-align: center; width: 18%" scope="col" >Action</th>
                        </tr>
                      </thead>
                      <tbody  id="item_fields4">
                        @foreach($items as $item)
                        @if($item->group_type == "4 - TREES AND PLANTS") 
                        <tr>
                           <td>
                            <input type="hidden" value="4 - TREES AND PLANTS" name="group_type[]"> 
                             <div class="input-group mb-3"> 
                               <div class="input-group-prepend"> 
                                <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                 <input type="hidden" name="id[]" value="{{$item->id}}"> 
                                 <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                 </td> 
                                 <td> 
                                   <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                               <button onclick="deleteAndRefresh4(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                    <button type="button" onclick="add5()" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> New Item
                    </button>
                  </div>
                  <div id="collapse5" class="collapse {{ (isset($irrigation)) ? 'show':''}}">
                    <div class="card-body">
                      <table id="tb5" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th style="" scope="col" >Description</th>
                            <th style="" scope="col" >Quantity</th>
                            <th style="" scope="col" >Type</th>
                            <th style="" scope="col" >Unit Price</th>
                            <th style="" scope="col" >Investment</th>
                            <th style="text-align: center; width: 18%" scope="col" >Action</th>
          
                          </tr>
                        </thead>
                        <tbody  id="item_fields5">
                          @foreach($items as $item)
                          @if($item->group_type == "5 - IRRIGATION") 
                          <tr>
                             <td> 
                              <input type="hidden" value="5 - IRRIGATION" name="group_type[]">
                               <div class="input-group mb-3"> 
                                 <div class="input-group-prepend"> 
                                  <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                   <input type="hidden" name="id[]" value="{{$item->id}}">
                                   <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                   </td> 
                                   <td> 
                                     <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                  <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                                 <button onclick="deleteAndRefresh5(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                      <button type="button" onclick="add6()" class="btn btn-primary btn-sm">
                      <i class="fas fa-plus"></i> New Item
                      </button>
                    </div>
                    <div id="collapse6" class="collapse {{ (isset($rocks)) ? 'show':''}}">
                      <div class="card-body">
                        <table id="tb6" class="table table-bordered" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th style="" scope="col" >Description</th>
                              <th style="" scope="col" >Quantity</th>
                              <th style="" scope="col" >Type</th>
                              <th style="" scope="col" >Unit Price</th>
                              <th style="" scope="col" >Investment</th>
                              <th style="text-align: center; width: 18%" scope="col" >Action</th>
            
                            </tr>
                          </thead>
                          <tbody  id="item_fields6">
                            @foreach($items as $item)
                            @if($item->group_type == "6 - ROCKS") 
                            <tr>
                               <td> 
                                  <input type="hidden" value="6 - ROCKS" name="group_type[]">
                                 <div class="input-group mb-3"> 
                                   <div class="input-group-prepend"> 
                                    <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                     <input type="hidden" name="id[]" value="{{$item->id}}"> 
                                     <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                     </td> 
                                     <td> 
                                       <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                    <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                                   <button onclick="deleteAndRefresh6(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                        <button type="button" onclick="add7()" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> New Item
                        </button>
                      </div>
                      <div id="collapse7" class="collapse {{ (isset($fire)) ? 'show':''}}">
                        <div class="card-body">
                          <table id="tb7" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th style="" scope="col" >Description</th>
                                <th style="" scope="col" >Quantity</th>
                                <th style="" scope="col" >Type</th>
                                <th style="" scope="col" >Unit Price</th>
                                <th style="" scope="col" >Investment</th>
                                <th style="text-align: center; width: 18%" scope="col" >Action</th>
              
                              </tr>
                            </thead>
                            <tbody  id="item_fields7">
                              @foreach($items as $item)
                              @if($item->group_type == "7 - FIRE PIT") 
                              <tr>
                                 <td>
                                  <input type="hidden" value="7 - FIRE PIT" name="group_type[]"> 
                                   <div class="input-group mb-3"> 
                                     <div class="input-group-prepend"> 
                                      <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                       <input type="hidden" name="id[]" value="{{$item->id}}"> 
                                       <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                       </td> 
                                       <td> 
                                         <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                      <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                                     <button onclick="deleteAndRefresh7(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                          <button type="button" onclick="add8()" class="btn btn-primary btn-sm">
                          <i class="fas fa-plus"></i> New Item
                          </button>
                        </div>
                        <div id="collapse8" class="collapse {{ (isset($drainage)) ? 'show':''}}">
                          <div class="card-body">
                            <table id="tb8" class="table table-bordered" width="100%" cellspacing="0">
                              <thead>
                                <tr>
                                  <th style="" scope="col" >Description</th>
                                  <th style="" scope="col" >Quantity</th>
                                  <th style="" scope="col" >Type</th>
                                  <th style="" scope="col" >Unit Price</th>
                                  <th style="" scope="col" >Investment</th>
                                  <th style="text-align: center; width: 18%" scope="col" >Action</th>
                
                                </tr>
                              </thead>
                              <tbody  id="item_fields8">
                                @foreach($items as $item)
                                @if($item->group_type == "8 - DRAINAGE") 
                                <tr>
                                   <td> 
                                    <input type="hidden" value="8 - DRAINAGE" name="group_type[]"> 
                                     <div class="input-group mb-3"> 
                                       <div class="input-group-prepend"> 
                                        <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                         <input type="hidden" name="id[]" value="{{$item->id}}"> 
                                         <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                         </td> 
                                         <td> 
                                           <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                        <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                                       <button onclick="deleteAndRefresh8(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                            9 - Transformer and Led Lights
                            </a>
                            <button type="button" onclick="add9()" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> New Item
                            </button>
                          </div>
                          <div id="collapse9" class="collapse {{ (isset($trans)) ? 'show':''}}">
                            <div class="card-body">
                              <table id="tb9" class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th style="" scope="col" >Description</th>
                                    <th style="" scope="col" >Quantity</th>
                                    <th style="" scope="col" >Type</th>
                                    <th style="" scope="col" >Unit Price</th>
                                    <th style="" scope="col" >Investment</th>
                                    <th style="text-align: center; width: 18%" scope="col" >Action</th>
                  
                                  </tr>
                                </thead>
                                <tbody  id="item_fields9">
                                  @foreach($items as $item)
                                  @if($item->group_type == "9 - TRANSFORMER AND LED LIGHTS") 
                                  <tr>
                                     <td> 
                                      <input type="hidden" value="9 - TRANSFORMER AND LED LIGHTS" name="group_type[]"> 
                                       <div class="input-group mb-3"> 
                                         <div class="input-group-prepend"> 
                                          <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                           <input type="hidden" name="id[]" value="{{$item->id}}"> 
                                           <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                           </td> 
                                           <td> 
                                             <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                          <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                                         <button onclick="deleteAndRefresh9(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                              <button type="button" onclick="add10()" class="btn btn-primary btn-sm">
                              <i class="fas fa-plus"></i> New Item
                              </button>
                            </div>
                            <div id="collapse10" class="collapse {{ (isset($dumpster)) ? 'show':''}}">
                              <div class="card-body">
                                <table id="tb10" class="table table-bordered" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th style="" scope="col" >Description</th>
                                      <th style="" scope="col" >Quantity</th>
                                      <th style="" scope="col" >Type</th>
                                      <th style="" scope="col" >Unit Price</th>
                                      <th style="" scope="col" >Investment</th>
                                      <th style="text-align: center; width: 18%" scope="col" >Action</th>
                    
                                    </tr>
                                  </thead>
                                  <tbody  id="item_fields10">
                                    @foreach($items as $item)
                                    @if($item->group_type == "10 - DUMPSTER") 
                                    <tr>
                                       <td> 
                                        <input type="hidden" value="10 - DUMPSTER" name="group_type[]"> 
                                         <div class="input-group mb-3"> 
                                           <div class="input-group-prepend"> 
                                            <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                             <input type="hidden" name="id[]" value="{{$item->id}}"> 
                                             <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                             </td> 
                                             <td> 
                                               <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                            <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                                           <button onclick="deleteAndRefresh10(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                                <button type="button" onclick="add11()" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> New Item
                                </button>
                              </div>
                              <div id="collapse11" class="collapse {{ (isset($labor)) ? 'show':''}}" >
                                <div class="card-body">
                                  <table id="tb11" class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                      <tr>
                                        <th style="" scope="col" >Description</th>
                                        <th style="" scope="col" >Quantity</th>
                                        <th style="" scope="col" >Type</th>
                                        <th style="" scope="col" >Unit Price</th>
                                        <th style="" scope="col" >Investment</th>
                                        <th style="text-align: center; width: 18%" scope="col" >Action</th>
                      
                                      </tr>
                                    </thead>
                                    <tbody  id="item_fields11">
                                      @foreach($items as $item)
                                      @if($item->group_type == "11 - LABOR") 
                                      <tr>
                                         <td> 
                                          <input type="hidden" value="11 - LABOR" name="group_type[]"> 
                                           <div class="input-group mb-3"> 
                                             <div class="input-group-prepend"> 
                                              <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                               <input type="hidden" name="id[]" value="{{$item->id}}"> 
                                               <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                               </td> 
                                               <td> 
                                                 <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                              <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                                             <button onclick="deleteAndRefresh11(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                                  <button type="button" onclick="add12()" class="btn btn-primary btn-sm">
                                  <i class="fas fa-plus"></i> New Item
                                  </button>
                                </div>
                                <div id="collapse12" class="collapse {{ (isset($extra)) ? 'show':''}}">
                                  <div class="card-body">
                                    <table id="tb12" class="table table-bordered" width="100%" cellspacing="0">
                                      <thead>
                                        <tr>
                                          <th style="" scope="col" >Description</th>
                                          <th style="" scope="col" >Quantity</th>
                                          <th style="" scope="col" >Type</th>
                                          <th style="" scope="col" >Unit Price</th>
                                          <th style="" scope="col" >Investment</th>
                                          <th style="text-align: center; width: 18%" scope="col" >Action</th>
                        
                                        </tr>
                                      </thead>
                                      <tbody  id="item_fields12">
                                        @foreach($items as $item)
                                        @if($item->group_type == "12 - EXTRA") 
                                        <tr>
                                           <td> 
                                            <input type="hidden" value="12 - EXTRA" name="group_type[]"> 
                                             <div class="input-group mb-3"> 
                                               <div class="input-group-prepend"> 
                                                <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                                 <input type="hidden" name="id[]" value="{{$item->id}}"> 
                                                 <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                                 </td> 
                                                 <td> 
                                                   <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                                <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                                               <button onclick="deleteAndRefresh12(this)" class="btn btn-danger"><i class="fas fa-trash"></i></button>
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
                                    <button type="button" onclick="add13()" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> New Item
                                    </button>
                                  </div>
                                  <div id="collapse13" class="collapse {{ (isset($others)) ? 'show':''}}">
                                    <div class="card-body">
                                      <table id="tb13" class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                          <tr>
                                            <th style="" scope="col" >Description</th>
                                            <th style="" scope="col" >Quantity</th>
                                            <th style="" scope="col" >Type</th>
                                            <th style="" scope="col" >Unit Price</th>
                                            <th style="" scope="col" >Investment</th>
                                            <th style="text-align: center; width: 18%" scope="col" >Action</th>
                          
                                          </tr>
                                        </thead>
                                        <tbody  id="item_fields13">
                                          @foreach($items as $item)
                                          @if($item->group_type == "13 - OTHERS") 
                                          <tr>
                                             <td> 
                                              <input type="hidden" value="13 - OTHERS" name="group_type[]"> 
                                               <div class="input-group mb-3"> 
                                                 <div class="input-group-prepend"> 
                                                  <input type="hidden" id="loopsize" value="{{$loop->count}}"> 
                                                   <input type="hidden" name="id[]" value="{{$item->id}}"> 
                                                   <input type="text" name="description[]" required class="form-control" value="{{$item->description}}" placeholder="Description"/> </div>
                                                   </td> 
                                                   <td> 
                                                     <input id="{{$loop->iteration}}qnt" value="{{$item->quantity}}" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">
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
                                                                 <input type="text" id="{{$loop->iteration}}total" readonly name="investment[]" value="{{$item->investment}}" class="form-control items" placeholder="Investment">
                                                                 </td>
                                                                 <td style="text-align: center;" scope="col">
                                                                  <a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a>
                                                                 <button onclick="deleteAndRefresh13(this)" class="btn btn-danger"><i class="fas fa-trash mr-1"></i></button>
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
          <td >Subtotal</td>
          <td style="text-align: right" scope="col" >
          <input type="text" value="" readonly id="total" name="subtotal"  class="form-control" placeholder="">
          </td>
        </tr>
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
          <input type="text" value="{{$service->total}}" required id="totalwithoutdiscount" name="total" readonly placeholder="Total"   class="form-control">
          </td>
        </tr>
        <tr>
          <td >Accepting Proposal</td>
          <td style="text-align: right"  scope="col" >
            <div class="input-group mb-3">
            <input type="text" value="{{$service->accepting_proposal}}" required name="accepting_proposal" id="accepting_proposal"    class="form-control" placeholder="Accepting Proposal">
              <div class="input-group-append">
                <button onclick="PayDown()" class="btn btn-success" type="button">Get Payment Down</button>
              </div>
            </div>
          </td>
        </tr>
        <tr>
          <td >Down Payment</td>
          <td >
            <input type="text" id="down_payment" value="{{$service->down_payment}}" required name="down_payment"  class="form-control"  placeholder="Payment Down">
          </td>
        </tr>
        <tr>
          <td >Final Balance</td>
          <td>
            <div class="input-group mb-3">
              <input type="text" id="finalbalance" value="{{$service->final_balance}}" onkeypress="return false;" required name="final_balance" class="form-control" placeholder="The final balance will be displayed here" value="" >
              <div class="input-group-append">
                <button onclick="getFinalBalance()" class="btn btn-success" type="button">Get Final Balance</button>
              </div>
            </div>
          </td>
        </tr>

        <tr>
          <td>Notes</td>
          <td style="text-align: center" scope="col" >
            <textarea id="summernote"     
            class="summernote"  name="notes">{!! $service->notes !!}</textarea>
          </td>
        </tr>
      </tbody>
    </table>
    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-check"></i> Save Quote</button>

  </div>
</form>
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
       $('.summernote').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']]
  ]
     });
  });
</script>
@endsection
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
    var new_total = (document.getElementById('total').value) - Number((document.getElementById('discount').value));
    document.getElementById('totalwithoutdiscount').value = new_total.toFixed(2);
  }

  function deleteAndRefresh(button){
    deleteItem(button);
    findTotal();
  }
  function deleteItem(button){
    var empTab = document.getElementById('tb1');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh2(button){
    deleteItem2(button);
    findTotal();
  }
  function deleteItem2(button){
    var empTab = document.getElementById('tb2');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh3(button){
    deleteItem3(button);
    findTotal();
  }
  function deleteItem3(button){
    var empTab = document.getElementById('tb3');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh4(button){
    deleteItem4(button);
    findTotal();
  }
  function deleteItem4(button){
    var empTab = document.getElementById('tb4');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh5(button){
    deleteItem5(button);
    findTotal();
  }
  function deleteItem5(button){
    var empTab = document.getElementById('tb5');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh6(button){
    deleteItem6(button);
    findTotal();
  }
  function deleteItem6(button){
    var empTab = document.getElementById('tb6');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh7(button){
    deleteItem7(button);
    findTotal();
  }
  function deleteItem7(button){
    var empTab = document.getElementById('tb7');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh8(button){
    deleteItem8(button);
    findTotal();
  }
  function deleteItem8(button){
    var empTab = document.getElementById('tb8');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh9(button){
    deleteItem9(button);
    findTotal();
  }
  function deleteItem9(button){
    var empTab = document.getElementById('tb9');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh10(button){
    deleteItem10(button);
    findTotal();
  }
  function deleteItem10(button){
    var empTab = document.getElementById('tb10');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh11(button){
    deleteItem11(button);
    findTotal();
  }
  function deleteItem11(button){
    var empTab = document.getElementById('tb11');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh12(button){
    deleteItem12(button);
    findTotal();
  }
  function deleteItem12(button){
    var empTab = document.getElementById('tb12');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function deleteAndRefresh13(button){
    deleteItem13(button);
    findTotal();
  }
  function deleteItem13(button){
    var empTab = document.getElementById('tb13');
    empTab.deleteRow(button.parentNode.parentNode.rowIndex);
  }
  function add1() {
  item++;
      var objTo = document.getElementById('item_fields')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '  <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control"  placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div><input type="hidden" value="1 - PAVERS" name="group_type[]"/>  </td> <td> <input required type="text" name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td> <td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem1(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse1').collapse("show")
  }
  function add2() {
  item++;
      var objTo = document.getElementById('item_fields2')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div>  </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity"> <div id="'+item+'qntval" class="invalid-feedback">Quantity above 300, check the unit price!</div> <input type="hidden" value="2 - RETAINING WALL" name="group_type[]">  </td> <td> <input required type="text" name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td> <td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem2(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse2').collapse("show")
  }
  function add3() {
    item++;
      var objTo = document.getElementById('item_fields3')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="3 - GRASS" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem3(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse3').collapse("show")

  }
  function add4() {
    item++;
      var objTo = document.getElementById('item_fields4')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="4 - TREES AND PLANTS" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down "></i></a><button onclick="deleteItem4(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse4').collapse("show")

  }
  function add5() {
    item++;
      var objTo = document.getElementById('item_fields5')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="5 - IRRIGATION" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down down"></i></a><button onclick="deleteItem5(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse5').collapse("show")
  }
  function add6() {
    item++;
      var objTo = document.getElementById('item_fields6')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="6 - ROCKS" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem6(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse6').collapse("show")
  }
  function add7() {
    item++;
      var objTo = document.getElementById('item_fields7')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="7 - FIRE PIT" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem7(this)" class="btn btn-danger"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse7').collapse("show")
  }
  function add8() {
    item++;
      var objTo = document.getElementById('item_fields8')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="8 - DRAINAGE" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem8(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse8').collapse("show")
  }
  function add9() {
    item++;
      var objTo = document.getElementById('item_fields9')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="9 - TRANSFORMER AND LED LIGHTS" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem9(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse9').collapse("show")
  }
  function add10() {
    item++;
      var objTo = document.getElementById('item_fields10')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="10 - DUMPSTER" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem10(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse10').collapse("show")
  }
  function add11() {
    item++;
      var objTo = document.getElementById('item_fields11')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="11 - LABOR" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem11(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse11').collapse("show")
  }
  function add12() {
    item++;
      var objTo = document.getElementById('item_fields12')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="12 - EXTRA" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem12(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest)
      $('#collapse12').collapse("show")
  }
  function add13() {
  item++;
      var objTo = document.getElementById('item_fields13')
      var divtest = document.createElement("tr");
      divtest.innerHTML = '<input type="hidden" value="13 - OTHERS" name="group_type[]"> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <input type="hidden" name="id[]" value=""> <input type="text" name="description[]" required class="form-control" value="" placeholder="Description"/> </div> </td> <td> <input id="'+item+'qnt" value="0" onchange="findTotal()" name="qnt[]" type="text" class="form-control" placeholder="Quantity">  </td> <td> <input type="text" required name="type[]" placeholder="" class="form-control"> </td> <td> <div class="input-group mb-3"> <div class="input-group-prepend"> <span class="input-group-text">$</span> </div> <input type="text" value="0" id="'+item+'value" onchange="findTotal()" name="unit_price[]" class="form-control" required placeholder="Unit cost"> </div> </td> <td> <input type="text" id="'+item+'total" readonly name="investment[]" class="form-control items" placeholder="Investment"> </td><td style="text-align: center;" scope="col"><a type="button" onclick="moveUpTable.call(this)" style="color: white"  class="btn btn-primary mr-1"><i class="fas fa-arrow-up"></i></a><a type="button" style="color: white" onclick="moveDownTable.call(this)" class="btn btn-primary mr-1"><i class="fas fa-arrow-down"></i></a><button onclick="deleteItem13(this)" class="btn btn-danger mr-1"><i class="fas fa-trash"/></button></td>';
      objTo.appendChild(divtest);
      $('#collapse13').collapse("show")
  }

  function get_previoussibling(n)
{
    x=n.previousSibling;
    while (x.nodeType!=1)
      {
      x=x.previousSibling;
      }
    return x;
} 

function get_nextsibling(n)
{
    x=n.nextSibling;
    while ( x != null && x.nodeType!=1)
      {
      x=x.nextSibling;
      }
    return x;
} 

  function moveUpTable(){
    var table,
            row = this.parentNode;
        
        while ( row != null ) {
            if ( row.nodeName == 'TR' ) {
                break;
            }
            row = row.parentNode;
        }
        table = row.parentNode;
        table.insertBefore ( row, get_previoussibling( row ) );
  }

  function moveDownTable()
    {
        var table,
            row = this.parentNode;
        
        while ( row != null ) {
            if ( row.nodeName == 'TR' ) {
                break;
            }
            row = row.parentNode;
        }
        table = row.parentNode;
        table.insertBefore ( row, get_nextsibling ( get_nextsibling( row ) ) );
    }

  function findTotal(){
      for(i = 1; i <= item; i++){
        if((document.getElementById(i+"value") != null)|| (document.getElementById(i+"qnt") != null )){
          if(document.getElementById(i+"qntval") != null){

          var x = document.getElementById(i+"qntval");
          if(document.getElementById(i+"qnt").value < 300){
          x.style.display = "block";
        }else{
          x.style.display = "none";
        }
          }
      var value = document.getElementById(i+"value").value;
      var qnt = document.getElementById(i+"qnt").value;
      
      value = value.replace(/[^\d\.\-]/g, ""); 
      qnt = qnt.replace(/[^\d\.\-]/g, ""); 
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
      document.getElementById('total').value = total.toFixed(2);
    }
</script>
@endsection