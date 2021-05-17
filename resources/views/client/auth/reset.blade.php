@extends('client.layouts.main')
@section('title',trans('allclient.aq'))
@section('content')
<!--============= PAGE-COVER =============-->
<section class="page-cover" id="cover-login">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.aq')}}</h1>
				<ul class="breadcrumb">
					<li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
					<li class="active">{{trans('allclient.aq')}}</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!--===== INNERPAGE-WRAPPER ====-->
<section class="innerpage-wrapper">
	<div id="login" class="innerpage-section-padding">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="flex-content">
						<div class="custom-form custom-form-fields">
							<h3>{{trans('allclient.aq')}}</h3>
							@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
							@endif
							<form method="POST" class="form-horizontal" action="{{ route('password.update') }}">
								@csrf
								<input type="hidden" name="token" value="{{ $token }}">
								<div class="form-group">
									<input type="text" class="form-control" placeholder="E-Mail Address..." name="email" value="{{ $email ?? old('email') }}" required autofocus readonly />
									<span><i class="fa fa-user"></i></span>
									@if ($errors->has('email'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									<input id="password" type="password" class="form-control" placeholder="{{trans('allclient.lw')}}" name="password" value="{{ old('password') }}" required autofocus  />
									<span><i class="fa fa-lock"></i></span>
									@if ($errors->has('password'))
									<span class="invalid-feedback" role="alert">
										<strong>{{ $errors->first('password') }}</strong>
									</span>
									@endif
								</div>
								<div class="form-group">
									<input id="password-confirm" type="password" class="form-control" placeholder="{{trans('allclient.qrt')}}" name="password_confirmation" required autofocus  />
									<span><i class="fa fa-lock"></i></span>
								</div>
								<button type="submit" class="btn btn-orange btn-block">{{trans('allclient.aq')}}
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>       
	</div>
</section>

@endsection
@section('script1')
@endsection
