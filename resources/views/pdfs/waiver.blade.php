<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Unconditional Waiver and Release Upon Final Payment</title>
</head>
<style>
@page {
              margin: 3cm 3cm 0cm 3cm;
              }
              #image {
/* the image you want to 'watermark' */
height: 495px; /* or whatever, equal to the image you want 'watermarked' */
width: 600px; /* as above */
background-position: 0 0;
background-repeat: no-repeat;
position: fixed;
}

#image img {
/* the actual 'watermark' */
position: fixed;
top: 200; /* or whatever */
left: 0; /* or whatever, position according to taste */
opacity: 0.1; /* Firefox, Chrome, Safari, Opera, IE >= 9 (preview) */
}

  </style>
<body>
  <div id="image">
    <img src="https://i.ibb.co/n6SVRQr/Logo-Sun.jpg" alt="..." />
  </div>
  <div style="text-align: center">
          <img  style="height: 35%; width: 35%; position: relative"src="https://i.ibb.co/z7T374Q/Logo-2.jpg" data-holder-rendered="true" />       
</div>
  <h3 style="text-align: center;"><span style="text-decoration: underline;"><strong>Unconditional Waiver and Release Upon Final Payment </strong></span></h3>
<p><strong>Property name: </strong>{{ $data[0]->customer_name}}  </p>
<p><strong>Property location: </strong>{{ $data[0]->address}}, {{ $data[0]->city_name}}, {{ $data[0]->state}} {{ $data[0]->zipcode}} </p>
<p><strong>Invoice/Payment Application Number: </strong> {{ $data[0]->invoice_number}}</p>
@if(isset($newvalue))
<p><strong>Payment amount: </strong>US$ {{number_format($newvalue->total,2)}}</p>
@else
<p><strong>Payment amount: </strong>US$ {{number_format($amount[0]->total,2)}}</p>
@endif
<p><strong>Amount of Disputed Claims: </strong>ZERO</p>
<p style="text-align:
justify">The undersigned has been paid in full for all work, materials and equipment furnished to his
Customer for the above described Property and does hereby waive and release any notice of lien,
any private bond right, any claim for payment and any rights under any similar ordinance, rule or
statute related to payment rights that the undersigned has on the above described Property, except
for the payment of Disputed Claims, if any, noted above. The undersigned warrants that he either
has already paid or will use the money he receives from this final payment promptly to pay in full
all his laborers, subcontractors, material, men and suppliers for all work, materials and equipment
that are subject of this waiver and release.</p>
<p><strong>Dated: </strong> {{\Carbon\Carbon::parse($data[0]->waiver_date)->format('m/d/yy') }}</p>
<br>
<br>
<br>
<div style="text-align: center">
  <img  style="height: 35%; width: 35%; position: absolute; margin-top: -40px; margin-left: 350px" src="https://i.ibb.co/4jY1dHg/signature.png" data-holder-rendered="true" />       
</div>
<p style="text-align: right; margin: 0">__________________________________</p>
<p style="text-align: right; margin: 0">Glaucia Alves, Managing Member</p>
<div style="margin-top: 210px">
<p style="font-size:8.0pt;text-align:center; margin: 0">License # C-18 0080493 Limit Amount $245,000.00 </p>
<p style="font-size:8.0pt;text-align:center;margin: 0">License # C-18 0081661 Limit Amount $245,000.00 </p>
<p style="font-size:8.0pt;text-align:center;margin: 0"> 3183 Ramrod St., Las Vegas, NV 89108 Office &ndash; (702) 202-2882 Fax &ndash; (702) 202-2882</p>
</div>
</body>
</html>