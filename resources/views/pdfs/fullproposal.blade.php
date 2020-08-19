<html>

<head>
  <title>Proposal - {{$data[0]->name}}</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">


<meta name=Generator content="Microsoft Word 15 (filtered)">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<style>
  @page {
              margin: 15px 15px 15px 15px;
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
opacity: 0.1; /* Firefox, Chrome, Safari, Opera, IE >= 9 (preview) */
}

body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

.page_break { page-break-before: always; }

.company-details {
              margin-left: 200px;
            }

            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
    border-bottom: 1px solid #f5a15c
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0px; 
                left: 0px; 
                right: 0px;
                height: 50px; 
                text-align: center;
                color: #777;
                border-top: 1px solid #f5a15c;
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

#notes p {
  line-height: 10px;
}

tbody:before, tbody:after { display: none; }
table {
    border-collapse: collapse;
}
</style>

</head>

<body lang=EN-US>
  <header>
    <div class="row">
      <div class="col">
          <a target="_blank" href="https://sunnypavers.com">
            <img  style="margin-left: 25px; height: 110px; width: 106px; position: fixed"src="https://i.ibb.co/z7T374Q/Logo-2.jpg" data-holder-rendered="true" />
          </a>
      </div>
      <div class="col company-details">
        <div class="row">  
          <div style="margin-left: -25px;" class="col-xs-6" >
            <div>&nbsp;</div>
        <div>{{$info->address}}</div>
        <div>{{$info->address2}}</div>
        <div>{{$info->phone1}}</div>
        <div>{{$info->phone2}}</div>

          </div>
        
        
          <div class="col-xs-6" style="width: 100%; margin-left: -175px" >
            <div>&nbsp;</div>
          <div>NV State Business License # NV20151085480</div>
          <div>NV State Contractor's Board Licenses:    </div>
          <div>C-18 # 0080493 - Limit: $245,000 / C-10 # 0081661 - Limit: $245,000</div>
        </div>
        </div>
      </div>
  </div>
  </header>

  <footer>
    Invoice was created on a computer and is valid without the signature and seal.
  </footer>
<div class=WordSection1>
  <div id="image">
    <img src="https://i.ibb.co/n6SVRQr/Logo-Sun.jpg" alt="..." />
  </div>
<p class=MsoNormal align=right style='font-size:12;margin-bottom:16.0pt;text-align:right;
border:none'><span > {{ \Carbon\Carbon::parse($data[0]->proposal_date)->format('F d, Y')}} </span></p>
<br><br>
@if ($data[0]->company == 1)
<p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><b><span
  style='font-size:12.0pt;line-height:120%;'>{{$data[0]->company_name}}</span></b></p>
  <p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><b><span
    style='font-size:12.0pt;line-height:120%;'>{{$data[0]->name}}</span></b></p>
  <p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><span
    style='font-size:12.0pt;line-height:120%;'>{{$data[0]->company_address}}</span></p>
<p class=MsoNormal style='ffont-size:12;ont-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><span
  style='font-size:12.0pt;line-height:120%;'>{{$data[0]->company_city}}, {{$data[0]->company_state}} {{$data[0]->company_zipcode}}</span></p>
  @else
<p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><b><span
style='font-size:12.0pt;line-height:120%;'>{{$data[0]->name }}</span></b></p>
<p class=MsoNormal style='font-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><span
style='font-size:12.0pt;line-height:120%;'>{{$data[0]->address}}</span></p>
<p class=MsoNormal style='ffont-size:12;ont-size:12;margin-bottom:0in;margin-bottom:.0001pt;border:none'><span
style='font-size:12.0pt;line-height:120%;'>{{$data[0]->city}}, {{$data[0]->state}} {{$data[0]->zipcode}}</span></p>
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
improve your landscaping is estimated in <b>US$ <span>{{number_format($amount[0]->total,2)}}</span></b>
<b> {{$data[0]->options}}</b> Please sign below with your acceptance of this quotation and we will
begin working on your property as soon as possible. Any changes will have a
Change Order for approval and will add/deduct from the amount described above.
A US${{number_format($data[0]->security_deposit,2)}} non-refundable fee will be due upon signature. The same amount
(US${{number_format($data[0]->security_deposit,2)}}) will be deducted from the total cost by the end of the project.
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
</div>
<div class="page_break"></div>
@foreach($itemData as $service=>$quote)
<main>
  <div id="image">
    <img src="https://i.ibb.co/n6SVRQr/Logo-Sun.jpg" alt="..." />
  </div>
  <div class="row contacts">
    <div style="text-align: right">
     </div>
    <div style="text-align: left" class="col invoice-to">
      <div class="row">
        <div class="col-xs-6">
            <h3 class="to">{{$customer->customer_name}}</h3>
        </div>
        <div class="col-xs-6">
          <h3 class="to">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quote number: {{$service}}</h3>

        </div>
      </div>
        <div class="address">{{$customer->address}}</div>
        <div class="address">{{$customer->city_name}}, {{$customer->state}} {{$customer->zipcode}}</div>
        <div class="email">{{$customer->email}}</div>
        <div class="email">Phone: {{$customer->phone}}</div>
    </div>
    <div style="text-align: right" class="col invoice-details">
        <div class="date">Date: {{ date('m/d/Y') }}</div>
    </div>
</div>
@foreach($quote as $group_type => $items)
<div style="page-break-inside: avoid; line-height: 10px"> 
  <table class="table">
  @if($loop->first)
  <thead>
    <tr>
      <th  style="text-align: left; line-height: 5px; width: 40%;"  >Description</th>
      <th  style="line-height: 1px; width: 20%;"  >Quantity</th>
      <th  style="line-height: 1px; width: 20%;"  >Unit Price</th>
      <th  style="text-align: right;line-height: 1px; width: 20%;" >Investment</th>
    </tr>
  </thead>
  @endif
  </table>
<h4 style="line-height: 5px">{{$group_type}} </h4>
<table  class="table" width="" class="table">
 
  <tbody>
    @foreach($items as $item)
    <tr style="line-height: 0px">
      <td style="width: 40%;line-height: 12px; color: black">{{$item->description}} </td>
      <td style="width: 20%;line-height: 12px; color: black">{{$item->quantity}} {{$item->type}} </td>
      <td style="width: 20%;line-height: 12px; color: black">$ {{number_format($item->unit_price,2)}} </td>
      <td style="width: 20%;line-height: 12px; text-align: right; color: black">$ {{number_format($item->investment,2)}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endforeach

@foreach ($serviceData as $value)

<div id="image">
  <img src="https://i.ibb.co/n6SVRQr/Logo-Sun.jpg" alt="..." />
</div>
          @if($value->service_id == $service)
          <table style="page-break-inside: avoid; margin-top: 0px" class="table" width="">
            <tr>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line" style="line-height: 5px"></td>
              <td class="no-line" style="line-height: 5px"></td>
            </tr>
            @if($value->discount > 0)
            <tr>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line text-center" style="line-height: 5px"><strong>Subtotal</strong></td>
              <td class="no-line text-right" style="line-height: 5px">$ {{number_format($value->subtotal,2)}}</td>
            </tr>
            <tr>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line text-center" style="line-height: 5px"><strong>Discount</strong></td>
              <td class="no-line text-right" style="line-height: 5px">$ {{(number_format($value->discount,2))}}</td>
            </tr>
            <tr>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="thick-line text-center" style="line-height: 10px"><strong>Total</strong></td>
              <td class="thick-line text-right" style="line-height: 10px"><span style="font-weight: bold">$ {{number_format($value->total,2)}} </span></td>
            </tr>
            @else
            <tr>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line text-center" style="line-height: 10px"><strong>Total</strong></td>
              <td class="no-line text-right" style="line-height: 10px">$ {{number_format($value->total,2)}}</td>
            </tr>
            @endif
            <tr>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="thick-line text-center" style="width:140px; line-height: 5px" ><strong>Accepting Proposal</strong></td>
              <td class="thick-line text-right" style="line-height: 5px">$ {{number_format($value->accepting_proposal,2)}}</td>
            </tr>
            @if($value->down_payment > 0)
            <tr>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line text-center" style="line-height: 5px"><strong>Down Payment</strong></td>
              <td class="no-line text-right" style="line-height: 5px">$ {{number_format($value->down_payment,2)}}</td>
            </tr>
            @endif
            <tr>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line"></td>
              <td class="no-line text-center" style="line-height: 5px"><strong>Final Balance</strong></td>
              <td class="no-line text-right" style="line-height: 5px">$ {{number_format($value->final_balance,2)}}</td>
            </tr>
          </tbody>
        </table>
     @if($value->notes != "")
<div id="notes" class="col-xs-12"><p style="line-height: 12px; font-size: 12px">Notes:</p> {!! $value->notes !!}</div>
@endif
@endif
@endforeach
</main>
@if(!($loop->last))
  <div class="page_break"></div>
  @endif
@endforeach
</body>

</html>
