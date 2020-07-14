<html>

<head>
  <title>Proposal - {{$data[0]->name}}</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=Generator content="Microsoft Word 15 (filtered)">
<style>
  @page {
              margin: 2.5cm 2.5cm 0cm 2.5cm;
              }
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Georgia;
	panose-1:2 4 5 2 5 4 5 2 3 3;}
@font-face
	{font-family:"Book Antiqua";
	panose-1:2 4 6 2 5 3 5 3 3 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:0in;
	line-height:120%;
	font-size:9.5pt;
	font-family:"Book Antiqua",serif;
	color:#595959;}
.MsoChpDefault
	{font-size:9.5pt;
	font-family:"Book Antiqua",serif;
	color:#595959;}
.MsoPapDefault
	{margin-bottom:10.0pt;
	line-height:120%;}
 /* Page Definitions */
 @page WordSection1
	{size:8.5in 11.0in;
	margin:49.5pt 1.0in 40.5pt 1.25in;}
div.WordSection1
	{page:WordSection1;}
  #image {
/* the image you want to 'watermark' */
height: 495px; /* or whatever, equal to the image you want 'watermarked' */
width: 600px; /* as above */
background-position: 0 0;
background-repeat: no-repeat;
position: absolute;
}

#image img {
/* the actual 'watermark' */
position: absolute;
top: 200; /* or whatever */
left: 0; /* or whatever, position according to taste */
opacity: 0.2; /* Firefox, Chrome, Safari, Opera, IE >= 9 (preview) */
}

  
</style>

</head>

<body lang=EN-US>
<div class=WordSection1>
  <div id="image">
    <img src="https://i.ibb.co/n6SVRQr/Logo-Sun.jpg" alt="..." />
  </div>

<p class=MsoNormal align=right style='margin-bottom:12.0pt;text-align:right;
border:none'>

<table class=2 border=0 cellspacing=0 cellpadding=0 width=400 style='border-collapse:
 collapse'>
 <tr style='height:112.5pt'>
  <td width=24 style='width:17.8pt;background:#EBEBEB;padding:0in 0in 0in 0in;
  height:112.5pt'>
  <p class=MsoNormal>&nbsp;</p>
  </td>
  <td width=604 style='width:452.7pt;background:#EBEBEB;padding:0in 0in 0in 0in;
  height:112.5pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  90%;border:none'><span style='font-size:20.0pt;line-height:90%;color:#11826D'>Sunny
  Landscaping &amp; Pavers Design LLC</span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  110%;border:none'><span style='font-size:10.0pt;line-height:110%'>3183 Ramrod
  St.,</span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  110%;border:none'><span style='font-size:10.0pt;line-height:110%'>Las Vegas,
  NV 89108</span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  110%;border:none'><span style='font-size:10.0pt;line-height:110%'>Cell: (702)
  445-8948</span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  110%;border:none'><span style='font-size:10.0pt;line-height:110%'>Phone/Fax:
  (702) 202-2882</span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  110%;border:none'><span style='font-size:10.0pt;line-height:110%'>License #
  NV20151085480         C-18 # 0080493 – Limit: $245,000  /  C-10 # 0081661 –
  Limit: $245,000</span></p>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  110%;border:none'><span style='font-size:10.0pt;line-height:110%'>LICENSED                      
  -                               BONDED                                
  -                          INSURED</span></p>
  </td>
  <td width=1 style='width:1.0pt;padding:0in 0in 0in 0in;height:112.5pt'>
  <p class=MsoNormal>&nbsp;</p>
  </td>
  <td width=13 style='width:10.05pt;padding:0in 0in 0in 0in;height:112.5pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  90%;border:none'><span style='font-size:14.0pt;line-height:90%;color:#11826D'>&nbsp;</span></p>
  </td>
  <td width=67 style='width:50.25pt;padding:0in 0in 0in 0in;height:112.5pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  90%;border:none'><span style='font-size:14.0pt;line-height:90%;color:#11826D'>&nbsp;</span></p>
  </td>
 </tr>
</table>
<br><br>
<p class=MsoNormal align=right style='font-size:12;margin-bottom:12.0pt;text-align:right;
border:none'><span >{{ \Carbon\Carbon::parse($data[0]->proposal_date)->format('F d, Y')}} </span></p>
<br><br>
@if ($data[0]->company == 1)
<p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><b><span
  style='font-size:12.0pt;line-height:120%;'>{{$data[0]->company_name}}</span></b></p>
  <p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><b><span
    style='font-size:12.0pt;line-height:120%;'>{{$data[0]->name}}</span></b></p>
  <p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><span
    style='font-size:12.0pt;line-height:120%;'>{{$data[0]->company_address}}</span></p>
<p class=MsoNormal style='ffont-size:12;ont-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><span
  style='font-size:12.0pt;line-height:120%;'>{{$data[0]->company_city}},{{$data[0]->company_state}} - {{$data[0]->company_zipcode}}</span></p>
  @else
<p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><b><span
style='font-size:12.0pt;line-height:120%;'>{{$data[0]->name}}</span></b></p>
<p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><span
style='font-size:12.0pt;line-height:120%;'>{{$data[0]->address}}</span></p>
<p class=MsoNormal style='ffont-size:12;ont-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><span
style='font-size:12.0pt;line-height:120%;'>{{$data[0]->city}},{{$data[0]->state}} - {{$data[0]->zipcode}}</span></p>
@endif
<p class=MsoNormal style='margin-bottom:24.0pt;border:none'>
@if($data[0]->cellphone == 1)
<span style='font-size:12.0pt;line-height:120%;'>Cellphone: {{$data[0]->phone}}</span></p>
@else
<span style='font-size:12.0pt;line-height:120%;'>Phone: {{$data[0]->phone}}</span></p>
@endif

<p class=MsoNormal style="font-size:12;">Dear <span >{{$data[0]->name}},</span></p>

<p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;text-align:
justify'>Thank you for choosing Sunny Landscaping &amp; Pavers Design LLC for
your home’s landscaping improvement. The <b>anticipated value</b> of investment to install pavers and
improve your landscaping is estimated in <b>US$ <span>{{number_format($data[0]->total,2)}}</span></b>
<b>(materials and labor, tax included).</b> Please sign below with your acceptance of this quotation and we will
begin working on your property as soon as possible. Any changes will have a
Change Order for approval and will add/deduct from the amount described above.
A US$500.00 non-refundable fee will be due upon signature. The same amount
(US$500.00) will be deducted from the total cost by the end of the project.
If you have any questions, please do not hesitate to contact us.
Again, thank you for choosing Sunny Landscaping &amp; Pavers Design LLC.</p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
justify'>&nbsp;</p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
justify'>&nbsp;</p>

<p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;text-align:
justify'>Best regards,</p>


<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
justify'>&nbsp;</p>

<p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;text-align:
justify'>&nbsp;</p>
<br>
<br>

<br>

<br>
<div style="text-align: center">
  <img  style="height: 35%; width: 35%; position: absolute; margin-top: -60px; margin-left: -60px" src="https://i.ibb.co/4jY1dHg/signature.png" data-holder-rendered="true" />       
</div>
<p class=MsoNormal style='margin-bottom:0;margin-bottom:.0001pt;line-height:
normal;border:none'><span style='font-size:16.0pt'>Glaucia Alves</span> </p>

<p class=MsoNormal style='font-size:12.0pt;margin-bottom:0in;margin-bottom:.0001pt;line-height:
normal;border:none'>Sunny Landscaping &amp; Pavers Design LLC</p>

<br>

<table class=1 border=1 cellspacing=0 cellpadding=0 width=384 style='margin-left:
 148.25pt;border-collapse:collapse;border:none'>
 <tr>
  <td width=108 valign=top style='width:81.25pt;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:3.75pt;margin-bottom:.0001pt;line-height:120%;border:none'>Accepted
  on:</p>
  </td>
  <td width=275 valign=top style='width:206.5pt;border:none;border-bottom:solid black 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:3.75pt;margin-bottom:.0001pt;line-height:120%;border:none'>&nbsp;</p>
  </td>
 </tr>
 <tr>
  <td width=108 valign=top style='width:81.25pt;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;margin-bottom:.0001pt;line-height:
  120%;border:none'>&nbsp;</p>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:3.75pt;margin-bottom:.0001pt;line-height:120%;border:none'>Customer’s
  Signature:</p>
  </td>
  <td width=275 valign=top style='width:206.5pt;border:none;border-bottom:solid black 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-top:0in;margin-right:0in;margin-bottom:0in;
  margin-left:3.75pt;margin-bottom:.0001pt;line-height:120%;border:none'>&nbsp;</p>
  </td>
 </tr>
</table>
<br>
<br>
<br>
<br>
<br>
<br>
<p class=MsoNormal align=center style='margin-top: 0px;
text-align:center;line-height:normal'><span lang=EN-US style='font-size:8.0pt'>We
accept cash, check and credit card. For payments with credit card, will be
added a 3% processing fee. Prices are valid for 60 days after the date of
proposal, and are subject to change after that period due to raw materials or
labor costs.<o:p></o:p></span></p>
</div>

</body>

</html>