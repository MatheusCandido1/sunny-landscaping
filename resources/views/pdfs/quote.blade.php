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
                  <h3 class="to">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quote number: #{{$id}}</h3>

                </div>
              </div>
                <div class="address">{{$customer->address}}</div>
                <div class="address">{{$customer->city_name}}, {{$customer->state}} - {{$customer->zipcode}}</div>
                <div class="email">{{$customer->email}}</div>
            </div>
            <div style="text-align: right" class="col invoice-details">
                <div class="date">Date: {{ date('m/d/Y') }}</div>
            </div>
        </div>
        @foreach($itemData as $group_type => $items)
        <h4>{{$group_type}} </h4>
        <table class="table" width="" class="table">
          <thead>
            <tr>
              @if($group_type == "1 - PAVERS" || $group_type == "2 - RETAINING WALL")
              <th style="text-align: left" scope="col" >Supplier</th>
              @endif
              <th style="text-align: left" scope="col" >Description</th>
              <th style="" scope="col" >Quantity</th>
              <th style="" scope="col" >Unit Price</th>
              <th style="text-align: right" scope="col" >Investment</th>
            </tr>
          </thead>
          <tbody>
            @foreach($items as $item)
            <tr>
              @if($item->group_type == "1 - PAVERS" || $item->group_type == "2 - RETAINING WALL")
              <td>{{$item->supplier}}</td>
              @endif
              <td>{{$item->description}} </td>
              <td>{{$item->quantity}} {{$item->type}} </td>
              <td>$ {{number_format($item->unit_price,2)}} </td>
              <td style="text-align: right">$ {{number_format($item->investment,2)}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @endforeach
        
        <div class="page_break"></div>
        <table class="table" width="">
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line " ></td>
            <td class="no-line"></td>
          </tr>
          <tr>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line"></td>
            <td class="no-line text-center"><strong>Total</strong></td>
            <td class="no-line text-right">$ {{number_format($serviceData->total,2)}}</td>
          </tr>
          @if($serviceData->discount > 0)
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
        <div class="row">
        <div class="notices">
            <div>NOTES:</div>
            <div class="notice">Accepting Proposal is Due upon Signing Proposal. Down Payment is Due on the First Day of the Job. Final Balance is Due upon Job Completion.(Initial) __________</div>
            <div class="notice">Cost for Concrete Removal was calculated considering a 4"-thick slab.  Whenever the thickness of your patio concrete pad is above 4" thick, the following applies:                      $3.50 sq.ft: Concrete pad above 4" without steel mesh or rebar. $35.00 per man-hour: Concrete with steel mesh or rebar. (Initial) __________</div>
            <div class="notice">Cost for manual Excavation takes in consideration the absence of big rocks and is limited to 3" depth.  If removing bigger rocks or excavation over 3" of depth is required, the cost will increase to $3.00/sq.ft. (Initial) __________</div>
            <div class="notice">Motor Vehicles on Artificial Grass or any other condition which will expose the Artificial Grass to temperatures exceding 140 degrees Farenheit including damage from sun magnification or reflection from the sun will void warranty. (Initial) __________</div>
            <div class="notice">Natural Stone Acceptance (Travertine): Using Natural Stone is a philosophical decision. It entails embracing the organic beauty and variations that nature has given us. Not two pieces of natural Stone will look the same nor should they. This is the enduring appeal of natural stone and reflects the journey each stone has taken over millions of years before it is quarried from the earth and prepared for your project. Variation is the defining characteristic of natural stone that differentiates it from man made products.(Initial) __________</div>
        </div>
        </main>
    </body>
</html>
