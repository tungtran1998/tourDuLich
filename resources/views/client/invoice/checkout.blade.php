@extends('client.layouts.main')
@section('title',trans('allclient.confirm_reservation'))
@section('content')
<section class="page-cover" id="cover-hotel-grid-list">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">
				{{trans('allclient.confirm_reservation')}}</h1>
				<ul class="breadcrumb">
					<li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
					<li><a href="{{route('invoice')}}">{{trans('allclient.invoice')}}</a></li>
					<li class="active">
					{{trans('allclient.confirm_reservation')}}</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section id="latest-blog" class="section-padding" style="padding-top: 50px;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 side-bar left-side-bar">
				<div class="side-bar-block booking-form-block">
					<h2 class="selected-price">{{trans('allclient.confirm_reservation')}}</h2>
					@php
					if(Auth::check()){
						$fullname = Auth::user()->first_name.' '.Auth::user()->last_name;
						$email = Auth::user()->email;
						$phone = Auth::user()->phone;
					}else{
						$fullname = '';
						$email = '';
						$phone = '';
					}
					if(Session::get('cost_overrun')){
						$services = Session::get('cost_overrun');
					}else{
						$services = [];
					}
					@endphp
					<div class="booking-form">
						<h4 class=" text-danger">{{trans('allclient.total')}} : {{number_format(Session::get('total_amount'))}} VNĐ</h4>

						{!! Form::open(['url' => 'checkout', 'method' => 'POST']) !!}
						<div class="form-group">
							<label>{{trans('allclient.check_in_date')}}</label>
							{{Form::text('checkin', request()->get('checkin'),['class' => 'form-control', 'readonly'])}}                                     
						</div>
						<div class="form-group">
							<label>{{trans('allclient.check_out_date')}}</label>
							{{Form::text('checkout', request()->get('checkout'),['class' => 'form-control', 'readonly'])}}      
						</div>
						<div class="form-group">
							<label>{{trans('allclient.service_arising')}}</label>
							@foreach($services as $service)
							<br>↠ {{ $service['name'] }} - {{number_format($service->price)}} VNĐ
							@endforeach
							<br>
						</div>
						<label class="show_price btn btn-warning">{{trans('allclient.detail')}}</label>
						<div hidden class="form-group ck_box dshow_price"><br>
							@if(isset($array))
							<h5>{{trans('allclient.in')}} : {{count($array)}} {{trans('allclient.day')}}</h5>
							@foreach($array as $key=> $gia)
							{{ ++$key }} : {!!$gia!!} 
							@endforeach
							@endif
						</div>
						<div class="form-group">
							<label>{{trans('allclient.full_name')}}</label>
							{{Form::text('fullname', $fullname,['class' => 'form-control'])}}
							<span class="text-danger">{{ $errors->first('fullname')}}</span>                                     
						</div>
						<div class="form-group">
							<label>{{trans('allclient.email')}}</label>
							{{Form::email('email', $email,['class' => 'form-control'])}}
							<span class="text-danger">{{ $errors->first('email')}}</span>                                     
						</div>
						<div class="form-group">
							<label>{{trans('allclient.phone')}}</label>
							{{Form::text('phone', $phone,['class' => 'form-control'])}}
							<span class="text-danger">{{ $errors->first('phone')}}</span>                                     
						</div>
						<div class="form-group">
							<label>{{trans('allclient.note')}} :</label>
							{{Form::textarea('message', '',['class' => 'form-control','rows'=>'1','placeholder' => trans('allclient.enter_note')])}}
							<span class="text-danger">{{ $errors->first('message')}}</span>
						</div>
						<div class="form-group right-icon">
							{{Form::select('payment', ['0' => trans('allclient.pay_hotel'), '1' => trans('allclient.pay_online')], null, ['class' => 'form-control', 'id' => 'payment'])}}
							<i class="fa fa-angle-down"></i>
						</div>
						<div class="payment" hidden>
						<div class="form-group">
							<label for="bank_code">{{trans('allclient.bank')}}</label>
							<select name="bank_code" id="bank_code" class="form-control">
								<option value="">{{trans('allclient.19qaz')}}</option>
								<option value="NCB"> Ngan hang NCB</option>
								<option value="AGRIBANK"> Ngan hang Agribank</option>
								<option value="SCB"> Ngan hang SCB</option>
								<option value="SACOMBANK">Ngan hang SacomBank</option>
								<option value="EXIMBANK"> Ngan hang EximBank</option>
								<option value="MSBANK"> Ngan hang MSBANK</option>
								<option value="NAMABANK"> Ngan hang NamABank</option>
								<option value="VNMART"> Vi dien tu VnMart</option>
								<option value="VIETINBANK">Ngan hang Vietinbank</option>
								<option value="VIETCOMBANK"> Ngan hang VCB</option>
								<option value="HDBANK">Ngan hang HDBank</option>
								<option value="DONGABANK"> Ngan hang Dong A</option>
								<option value="TPBANK"> Ngân hàng TPBank</option>
								<option value="OJB"> Ngân hàng OceanBank</option>
								<option value="BIDV"> Ngân hàng BIDV</option>
								<option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
								<option value="VPBANK"> Ngan hang VPBank</option>
								<option value="MBBANK"> Ngan hang MBBank</option>
								<option value="ACB"> Ngan hang ACB</option>
								<option value="OCB"> Ngan hang OCB</option>
								<option value="IVB"> Ngan hang IVB</option>
								<option value="VISA"> Thanh toan qua VISA/MASTER</option>
							</select>
						</div>
						<div class="form-group">
							<label for="language">{{trans('allclient.language')}}</label>
							<select name="language" id="language" class="form-control">
								<option value="vn">Tiếng Việt</option>
								<option value="en">English</option>
							</select>
						</div>
						</div>
						<div class="checkbox custom-check">
							<input type="checkbox" id="check01" name="checkbox" required/>
							<label for="check01"><span><i class="fa fa-check"></i></span>{{trans('allclient.agree')}} <a href="{{route('term')}}">{{trans('allclient.term_policy')}}</a></label>
						</div>
						<button class="btn btn-block btn-orange  fl_right">{{trans('allclient.complete_order')}}</button>
						<a class="btn btn-block btn-orange" href="{{ url('invoice') }}">{{trans('allclient.back_invoice')}}</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-8 content-side">
				@php
				$adult = 0;
				$kid = 0;
				$count = count($cart);
				@endphp
				<div id="accordion">
					@foreach ($cart as $cart)
					<div class="available-blocks" id="available-rooms">
						<div class="list-block main-block room-block">
							<div class="list-content">
								<div class="main-img list-img room-img">
									<a href="">
										<img src="{{ asset('administration/imageRooms/'.$cart['thumbnail']) }}" class="img-responsive" alt="room-img" style=" height: 240px"/>
									</a>
									<div class="main-mask">
										<ul class="list-unstyled list-inline offer-price-1">
											<li class="price">{{$cart['price']}} VND<span class="divider">|</span><span class="pkg">{{trans('allclient.night')}}</span></li>
										</ul>
									</div>
								</div>
								<div class="list-info room-info">
									<h3 class="block-title"><a href=""></a></h3>
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<p>{{trans('allclient.acreage')}} : {{ $cart['acreage'] }}m2</p>
											<p>{{trans('allclient.adult')}} :  {{ $cart['adult'] }}
											{{trans('allclient.people')}}</p>
											<p>{{trans('allclient.children')}} : {{ $cart['kid'] }} 
											{{trans('allclient.kid')}}</p>
											<p>{{trans('allclient.location')}}: {{ $cart['location'] }} </p>
										</div>
										<div class="col-md-6 col-sm-6">
											<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
											->size(120)->errorCorrection('H')
											->generate('http://localhost/DATN/public/roomDetail/'.$cart['id'])) !!} ">
										</div>
									</div>
									<a href="{{route('roomtype.room.detail',$cart['id'])}}" class="btn btn-orange btn-lg">{{trans('allclient.detail')}}</a>
									<a href="{{ url('delete/'.$cart['id']) }}"><button class="btn btn-danger btn-lg">{{trans('allclient.delete')}}</button></a>
								</div>
							</div>
						</div>
						@php
						$adult += $cart['adult'];
						$kid += $cart['kid'];
						@endphp
						@endforeach
					</div>
				</div>
			</div>
</section>
@endsection
@section('script1')
@include('Admin.shared.scrip')
<script type="text/javascript">
	$(".show_price").click(function() {
		$(".dshow_price").toggle(0);
	});
	document.getElementById("payment").onchange = function() {
	  if(this.value==1){
	  	$('.payment').show();
	  }
	  else{
	  	$('.payment').hide();
	  }
	}
</script>
<script>
$(document).ready(function(){
	$('.home-status').removeClass('active');
	$('.invoice-status').addClass('active');
});
</script>
@endsection
