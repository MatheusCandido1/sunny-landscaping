<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Project Frontpage</title>
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
        <th class="tg-k27y"> <span style="text-align: center; font-size: 13px; font-weight: bold">PO:</span></th>
        <th class="tg-k27y" colspan="2"><span style="text-align: center; font-size: 16px; font-weight: bold">{{$data[0]->project_name}}</span></th>
        <th class="tg-k27y">Job Name:</th>
      <th class="tg-k27y" colspan="5"> <span style="text-align: center; font-size: 16px; font-weight: bold">{{$data[0]->address}}</span></th>
        <th class="tg-k27y">Seller:</th>
        <th class="tg-k27y" ><span style="text-align: center; font-size: 13px; font-weight: bold">{{$data[0]->sel_name}}</span></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Name:</span></td>
      <td class="tg-k27y" colspan="3"> <span style="text-align: center; font-size: 16px; font-weight: bold">{{$data[0]->customer_name}}</span></td>
        <td class="tg-k27y">HOA</td>
      <td class="tg-k27y" style="width: 10%"> {{ $data[0]->hoa == 0 ? '( ) Yes / (x) No' : '(x) Yes / ( ) No'}} </td>
        <td class="tg-k27y" colspan="5"></td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Address:</span></td>
      <td class="tg-k27y" colspan="3"><span style="text-align: center; font-size: 16px; font-weight: bold">{{$data[0]->address}}</span></td>
        <td class="tg-k27y">E-mailed on:</td>
        <td class="tg-k27y">__/__/____</td>
        <td class="tg-k27y" colspan="5"></td>
      </tr>
       <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">City:</span></td>
        <td class="tg-k27y">{{$data[0]->city_name}}</td>
        <td class="tg-u5dg" style="text-align: center">Zip Code:</td>
        <td class="tg-k27y"> <span style="text-align: center; font-size: 13px; font-weight: bold">{{$data[0]->zipcode}}</span></td>
        <td class="tg-k27y" colspan="7">Notes:</td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Gate Code:</span></td>
        <td class="tg-k27y" colspan="3">{{$data[0]->gate_code}}</td>
        <td class="tg-k27y" colspan="7" rowspan="7"></td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">E-mail:</span></td>
        <td class="tg-k27y" colspan="3">{{$data[0]->email}}</td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Cross Streets:</span></td>
        <td class="tg-k27y" colspan="3">{{$data[0]->cross_street1}} / {{$data[0]->cross_street2}}</td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Start Date:</span></td>
        <td class="tg-k27y" colspan="3"></td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Parcel #:</span></td>
        <td class="tg-k27y" colspan="3">{{$data[0]->parcel_number}}</td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Referral:</span></td>
        <td class="tg-k27y" colspan="3">{{$data[0]->ref_name}}</td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Project Drawing:</span></td>
        <td class="tg-k27y">2D / 3D</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Sold:</span></td>
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
        <td class="tg-k27y" style="width: 20%"><span style="text-align: center; font-size: 13px; font-weight: bold">HOA Paperwork:</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y" style="width: 15%">Security Deposit:</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Check</td>
        <td class="tg-w2dt">#________</td>
        <td class="tg-k27y"><span style="font-weight:bold">CC</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">$</td>
        <td class="tg-rykj"></td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Material List:</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Downpayment:</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Check</td>
        <td class="tg-w2dt">#________</td>
        <td class="tg-k27y"><span style="font-weight:bold">CC</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">$</td>
        <td class="tg-rykj"></td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Contractor's Board PWW:</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Balance:</td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">Check</td>
        <td class="tg-w2dt">#________</td>
        <td class="tg-k27y"><span style="font-weight:bold">CC</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-k27y">$</td>
        <td class="tg-rykj"></td>
      </tr>
      <tr>
        <td class="tg-k27y"><span style="text-align: center; font-size: 13px; font-weight: bold">Unconditional Waiver Release:</span></td>
        <td class="tg-k27y"></td>
        <td class="tg-u5dg" colspan="9">Notes:</td>
      </tr>
    </tbody>
    </table>
</body>
</html>