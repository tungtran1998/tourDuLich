@extends('client.layouts.main')
@section('title',trans('allclient.1qaz'))
@section('content')
<section class="page-cover" id="cover-hotel-grid-list">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.1qaz')}}</h1>
				<ul class="breadcrumb">
					<li><a href="{{route('home.client')}}}">{{trans('allclient.home')}}</a></li>
					<li class="active">{{trans('allclient.1qaz')}}</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section id="latest-blog" class="section-padding" style="padding-top: 50px;">
    <div class="container">
        <!-- content -->

        <div class="form-group">
        	<h2>{{trans('allclient.1qaz')}}</h2>
        	<hr>
        </div>
        <div class="form-group">
        	<strong>{{trans('allclient.2qaz')}}</strong>
        	<p>{{trans('allclient.3qaz')}}</p>
        </div>
        <div class="form-group">
        	<strong>{{trans('allclient.4qaz')}}</strong>
        	<p>{{trans('allclient.5qaz')}}</p>
        </div>

        <div class="form-group">
        	<strong>{{trans('allclient.6qaz')}}</strong>
        	<p>{{trans('allclient.7qaz')}}</p>
        </div>

        <div class="form-group">
        	<strong>{{trans('allclient.8qaz')}}</strong>
        	<p>{{trans('allclient.9qaz')}}
			</p>
        </div>

        <div class="form-group">
        	<strong>{{trans('allclient.10qaz')}}</strong>
        	<p>{{trans('allclient.11qaz')}}</p>
        </div>

        <div class="form-group">
        	<strong>{{trans('allclient.12qaz')}}</strong>
        	<p>{{trans('allclient.13qaz')}}</p>
        </div>

        <div class="form-group">
        	<strong>{{trans('allclient.14qaz')}}</strong>
        	<p>{{trans('allclient.15qaz')}}</p>
        	<p>
        		{{trans('allclient.16qaz')}}
        	</p>
        </div>

        <div class="form-group">
        	<strong>{{trans('allclient.17qaz')}}</strong>
        	<p>{{trans('allclient.18qaz')}}</p>
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

