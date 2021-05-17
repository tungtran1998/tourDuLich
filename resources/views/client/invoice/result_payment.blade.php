@extends('client.layouts.main')
@section('title',trans('allclient.PaymentResults'))
@section('content')
<section class="page-cover" id="cover-hotel-grid-list">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.PaymentResults')}}</h1>
				<ul class="breadcrumb">
					<li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
					<li class="active">{{trans('allclient.PaymentResults')}}</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section id="latest-blog" class="section-padding" style="padding-top: 50px;">
	<div class="container">
		@if(request()->get('vnp_ResponseCode')==00)
		<h4 class="text-success" >{{trans('allclient.PaymentResults')}}</h4>
		<hr>
		<ul class="list-group">
		  <li class="list-group-item">{{trans('allclient.bank')}}: {{request()->get('vnp_BankCode')}}</li>
		  <li class="list-group-item">{{trans('allclient.Banktransactionno')}}: {{request()->get('vnp_BankTranNo')}}</li>
		  <li class="list-group-item">{{trans('allclient.Paymenttype')}}: {{request()->get('vnp_CardType')}}</li>
		  <li class="list-group-item">{{trans('allclient.Info')}}: {{request()->get('vnp_OrderInfo')}}</li>
		</ul>
		@else
		<label class="text-danger text-center">{{trans('allclient.Paymentfailed')}}</label>
		<p class="text-center text-info">{{trans('allclient.Contactcustomercareformoredetails')}}</p>
		@endif
	</div>

</section>

@endsection
@section('script1')
@include('Admin.shared.scrip')
<script>
	$(document).ready(function(){
		$('.home-status').removeClass('active');
		$('.invoice-status').addClass('active');
	});
</script>
<script>    
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", 'result_payment');
    }
</script>
@endsection
