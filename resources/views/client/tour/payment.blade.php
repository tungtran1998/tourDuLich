@extends('client.layouts.main')
@section('title',trans('allclient.confirm_reservation'))
@section('content')
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
@endphp
<section class="page-cover" id="cover-hotel-grid-list">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">
				{{trans('allclient.Tourbooking')}}</h1>
				<ul class="breadcrumb">
					<li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
					<li><a href="#">Tour</a></li>
					<li class="active">
						{{$tour->tour_name}}
					</li>
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
					<h2 class="selected-price">{{trans('allclient.Tourbooking')}}</h2>
					
					<div class="booking-form">
						<h4 class=" text-danger">
							@if(Session::get('total_amount_discount'))
							<strike>
							{{trans('allclient.total')}}: {{number_format(Session::get('total_amount'))}} VNĐ
							</strike> <br>
							{{trans('allclient.total')}}: {{number_format(Session::get('total_amount_discount'))}} VNĐ
							@else
							{{trans('allclient.total')}}: {{number_format(Session::get('total_amount'))}} VNĐ
							@endif
						</h4>

						{!! Form::open(['url' => 'checkouttour', 'method' => 'POST']) !!}
						<input hidden type="number" name="id" value="{{$tour->id}}">
						<label>{{trans('allclient.fullname')}}</label>
						<div class="form-group">
							{{Form::text('fullname', $fullname,['class' => 'form-control','placeholder' => trans('allclient.20qaz')])}}   
							<span class="text-danger">{{ $errors->first('fullname')}}</span>                                    
						</div>
						<label>Email</label>
						<div class="form-group">
							{{Form::email('email', $email,['class' => 'form-control','placeholder' => trans('allclient.21qaz')])}}  
							<span class="text-danger">{{ $errors->first('email')}}</span>                                     
						</div>
						<label>{{trans('allclient.phone')}}</label>
						<div class="form-group">
							{{Form::number('phone', $phone,['class' => 'form-control','placeholder' =>trans('allclient.22qaz')])}}
							<span class="text-danger">{{ $errors->first('phone')}}</span>                                      
						</div>
						<div class="form-group">
							<label>{{trans('allclient.adult')}}: {{Session::get('adult')}} {{trans('allclient.people')}}</label>                               
						</div>
						<div class="form-group">
							<label>{{trans('allclient.children')}}: {{Session::get('kid')}} {{trans('allclient.people')}}</label>
						</div>
						
						<div class="form-group">
							<label>{{trans('allclient.Roomnumber')}}: {{Session::get('single_room')}}</label>                       
						</div>
						<div class="form-group">
							<label>{{trans('allclient.note')}}: </label>
							{{Form::textarea('message', Session::get('note'),['class' => 'form-control','placeholder' => trans('allclient.enter_note'),'rows'=>'1'])}}
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
						{!! Form::close() !!}
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-9 col-lg-8 content-side">
				<h1 class="font-weight-bold border">{{$tour->tour_name}}</h1>  
				<div class="detail-slider">
					<div class="feature-slider">
						<img class="card-img" src="{{ asset('administration/imagerooms').'/'.$tour->tour_image }}" class="img-responsive" alt="feature-img" style="width: 848px; height: 494px;"/>
					</div>
					<div class="col-md-6">
						<h4>{{trans('allclient.Pricelist')}} <hr></h4>
						<ul>
							<li>{{trans('allclient.adult')}}: {{number_format($tour->price_adult)}} VND</li>
							<li>{{trans('allclient.children')}}:  {{number_format($tour->price_kid)}} VND</li>
							<li>{{trans('allclient.Singleroomprice')}}: {{number_format($tour->single_room_price)}} VND</li>
							<li>{{trans('allclient.Startingpoint')}}: {{$tour->departure_location}}</li>
						</ul>
						<hr>
					</div>
					<div class="col-md-6">
						<h4>{{trans('allclient.Info')}}<hr></h4>
						<ul>
							<li>{{trans('allclient.Promotion')}}: {{$tour->discount}} %</li>
							<li>{{trans('allclient.TourCode')}}: {{$tour->tour_code}} </li>
							<li>{{trans('allclient.Destination')}}: {{$tour->destination}} </li>
							<li>{{trans('allclient.Time123')}}: {{$tour->number_of_day}} {{trans('allclient.day12323')}} </li>
						</ul>
						<hr>
					</div>
					{!! $tour->tour_detail !!}
					<h3>{{trans('allclient.Thetour')}}</h3>
					{!! $tour->tour_program !!}
					@if($tour->tour_note)
					<h3>{{trans('allclient.LuuY')}}</h3>
					{!! $tour->tour_note !!}
					@endif
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
