<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <style type="text/css">
    .tg  {border-collapse:collapse;border-spacing:0;}
    .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
      font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
    .tg .tg-w2dt{font-size:12px;text-align:center;vertical-align:middle}
    .tg .tg-rykj{font-size:12px;text-align:left;vertical-align:middle}
    .tg .tg-u5dg{font-size:12px;font-weight:bold;text-align:left;vertical-align:middle}
    .tg .tg-k27y{font-size:12px;font-weight:bold;text-align:center;vertical-align:middle}
    </style>
    <table class="tg" style="undefined;table-layout: fixed; width: 1039px">
    <colgroup>
    <col style="width: 197px">
    <col style="width: 82px">
    <col style="width: 130px">
    <col style="width: 147px">
    <col style="width: 184px">
    <col style="width: 103px">
    <col style="width: 91px">
    <col style="width: 33px">
    <col style="width: 27px">
    <col style="width: 24px">
    <col style="width: 21px">
    </colgroup>
    <thead>
      <tr>
        <th class="tg-k27y">PO:</th>
        <th class="tg-k27y">S2020 - </th>
        <th class="tg-k27y"></th>
        <th class="tg-k27y">Job Name:</th>
      <th class="tg-k27y"> {{$data[0]->visit_name}}</th>
        <th class="tg-k27y">Seller:</th>
        <th class="tg-u5dg" colspan="5">{{$data[0]->sel_name}}</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="tg-k27y">Name:</td>
      <td class="tg-k27y" colspan="3">{{$data[0]->customer_name}}</td>
        <td class="tg-k27y">HOA</td>
      <td class="tg-k27y"> {{ $data[0]->hoa == 0 ? '( ) Yes / (x) No' : '(x) Yes / ( ) No'}} </td>
        <td class="tg-k27y" colspan="5"></td>
      </tr>
      <tr>
        <td class="tg-k27y">Address:</td>
      <td class="tg-k27y" colspan="3">{{$data[0]->address}}</td>
        <td class="tg-k27y">E-mailed on:</td>
        <td class="tg-k27y">__/__/____</td>
        <td class="tg-k27y" colspan="5"></td>
      </tr>
       <tr>
        <td class="tg-k27y">City:</td>
        <td class="tg-k27y">{{$data[0]->city_name}}</td>
        <td class="tg-u5dg">Zip Code:</td>
        <td class="tg-k27y">{{$data[0]->zipcode}}</td>
        <td class="tg-k27y" colspan="7">Notes:</td>
      </tr>
      <tr>
        <td class="tg-k27y">Gate Code:</td>
        <td class="tg-k27y" colspan="3">{{$data[0]->gate_code}}</td>
        <td class="tg-k27y" colspan="7" rowspan="7"></td>
      </tr>
      <tr>
        <td class="tg-k27y">Home #:</td>
        <td class="tg-k27y" colspan="3"></td>
      </tr>
      <tr>
        <td class="tg-k27y">E-mail:</td>
        <td class="tg-k27y" colspan="3">{{$data[0]->email}}</td>
      </tr>
      <tr>
        <td class="tg-k27y">Cross Streets:</td>
        <td class="tg-k27y" colspan="3">{{$data[0]->cross_street1}} / {{$data[0]->cross_street2}}</td>
      </tr>
      <tr>
        <td class="tg-k27y">Start Date:</td>
        <td class="tg-k27y" colspan="3"></td>
      </tr>
      <tr>
        <td class="tg-k27y">Parcel #</td>
        <td class="tg-k27y" colspan="3">{{$data[0]->parcel_number}}</td>
      </tr>
      <tr>
        <td class="tg-k27y">Referral:</td>
        <td class="tg-k27y" colspan="3">{{$data[0]->ref_name}}</td>
      </tr>
      <tr>
        <td class="tg-k27y">Project Drawing:</td>
        <td class="tg-k27y">2D / 3D</td>
        <td class="tg-k27y" colspan="9"></td>
      </tr>
      <tr>
        <td class="tg-k27y">Sold:</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Date</td>
        <td class="tg-k27y">Amount</td>
        <td class="tg-k27y"></td>
        <td class="tg-w2dt"></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
        <td class="tg-rykj"></td>
      </tr>
      <tr>
        <td class="tg-k27y">HOA Paperwork:</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Security Deposit:</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Check</td>
        <td class="tg-w2dt">#__________</td>
        <td class="tg-k27y"><span style="font-weight:bold">CC</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">$</td>
        <td class="tg-rykj"></td>
      </tr>
      <tr>
        <td class="tg-k27y">Material List:</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Downpayment:</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Check</td>
        <td class="tg-w2dt">#__________</td>
        <td class="tg-k27y"><span style="font-weight:bold">CC</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">$</td>
        <td class="tg-rykj"></td>
      </tr>
      <tr>
        <td class="tg-k27y">Contractos Board PWW</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Balance:</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Check</td>
        <td class="tg-w2dt">#__________</td>
        <td class="tg-k27y"><span style="font-weight:bold">CC</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">$</td>
        <td class="tg-rykj"></td>
      </tr>
      <tr>
        <td class="tg-k27y">Unconditional Waiver Release</td>
        <td class="tg-k27y"></td>
        <td class="tg-u5dg" colspan="9">Notes:</td>
      </tr>
    </tbody>
    </table>
</body>
</html>