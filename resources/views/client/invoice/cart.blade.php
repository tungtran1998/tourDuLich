@extends('client.layouts.main')
@section('title',trans('allclient.invoice'))
@section('content')
<section class="page-cover" id="cover-hotel-grid-list">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.invoice')}}</h1>
				<ul class="breadcrumb">
					<li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
					<li class="active">{{trans('allclient.invoice')}}</li>
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
					<h2 class="selected-price text-center">{{trans('allclient.booking_infor')}}</h2>
					<div class="booking-form">
						<h3 class="text-center">{{trans('allclient.book_now')}}</h3>
						<p class="text-center">{{trans('allclient.quick')}}</p>
						@if (session('success'))
						<div class="alert alert-success">
							{{session('success')}}
						</div>
						@endif
						@if (session('errorSQL'))
						<div class="alert alert-danger">
							{{session('errorSQL')}}
						</div>
						@endif
						{!! Form::open(['url' => 'check_price', 'method' => 'get']) !!}

						<div class="form-group">
							@php
							if(Cookie::has('checkin') && Cookie::has('checkout')){
								$checkin = Cookie::get('checkin');
								$checkout = Cookie::get('checkout');
							}else{
								$checkin = date_format(\Carbon\Carbon::now(),"d/m/Y");
								$checkout = date_format(\Carbon\Carbon::tomorrow(),"d/m/Y");

							}
							@endphp
							<label>{{trans('allclient.check_in_date')}}</label>
							{{Form::text('checkin', $checkin,['class' => 'form-control dpd1', 'autocomplete' => 'off'])}}                                        
						</div>
						<div class="form-group">
							<label>{{trans('allclient.check_out_date')}}</label>
							{{Form::text('checkout', $checkout ,['class' => 'form-control none_radius dpd2', 'autocomplete' => 'off'])}}
						</div>
						<label>{{trans('allclient.service_arising')}}</label><br>
						<div class="form-check">
							@php
							if(Session::get('cost_overrun')){
								$cost = Session::get('cost_overrun');
								foreach ($cost as $value) {
									$cost_arr[] = $value->id;
								}
							}
							@endphp
							@foreach($services as $service)
							<input class="form-check-input" type="checkbox" name="service[]" value="{{$service->id}}" id="defaultCheck1" {{ (isset($cost) && in_array($service->id, $cost_arr)) ? 'checked' : '' }}>
							<label class="form-check-label" for="defaultCheck1">
								{{ $service->name }} - {{number_format($service->price)}} VNĐ
							</label>
							<br>
							@endforeach
						</div>
						<br>
						<p class="text-center">{{trans('allclient.only_one')}}</p>
						<button class="btn btn-block btn-orange  fl_right">{{trans('allclient.next_step')}}</button>
						<p class="text-center">{{trans('allclient.or')}}</p>
						<a class="btn btn-block btn-orange" href="{{ route('home.roomType') }}">{{trans('allclient.choose')}}</a>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-8 content-side">
				<a class="btn btn-danger" href="{{ url('deleteall') }}">{{trans('allclient.delete_all')}}</a><br><hr>
				@php
				$adult = 0;
				$kid = 0;
				$count = count($cart);
				@endphp
				@if($cart==null)
				<h4 class="text-warning text-center">{{trans('allclient.come_back')}}</h4>
				@endif
				
				<div id="accordion">
					@foreach ($cart as $cart)
					<div class="available-blocks" id="available-rooms">
						<div class="list-block main-block room-block">
							<div class="list-content">
								<div class="main-img list-img room-img">
									<a href="">
										<img style="object-fit: cover;" src="{{ asset('administration/imageRooms/'.$cart['thumbnail']) }}" class="img-responsive" alt="room-img" />
									</a>
									<div class="main-mask">
										<ul class="list-unstyled list-inline offer-price-1">
											<li class="price">{{number_format($cart['price'])}} VND<span class="divider">|</span><span class="pkg">{{trans('allclient.night')}}</span></li>
										</ul>
									</div>
								</div>
								<div class="list-info room-info">
									<h3 class="block-title"><a href=""></a></h3>
									<div class="row">
										<div class="col-md-6 col-sm-6">
											@if(session('message'.$cart['id']))
											<p class="text text-danger">{{ session('message'.$cart['id']) }}</p>
											@endif
											<p>{{trans('allclient.acreage')}}: {{ $cart['acreage'] }} m2</p>
											<p>{{trans('allclient.adult')}}: {{ $cart['adult'] }}  
											{{trans('allclient.people')}}</p>
											<p>{{trans('allclient.kid')}}: {{ $cart['kid'] }} 
											{{trans('allclient.people')}}</p>
											<p>{{trans('allclient.location')}}: {{ $cart['location'] }} </p>
										</div>
										<div class="col-md-6 col-sm-6">
											<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')
											->size(120)->errorCorrection('H')
											->generate(route('roomtype.room.detail',$cart['id']))) !!} ">
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
		<script>
			$(document).ready(function(){
				$('.home-status').removeClass('active');
				$('.invoice-status').addClass('active');
			});
		</script>
		@endsection
