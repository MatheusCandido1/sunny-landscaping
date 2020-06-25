<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  <title>Quote - {{$costumerData->costumer_name}}'s - {{$costumerData->visit_name}}</title>
</head>
<style>
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

#invoice{
    padding: 30px;
}




.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #f5a15c
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #f5a15c
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
  position: fixed; 
  bottom: 170px; 
                left: 30px; 
                right: 0px;
                height: 50px; 
    padding-left: 6px;
    border-left: 6px solid #f5a15c;
    
}

.invoice main .notices .notice {
    font-size: 6;
    
}

footer {
                position: fixed; 
                bottom: 0px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/

    text-align: center;
                color: #777;
    border-top: 1px solid #f5a15c;
            }

            .watermark {
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            background-repeat: no-repeat;
            z-index: 9999;
            opacity: 0.2;
            background-image: url("https://i.ibb.co/n0p0469/Logo-Sun.jpg");
            -webkit-user-select: none;
            margin: auto;
            cursor: zoom-in;
            }
</style>
<body>
  <div class="watermark"></div>
  
  <footer>Invoice was created on a computer and is valid without the signature and seal.
  </footer>
  <div id="invoice">
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
          <header>
            <div class="row">
              <div class="col">
                  <a target="_blank" href="https://lobianijs.com">
                    <img src="http://www.sunnypavers.com/wp-content/uploads/2016/03/SunnyWebsiteLogo2.png" data-holder-rendered="true" />
                  </a>
              </div>
              <div class="col company-details">
                  <h2 class="name">
                      <a style="color: #f5a15c" target="_blank" href="https://sunnypavers.com">
                        Sunny  Landscaping & Pavers Design LLC
                      </a>
                  </h2>
                  <div>NV State Business License # NV20151085480</div>
                  <div>NV Contractor's Board Licenses:    </div>
                  <div>C-18 # 0080493 - Limit: $245,000 / C-10 # 0081661 - Limit: $245,000</div>
              </div>
          </div>
          </header>
            <main>
                <div class="row contacts">
                    <div class="col invoice-to">
                        <h2 class="to">{{$costumerData->costumer_name}}</h2>
                        <div class="address">Project: {{$costumerData->visit_name}} </div>
                        <div class="address">{{$costumerData->address}}</div>
                        <div class="address">{{$costumerData->city}}, {{$costumerData->state}} - {{$costumerData->zipcode}}</div>
                        <div class="email">{{$costumerData->email}}</div>
                    </div>
                    <div class="col invoice-details">
                        <div class="date">Date of Quote: {{ date('m/d/Y') }}</div>
                    </div>
                </div>
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
                <div class="page_break"></div>

                <div class="notices">
                    <div>NOTES:</div>
                    <div class="notice">Accepting Proposal is Due upon Signing Proposal. Down Payment is Due on the First Day of the Job. Final Balance is Due upon Job Completion.(Initial) __________</div>
                    <div class="notice">Cost for Concrete Removal was calculated considering a 4"-thick slab.  Whenever the thickness of your patio concrete pad is above 4" thick, the following applies:                      $3.50 sq.ft: Concrete pad above 4" without steel mesh or rebar. $35.00 per man-hour: Concrete with steel mesh or rebar. (Initial) __________</div>
                    <div class="notice">Cost for manual Excavation takes in consideration the absence of big rocks and is limited to 3" depth.  If removing bigger rocks or excavation over 3" of depth is required, the cost will increase to $3.00/sq.ft. (Initial) __________</div>
                    <div class="notice">Motor Vehicles on Artificial Grass or any other condition which will expose the Artificial Grass to temperatures exceding 140 degrees Farenheit including damage from sun magnification or reflection from the sun will void warranty. (Initial) __________</div>
                    <div class="notice">Natural Stone Acceptance (Travertine): Using Natural Stone is a philosophical decision. It entails embracing the organic beauty and variations that nature has given us. Not two pieces of natural Stone will look the same nor should they. This is the enduring appeal of natural stone and reflects the journey each stone has taken over millions of years before it is quarried from the earth and prepared for your project. Variation is the defining characteristic of natural stone that differentiates it from man made products.(Initial) __________</div>
                    <div class="notice">If this is not within your price range, please let us know so we can design something that fits your budget.</div>

                </div>
            </main>
          
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div>
          <div class="watermark"></div></div>
    </div>
</div>
</body>
</html>