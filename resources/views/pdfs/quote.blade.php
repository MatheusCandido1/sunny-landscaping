<html>
    <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  <title>Quote - {{$customer->customer_name}}'s</title>
        <style>
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
              margin: 15px 15px 15px 15px;
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

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
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

            header .company-details {
              margin-left: 350px;
            }

            .notices {
  position: fixed; 
  bottom: 190px; 
                left: 30px; 
                right: 0px;
                height: 50px; 
    padding-left: 6px;
    border-left: 6px solid #f5a15c;
    
    
}
.notices .notice {
    font-size: 6;
    
}
.page_break { page-break-before: always; }

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
opacity: 0.2; /* Firefox, Chrome, Safari, Opera, IE >= 9 (preview) */
}

        </style>
    </head>
    <body>
      <div id="image">
        <img src="https://i.ibb.co/n6SVRQr/Logo-Sun.jpg" alt="..." />
      </div>
        <!-- Define header and footer blocks before your content -->
        <header>
          <div class="row">
            <div class="col">
                <a target="_blank" href="https://sunnypavers.com">
                  <img  style="height: 110px; width: 106px; position: fixed"src="https://i.ibb.co/z7T374Q/Logo-2.jpg" data-holder-rendered="true" />
                </a>
            </div>
            <div class="col company-details">
              <div>   &nbsp;
              </div>

                <div>NV State Business License # NV20151085480</div>
                <div>NV State Contractor's Board Licenses:    </div>
                <div>C-18 # 0080493 - Limit: $245,000 / C-10 # 0081661 - Limit: $245,000</div>
            </div>
        </div>
        </header>

        <footer>
          Invoice was created on a computer and is valid without the signature and seal.
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
          <div class="row contacts">
            <div style="text-align: right">
             </div>
            <div style="text-align: left" class="col invoice-to">
              <div class="row">
                <div class="col-xs-6">
                    <h3 class="to">{{$customer->customer_name}}</h3>
                </div>
                <div class="col-xs-6">
                  <h3 class="to">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quote number: {{$id}}</h3>

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
        <div style="page-break-inside: avoid; line-height: 0px"> 
        @foreach($itemData as $group_type => $items)
          <table class="table">
          @if($loop->first)
          <thead>
            <tr>
              <th  style="text-align: left; line-height: 5px" scope="col" >Description</th>
              <th style="line-height: 1px" scope="col" >Quantity</th>
              <th style="line-height: 1px" scope="col" >Unit Price</th>
              <th style="text-align: right;line-height: 1px" scope="col" >Investment</th>
            </tr>
          </thead>
          @endif
          </table>
        <h4 style="line-height: 5px">{{$group_type}} </h4>
        <table  class="table" width="" class="table">
         
          <tbody>
            @foreach($items as $item)
            <tr style="line-height: 0px">
              <td style="width: 40%;line-height: 10px">{{$item->description}} </td>
              <td style="width: 20%;line-height: 10px">{{$item->quantity}} {{$item->type}} </td>
              <td style="width: 20%;line-height: 10px">$ {{number_format($item->unit_price,2)}} </td>
              <td style="width: 20%;line-height: 10px; text-align: right">$ {{number_format($item->investment,2)}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
        @endforeach
        
        <table style="page-break-inside: avoid; margin-top: -30px" class="table" width="">
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line" style="line-height: 5px"></td>
            <td class="no-line" style="line-height: 5px"></td>
          </tr>
          @if($serviceData->discount > 0)
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center" style="line-height: 5px"><strong>Subtotal</strong></td>
            <td class="no-line text-right" style="line-height: 5px">$ {{number_format($serviceData->subtotal,2)}}</td>
          </tr>
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center" style="line-height: 5px"><strong>Discount</strong></td>
            <td class="no-line text-right" style="line-height: 5px">$ {{(number_format($serviceData->discount,2))}}</td>
          </tr>
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="thick-line text-center" style="line-height: 10px"><strong>Total</strong></td>
            <td class="thick-line text-right" style="line-height: 10px"><span style="font-weight: bold">$ {{number_format($serviceData->total,2)}} </span></td>
          </tr>
          @else
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center" style="line-height: 10px"><strong>Total</strong></td>
            <td class="no-line text-right" style="line-height: 10px">$ {{number_format($serviceData->total,2)}}</td>
          </tr>
          @endif
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="thick-line text-center" style="width:140px; line-height: 5px" ><strong>Accepting Proposal</strong></td>
            <td class="thick-line text-right" style="line-height: 5px">$ {{number_format($serviceData->accepting_proposal,2)}}</td>
          </tr>
          @if($serviceData->down_payment > 0)
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center" style="line-height: 5px"><strong>Down Payment</strong></td>
            <td class="no-line text-right" style="line-height: 5px">$ {{number_format($serviceData->down_payment,2)}}</td>
          </tr>
          @endif
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center" style="line-height: 5px"><strong>Final Balance</strong></td>
            <td class="no-line text-right" style="line-height: 5px">$ {{number_format($serviceData->final_balance,2)}}</td>
          </tr>
        </tbody>
      </table>
             @if($serviceData->notes != "")
      <div class="col-xs-6">Notes: {!! $serviceData->notes !!}</div>
      @endif

        </main>
    </body>
</html>
