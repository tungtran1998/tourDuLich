@extends('client.layouts.main')
@section('title',trans('allclient.vq'))
@section('content')
<!--============= PAGE-COVER =============-->
<section class="page-cover" id="cover-login">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.vq')}}</h1>
				<ul class="breadcrumb">
					{{trans('allclient.vw')}} <br>
                    {{trans('allclient.ve')}}, <a href="{{ route('verification.resend') }}">{{trans('allclient.vr')}}</a>.
				</ul>
			</div>
		</div>
	</div>
</section>
@endsection
@section('script1')
@endsection
