
<link rel='stylesheet' href='{{asset('Bootstrap/css/bootstrap.min.css')}}'>
<div class="container">
    <style >
        body{
            background:#eee;
            margin-top:20px;
        }
        .text-danger strong {
        	color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #9f181c;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		#container {
			background-color: #dcdcdc;
		}
    </style>
   <div class="col-md-12">   
    <div class="row">
           
           <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
               <div class="row">
                   <div class="receipt-header">
                       <div class="col-xs-6 col-sm-6 col-md-6">
                           <div class="receipt-left">
                                {{-- Header --}}
                                @if($invoice->logo)
                                    <img class="img-responsive" alt="iamgurdeeposahan" src="{{ $invoice->getLogo() }}" style="width: 71px;">
                                @endif
                               
                           </div>
                       </div>
                       <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                           <div class="receipt-right">
                            @if($invoice->seller->name)
                                <h5>{{ $invoice->seller->name }}</h5>
                            @endif

                            @if($invoice->seller->address)
                                <p class="seller-address">
                                    {{ __('invoices::invoice.address') }}: {{ $invoice->seller->address }} <i class="fa fa-location-arrow"></i>
                                </p>
                            @endif

                            @if($invoice->seller->phone)
                                <p>
                                    {{ __('invoices::invoice.phone') }}: {{ $invoice->seller->phone }} <i class="fa fa-phone"></i>
                                </p>
                            @endif
                            @foreach($invoice->seller->custom_fields as $key => $value)
                                <p class="seller-custom-field">
                                    {{ ucfirst($key) }}: {{ $value }}
                                </p>
                            @endforeach
                           </div>
                       </div>
                   </div>
               </div>
               
               <div class="row">
                   <div class="receipt-header receipt-header-mid">
                       <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                           <div class="receipt-right">
                                <h5>{{ $invoice->buyer->name }} </h5>
                                <p><b>Mobile :</b> {{ __('invoices::invoice.phone') }}: {{ $invoice->buyer->phone }}</p>
                                @foreach($invoice->buyer->custom_fields as $key => $value)
                                    <p>
                                        <b>{{ ucfirst($key) }}</b>: {{ $value }}
                                    </p>
                                @endforeach
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4">
                           <div class="receipt-left">
                               <h3>{{ __('invoices::invoice.serial') }} <strong>{{ $invoice->getSerialNumber() }}</strong></h3>
                           </div>
                       </div>
                   </div>
               </div>
               
               <div>
                   <table class="table table-bordered">
                       <thead>
                           <tr>
                                <th>Type de Dépense</th>
                                <th>Description</th>
                                <th>Montant</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                                <td class="col-md-4">Payment du Professeur</td>
                                <td class="col-md-5">Payment for August 2016</td>
                                <td class="col-md-3"> 
                                    @if($invoice->hasItemUnits)
                                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                                    @endif
                                </td>
                           </tr>
                           <tr>
                                <td></td>
                                <td class="text-right"><h2><strong>Total: </strong></h2></td>
                                <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> {{ $invoice->formatCurrency($invoice->total_amount) }}</strong></h2></td>
                           </tr>
                       </tbody>
                   </table>
               </div>
               
               <div class="row">
                   <div class="receipt-header receipt-header-mid receipt-footer">
                       <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                           <div class="receipt-right">
                               <p><b>Date :</b> {{ $invoice->getDate() }}</p>
                               <h5 style="color: rgb(140, 140, 140);">Merci pour Votre Service!</h5>
                           </div>
                       </div>
                       <div class="col-xs-4 col-sm-4 col-md-4">
                           <div class="receipt-left">
                               <h1>Signature</h1>
                           </div>
                       </div>
                   </div>
               </div>
               
           </div>    
       </div>
   </div>