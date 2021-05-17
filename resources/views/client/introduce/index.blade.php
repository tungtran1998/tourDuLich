@extends('client.layouts.main')
@section('title',trans('allclient.introduce'))
@section('content')
<section class="page-cover" id="cover-hotel-grid-list">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.introduce')}}</h1>
				<ul class="breadcrumb">
					<li><a href="/">{{trans('allclient.home')}}</a></li>
					<li class="active">{{trans('allclient.introduce')}}</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section id="latest-blog" class="section-padding" style="padding-top: 50px;">
	<div class="container">
		<!-- content -->
		<div class="row">
			<div class="col-md-12">
				<h1>{{trans('allclient.introduce.title')}}</h1>
				<hr>
			</div>
			<div class="col-md-12">
				<div class="col-md-6">
					<img src="{{ asset('client/imageLayout/v.jpg') }}" width="550px" height="500">
				</div>
				<div class="col-md-6">
					<p>{{trans('allclient.introduce.content')}}</p>
					<strong>{{trans('allclient.introduce.Thôngtin')}}</strong><br><br>
					<p>{{trans('allclient.introduce.24hservice')}}</p>
					<p>{{trans('allclient.introduce.Checkintime')}}</p>
					<p>{{trans('allclient.introduce.Checkouttime')}}</p>
				</div>
			</div>

		</div>
	</div>
</section>
<style type="text/css">
	strong{
		font-size: 20px;
	}
	p{
		font-size: 18px;
	}
</style>
@endsection
@section('script1')
<script>
	$(document).ready(function(){
		$('.home-status').removeClass('active');
		$('.introduce-status').addClass('active');
	});
</script>
@endsection

