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
    .tg .tg-mim8{border-color:#000000;font-size:12px;text-align:left;vertical-align:top}
    .tg .tg-0ttd{border-color:#000000;font-size:12px;font-weight:bold;text-align:left;vertical-align:top}
    .tg .tg-pwgt{border-color:#000000;font-size:12px;font-weight:bold;text-align:center;vertical-align:top}
    .tg .tg-ai0l{border-color:inherit;font-size:12px;font-weight:bold;text-align:center;vertical-align:top}
    .tg .tg-73a0{border-color:inherit;font-size:12px;text-align:left;vertical-align:top}
    .tg .tg-f4iu{border-color:inherit;font-size:12px;text-align:center;vertical-align:top}
    </style>
    <table class="tg" style="undefined;table-layout: fixed; width: 1022px">
    <colgroup>
    <col style="width: 182px">
    <col style="width: 110px">
    <col style="width: 129px">
    <col style="width: 86px">
    <col style="width: 232px">
    <col style="width: 125px">
    <col style="width: 85px">
    <col style="width: 73px">
    </colgroup>
    <thead>
      <tr>
        <th class="tg-pwgt" style="width: 18%">PO:</th>
        <th class="tg-pwgt" colspan="2"><span style="text-align: center; font-size: 16px; font-weight: bold">{{$data[0]->project_name}}</th>
        <th class="tg-ai0l">Job Name:</th>
        <th class="tg-pwgt" style="width: 25%"><span style="text-align: center; font-size: 16px; font-weight: bold">{{$data[0]->address}}</span></th>
        <th class="tg-pwgt">Seller:</th>
        <th class="tg-0ttd" colspan="2"><span style="text-align: center; font-size: 16px; font-weight: bold">{{$data[0]->sel_name}}</span></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class="tg-pwgt">Name:</td>
        <td class="tg-pwgt" colspan="3"> <span style="text-align: center; font-size: 16px; font-weight: bold">{{$data[0]->customer_name}}</span></td>
        <td class="tg-pwgt">HOA:</td>
        <td class="tg-pwgt"> {{ $data[0]->hoa == 0 ? 'No' : 'Yes'}}</td>
        <td class="tg-pwgt">E-mailed on:</td>
        <td class="tg-73a0"></td>
      </tr>
      <tr>
        <td class="tg-pwgt">Address:</td>
        <td class="tg-pwgt" colspan="3"> <span style="text-align: center; font-size: 13px; font-weight: bold">{{$data[0]->address}}</span> </td>
        <td class="tg-pwgt" colspan="2">Telephone:</td>
        <td class="tg-pwgt" colspan="2" >{{$data[0]->phone}} {{ $data[0]->cellphone == 0 ? '' : '(Cellphone)'}}</td>
      </tr>
      <tr>
        <td class="tg-pwgt">City:</td>
        <td class="tg-mim8" style="font-weight: bold">{{$data[0]->city_name}}</td>
        <td class="tg-pwgt">Zip Code:</td>
        <td class="tg-73a0" style="font-weight: bold">{{$data[0]->zipcode}}</td>
        <td class="tg-pwgt" colspan="4">Notes:</td>
      </tr>
      <tr>
        <td class="tg-pwgt">Gate Code:</td>
        <td class="tg-pwgt" colspan="3">{{$data[0]->gate_code}}</td>
        <td class="tg-pwgt" colspan="4" rowspan="7"></td>
      </tr>
      <tr>
        <td class="tg-pwgt">Phone</td>
        <td class="tg-pwgt" colspan="3">{{$data[0]->phone}} {{ $data[0]->cellphone == 0 ? '' : '(Cellphone)'}}</td>
      </tr>
      <tr>
        <td class="tg-pwgt">E-mail:</td>
        <td class="tg-pwgt" colspan="3" style="font-weight: bold">{{$data[0]->email}}</td>
      </tr>
      <tr>
        <td class="tg-pwgt">Cross Streets:</td>
        <td class="tg-pwgt" colspan="3" style="font-weight: bold">{{$data[0]->cross_street1}} / {{$data[0]->cross_street2}}</td>
      </tr>
      <tr>
        <td class="tg-pwgt">Start Date:</td>
        <td class="tg-pwgt" colspan="3"></td>
      </tr>
      <tr>
        <td class="tg-pwgt">Parcel #</td>
        <td class="tg-pwgt" colspan="3" style="font-weight: bold">{{$data[0]->parcel_number}}</td>
      </tr>
      <tr>
        <td class="tg-pwgt">Referral:</td>
        <td class="tg-pwgt" colspan="3">{{$data[0]->ref_name}}</td>
      </tr>
      <tr>
        <td class="tg-pwgt">Project Drawing:</td>
        <td class="tg-pwgt">2D / 3D</td>
        <td class="tg-pwgt">Paid</td>
        <td class="tg-ai0l">Date</td>
        <td class="tg-ai0l">Amount</td>
        <td class="tg-ai0l">Check</td>
        <td class="tg-ai0l">CC</td>
        <td class="tg-ai0l">Value</td>
      </tr>
      <tr>
        <td class="tg-pwgt">Sold:</td>
        <td class="tg-pwgt"></td>
        <td class="tg-pwgt">Security Deposit:</td>
        <td class="tg-pwgt"></td>
        <td class="tg-pwgt"></td>
        <td class="tg-0ttd">#</td>
        <td class="tg-mim8"></td>
        <td class="tg-pwgt"></td>
      </tr>
      <tr>
        <td class="tg-pwgt">HOA Paperwork:</td>
        <td class="tg-pwgt"></td>
        <td class="tg-pwgt">Downpayment:</td>
        <td class="tg-pwgt"></td>
        <td class="tg-pwgt"></td>
        <td class="tg-0ttd">#</td>
        <td class="tg-mim8"></td>
        <td class="tg-pwgt"></td>
      </tr>
      <tr>
        <td class="tg-pwgt">Material List:</td>
        <td class="tg-pwgt"></td>
        <td class="tg-pwgt">Balance:</td>
        <td class="tg-pwgt"></td>
        <td class="tg-pwgt"></td>
        <td class="tg-0ttd">#</td>
        <td class="tg-mim8"></td>
        <td class="tg-pwgt"></td>
      </tr>
      <tr>
        <td class="tg-pwgt">Contractos Board PWW</td>
        <td class="tg-pwgt"></td>
        <td class="tg-pwgt">Final Balance</td>
        <td class="tg-pwgt"></td>
        <td class="tg-pwgt"></td>
        <td class="tg-0ttd">#</td>
        <td class="tg-mim8"></td>
        <td class="tg-pwgt"></td>
      </tr>
      <tr>
        <td class="tg-pwgt">Unconditional Waiver Release</td>
        <td class="tg-pwgt"></td>
        <td class="tg-0ttd" style="text-align: center">Notes:</td>
        <td class="tg-ai0l" colspan="5"></td>
      </tr>
    </tbody>
    </table>
</body>
</html>