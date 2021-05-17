@extends('client.layouts.main')
@section('title','Tour')
@section('content')

<section class="page-cover" id="cover-hotel-grid-list">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.Tour')}}</h1>
				<ul class="breadcrumb">
					<li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
					<li class="active">{{trans('allclient.Tour')}}</li>
				</ul>

			</div>
		</div>

	</div>
</section>

<section class="innerpage-wrapper">
	<div id="hotel-grid" class="innerpage-section-padding">
		<div class="container">
			<div class="row">        	
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-side">
					<div class="row">
					@include('client.tour.tour')
					</div>
					<div class="row text-center">
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
@endsection
@section('script1')
<script>
	$(document).ready(function(){
		$('.home-status').removeClass('active');
    	$('.top-tour-status').addClass('active');
	});
</script>
@endsection
