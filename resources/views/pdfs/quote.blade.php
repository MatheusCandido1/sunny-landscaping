<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <title>Document</title>
</head>
<style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}

  
</style>
<body>
  <div class="container-fluid">
  <h1>Quote Information</h1>
  <div class="row">
    <div class="col-xs-6">
        <p class="">{{$costumerData->costumer_name}}</p>
        <p class="">{{$costumerData->email}}</p>
    <p class="">{{$costumerData->address}}</p>
    <p> {{$costumerData->city}}, {{$costumerData->state}} - {{$costumerData->zipcode}}</p> </p>
    </div>
    <div class="col-xs-6">
      <p class="">{{$costumerData->costumer_name}}</p>
      <p class="">{{$costumerData->email}}</p>
  <p class="">{{$costumerData->address}}</p>
  <p> {{$costumerData->city}}, {{$costumerData->state}} - {{$costumerData->zipcode}}</p> </p>
  </div>
    <!--/col-->
</div>
  <br>
  <div class="row">
    <div class="col-xs-12">
      <table class="table" width="">
        <thead>
          <tr>
            <th style="" scope="col" >Supplier</th>
            <th style="" scope="col" >Description</th>
            <th style="" scope="col" >Quantity</th>
            <th style="" scope="col" >Type</th>
            <th style="" scope="col" >Unit Price</th>
            <th style="" scope="col" >Investment</th>
          </tr>
        </thead>
        <tbody>
          @foreach($itemData as $item)
          <tr>
            <td>{{$item->supplier}} </td>
            <td>{{$item->description}} </td>
            <td>{{$item->quantity}} </td>
            <td>{{$item->type}} </td>
            <td>$ {{number_format($item->unit_price,2)}} </td>
            <td>$ {{number_format($item->investment,2)}}</td>
          </tr>
          @endforeach
          <tr>
            <td class="thick-line"></td>
            <td class="thick-line"></td>
            <td class="thick-line"></td>
            <td class="thick-line"></td>
            <td class="thick-line"></td>
            <td class="thick-line"></td>
          </tr>
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center"><strong>Total</strong></td>
            <td class="no-line text-right">$ {{number_format($serviceData->total,2)}}</td>
          </tr>
          @if($serviceData->discount == 0)
          @else
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center"><strong>Discount</strong></td>
            <td class="no-line text-right">$ {{number_format($serviceData->discount,2)}}</td>
          </tr>
          @endif
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center" style="width:140px" ><strong>Accepting Proposal</strong></td>
            <td class="no-line text-right">$ {{number_format($serviceData->accepting_proposal,2)}}</td>
          </tr>
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center" ><strong>Down Payment</strong></td>
            <td class="no-line text-right">$ {{number_format($serviceData->down_payment,2)}}</td>
          </tr>
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="thick-line text-center"><strong>Final Balance</strong></td>
            <td class="thick-line text-right">$ {{number_format($serviceData->final_balance,2)}}</td>
          </tr>
          
        </tbody>
      </table>
    </div>
  </div>
 
</body>
</html>