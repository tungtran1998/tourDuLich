@extends('client.layouts.main')
@section('title',trans('allclient.25qaze'))
@section('content')
<br>
<div class="container">
	<div class="row">
		<h4 class="text-center alert alert-warning">{{trans('allclient.28qaz')}}<br> {{trans('allclient.29qaz')}}</h4>
		<hr>
		<a class="btn btn-block btn-orange" href="{{url('/')}}">{{trans('allclient.27qaz')}}</a>
		<br>
	</div>
</div>
@endsection