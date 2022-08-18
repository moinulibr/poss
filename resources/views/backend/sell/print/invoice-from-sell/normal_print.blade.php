<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="AMADER SANITARY">
        <meta name="author" content="GeniusOcean">

        <title>AMADER SANITARY Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('backend/print/bootstrap.main.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/print/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('backend/print/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/print/css/style.css')}}">
  <link href="{{asset('backend/print/css/print.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="icon" type="image/png" href="{{asset('assets/images/favicon.ipg')}}"> 
  <style type="text/css">
@page { size: auto;  margin: 0mm; }
@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 287mm;
  }

html {

}
::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
  </style>
</head>
<body onload="window.print();">
    <div class="invoice-wrap">
            <div class="invoice__title">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="invoice__logo text-left">
                            <img src="{{ asset('assets/images/e-basket.png') }}" alt="AMADER SANITARY">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="invoice__metaInfo" style="margin-top:0px;margin-bottom: -30px;">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="invoice__orderDetails" style="text-align: center;font-size: 14px">
                        <strong style="font-size: 18px">AMADER SANITARY</strong><br>
                        <span>Janata Bank More, Hafej Bulding Under</span><br/>
                             Graound, Faridpur<br>
                        <span><strong>Call: 01711 11 11 92</strong> </span><br>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
            <hr>

            <div class="invoice__metaInfo" style="margin-top:0px;">
                <div class="col-lg-3">
                    <div class="invoice__orderDetails" style="margin-top:5px;">
                        <strong  style="font-size: 15px">{{ __('Order Details') }} </strong><br>
                        <span><strong>{{ __('Invoice Number') }} :</strong> {{ $data->invoice_no }}</span><br>
                        <span><strong>{{ __('Order Date') }} :</strong> {{ date('d-M-Y',strtotime($data->created_at)) }}</span><br>
                        <span><strong>{{  __('Order ID')}} :</strong> {{ sprintf("%'.08d", $data->id) }}</span>
                    </div>
                </div>
                <div class="col-lg-5" >
                    <div class="invoice__orderDetails" style="margin-top:5px;">
                        <strong  style="font-size: 15px">{{ __('Shipping Details') }}</strong><br>
                        <span><strong>{{ __('Customer Name') }}</strong>: </span><br>
                        <span><strong>{{ __('Customer Phone') }}</strong>: </span><br>
                        <span><strong>{{ __('Address') }}</strong>: </span>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="invoice__orderDetails" style="margin-top:5px;">
                        <strong  style="font-size: 15px">{{ __('Billing Details') }}</strong><br>
                        <span><strong>{{ __('Customer Name') }}</strong>: </span><br>
                        <span><strong>{{ __('Phone') }}</strong>: </span><br>
                        <span><strong>{{ __('Address') }}</strong>: </span>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <div class="invoice_table">
                        <div class="mr-table">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover dt-responsive" cellspacing="0"
                                    width="100%">
                                    <thead style="border-top:1px solid rgba(0, 0, 0, 0.1) !important;">
                                        <tr>
                                            <th>{{ __('Sl.') }}</th>
                                            <th>{{ __('AS Code') }}</th>
                                            <th style="width:50%">{{ __('Product') }}</th>
                                            <th>{{ __('Qty') }}</th>
                                            <th>{{ __('Sale Price') }}</th>
                                            <th>{{ __('Subtotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 0;
                                        @endphp
                                        @foreach ($data->sellProducts ? $data->sellProducts : NULL  as $item)
                                        <tr>
                                            @php
                                                $cats = json_decode($item->cart,true);
                                                $i++;
                                            @endphp
                                            <td>{{ $i }}</th>
                                            <td>{{$item->custom_code}} </th>
                                            <td style="width:50%">
                                                @if (array_key_exists('productName',$cats))
                                                    {{$cats['productName']}}
                                                    @else
                                                    NULL
                                                @endif    
                                            </th>
                                            <td>
                                                {{$item->quantity}}
                                                {{-- @if (array_key_exists('unitName',$cats))
                                                    <small>{{$cats['unitName']}}</small>
                                                    @else
                                                    NULL
                                                @endif --}}    
                                            </th>
                                            <td>{{$item->sold_price}}</th>
                                            <td> 
                                                {{$item->total_sold_price}}
                                                @if ($item->total_discount > 0)
                                                    <br/>
                                                    (Less : {{ $item->total_discount }})
                                                @endif 
                                            </th>
                                        </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="invoice__metaInfo" style="margin-top:0px;">
                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Reference No</th>
                                        <th>Amount</th>
                                        <th>Credit/Debit</th>
                                        <th>Payment Method</th>
                                        <th>Payment Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Sub Total</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:center;">
                                            <span style="font-size:14px;"> {{$data->subtotal}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Less Amount</strong>
                                        </td>
                                        <td>(-)</td>
                                        <td style="text-align:center;">
                                            <span style="font-size:14px;"> {{$data->total_discount}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>({{ $data->vat_amount }}%) Vat</strong>
                                        </td>
                                        <td>(+)</td>
                                        <td style="text-align:center;">
                                            {{ $data->total_vat }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Shipping</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:center;">
                                            <span style="font-size:14px;"> {{$data->shipping_cost}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Other cost</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:center;">
                                            <span style="font-size:14px;"> {{$data->others_cost}}</span>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td colspan="2">
                                            <strong>Round off</strong>
                                        </td>
                                        <td>(+/-)</td>
                                        <td style="text-align:center;">
                                            <span style="font-size:14px;"> {{$data->round_amount}}</span>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td colspan="2">
                                            <strong>Total Payable</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:center;">
                                            {{$data->total_payable_amount}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Total Paid</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:center;">
                                            {{$data->total_paid_amount}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>Total Due</strong>
                                        </td>
                                        <td></td>
                                        <td style="text-align:center;">
                                            {{$data->due_amount}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            
             
                

        </div>

<script type="text/javascript">
setTimeout(function () {
        window.close();
      }, 500);
</script>

</body>
</html>