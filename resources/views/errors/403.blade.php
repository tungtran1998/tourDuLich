@extends('Client.layouts.main')
@section('title',trans('allclient.25qaze'))
@section('content')
<br>
<div class="container">
	<div class="row">
		<h4 class="text-center alert alert-danger">{{ trans('allclient.26qaz') }}</h4>
		<hr>
		<a class="btn btn-block btn-orange" href="{{url('/')}}">{{ trans('allclient.27qaz') }}</a>
		<br>
	</div>
</div>
@endsection