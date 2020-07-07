<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Estimate Request</title>
</head>
<body>
  <div style="text-align: center">
  <h3><span class="text-center" style="font-weight: 400;"><strong>ESTIMATE REQUEST</strong></span></h3>
  </div>
  <div style="text-align: left">
  <p><span style="font-weight: 400;"><strong>Date:</strong> {{ \Carbon\Carbon::parse($data[0]->date)->format('l, jS \\of F Y')}}&nbsp;</span></p>
  <p><span style="font-weight: 400;"><strong>Time:</strong> {{ \Carbon\Carbon::parse($data[0]->date)->format('h:i:s A')}} - {{ \Carbon\Carbon::parse($data[0]->date)->addHours(1)->addMinutes(30)->format('h:i:s A')}}&nbsp;</span></p>

  <p><span style="font-weight: 400;"><strong>Call Customer in:</strong> {{$data[0]->call_customer_in}} min.&nbsp;</span></p>
  <p><strong>HOA: </strong><span style="font-weight: 400;"> {{ $data[0]->hoa == 0 ? 'No' : 'Yes'}} &nbsp;</span></p>
  <p><span style="font-weight: 400;"><strong>Water Smart Rebate:</strong> {{ $data[0]->water_smart_rebate == 0 ? 'No' : 'Yes'}} &nbsp;</span></p>
  <p><span style="font-weight: 400;"><strong>Cross Streets:</strong> {{ $data[0]->cross_street1}}/{{ $data[0]->cross_street2}}</span></p>
  <p><span style="font-weight: 400;"><strong>Mrs: </strong></span><span style="font-weight: 400;">{{ $data[0]->customer_name}}&nbsp;</span></p>
  <p><span style="font-weight: 400;"><strong>Address: </strong>{{ $data[0]->address}}, {{ $data[0]->city_name}}, {{ $data[0]->state}} {{ $data[0]->zipcode}} </span></p>
  <p><span style="font-weight: 400;"><strong>Gate Code: </strong> {{ $data[0]->gate_code == "" ? 'No' : $data[0]->gate_code}}</span></p>
  <p><span style="font-weight: 400;"><strong>Phone #  </strong></span><span style="font-weight: 400;">{{ $data[0]->phone}}</span><span style="font-weight: 400;"><strong> Cell Phone: </strong> {{ $data[0]->cellphone == 0 ? '(No)' : '(Yes)'}}&nbsp;</span></p>
  <p><span style="font-weight: 400;"><strong>Email:  </strong>{{ $data[0]->email}} &nbsp;</span></p>
  <p><span style="font-weight: 400;"><strong>Referred: </strong> {{ $data[0]->ref_name }}&nbsp;</span></p>
  <p><span style="font-weight: 400;"><strong>Type: </strong> &nbsp;</span></p>
  </div>
</body>
</html>