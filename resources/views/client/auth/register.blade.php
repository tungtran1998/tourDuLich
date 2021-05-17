@extends('client.layouts.main')
@section('title',trans('allclient.register'))
@section('content')
<!--============= PAGE-COVER =============-->
<section class="page-cover" id="cover-login">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.sign_up')}}</h1>
				<ul class="breadcrumb">
					<li><a href="#">{{trans('allclient.home')}}</a></li>
					<li class="active">{{trans('allclient.sign_up')}}</li>
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
							<h3>{{trans('allclient.register')}}</h3>
							<form method="POST" class="form-horizontal" action="{{ route('register') }}">
								@csrf
								
								<div class="form-group">
									<input type="text" class="form-control" placeholder="{{trans('allclient.name_account')}}" name="name" value="{{ old('name') }}" required autofocus  />
									<span><i class="fa fa-user"></i></span>
									@if ($errors->has('name'))
									<span class="help-block">
										<strong class="text-danger">{{ $errors->first('name') }}</strong>
									</span>
									@endif
								</div>

								<div class="form-group">
									<input type="text" class="form-control" placeholder="{{trans('allclient.email_address')}}" name="email" value="{{ old('email') }}" required autofocus  />
									<span><i class="fa fa-user"></i></span>
									@if ($errors->has('email'))
									<span class="help-block">
										<strong class="text-danger">{{ $errors->first('email') }}</strong>
									</span>
									@endif
								</div>

								<div class="form-group">
									<input id="password" type="password" class="form-control" placeholder="{{trans('allclient.password')}}" name="password" required/>
									<span><i class="fa fa-lock"></i></span>
									@if ($errors->has('password'))
									<span class="help-block">
										<strong class="text-danger">{{ $errors->first('password') }}</strong>
									</span>
									@endif
								</div>

								<div class="form-group">
									<input id="password-confirm" type="password" class="form-control" placeholder="{{trans('allclient.confirm_password')}}" name="password_confirmation" required/>
									<span><i class="fa fa-lock"></i></span>
								</div>
								<div class="form-group">
							          {!! NoCaptcha::renderJs() !!}
							          {!! NoCaptcha::display() !!}
							        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
							      </div>
								<button type="submit" class="btn btn-orange btn-block">{{trans('allclient.register')}}
								</button>
							</form>
							<div class="other-links">
                                    <p class="link-line">{{trans('allclient.already')}}<a href="{{route('client.login')}}">      {{trans('allclient.login_page')}}</a></p>
                                    <!-- @if (Route::has('password.request'))
                                    <a class="simple-link" href="{{ route('password.request') }}">
                                        {{trans('allclient.forgot')}}
                                    </a>
                                	@endif -->
                            </div>
						</div>
						<div class="flex-content-img custom-form-img">
							<!-- <img src="client/images/login.jpg" class="img-responsive" alt="registration-img" /> -->
							<img src="{{ asset('client/imageLayout/o.jpg') }}" class="img-responsive" alt="registration-img" style="max-height: 647px; width: 100%;" />
						</div>
					</div>
				</div>
			</div>
		</div>       
	</div>
</section>
<!--======================= BEST FEATURES =====================-->
@include('client.components.best_features')
<!--========================= NEWSLETTER-1 ==========================-->
@include('client.components.newsletter_1')

@endsection
@section('script1')
@endsection
