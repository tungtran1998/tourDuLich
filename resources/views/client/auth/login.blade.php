@extends('client.layouts.main')
@section('title',trans('allclient.login_page'))
@section('content')
<!--============= PAGE-COVER =============-->
<section class="page-cover" id="cover-login">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.login_page')}}</h1>
				<ul class="breadcrumb">
					<li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
					<li class="active">{{trans('allclient.login_page')}}</li>
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
							<h3>{{trans('allclient.login')}}</h3>
							<form id="login" action="{{ route('client.login') }}" method="POST" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate="">
								@csrf 
								<div class="form-group">
									<input type="text" name="email" class="form-control" placeholder="{{trans('allclient.lq')}}"  required/>
									<span><i class="fa fa-user"></i></span>
								</div>
								<div class="form-group">
									<input type="password" name="password" class="form-control" placeholder="{{trans('allclient.lw')}}"  required/>

									<span><i class="fa fa-lock"></i></span>
								</div>
								<div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{trans('allclient.remember')}}
                                    </label>
                                </div>
								<button type="submit" class="btn btn-orange btn-block">{{trans('allclient.login')}}</button>
								<!--  <a href="{{ url('auth/google') }}" class="btn btn-lg btn-primary btn-block">{{trans('allclient.google')}}
								 </a> -->
							</form>

							<!-- <div class="other-links">
								<a class="link-line" href="{{ route('register') }}">{{trans('allclient.create_an_account')}}</a>
								
								@if (Route::has('password.request'))
                                    <a class="simple-link" href="{{ route('password.request') }}">
                                        {{trans('allclient.forgot')}}
                                    </a>
                                @endif
							</div> -->
						</div>
						<div class="flex-content-img custom-form-img">
							<!-- <img src="client/images/login.jpg" class="img-responsive" alt="registration-img" /> -->
							<img src="{{ asset('client/imageLayout/a.jpg') }}" class="img-responsive" alt="registration-img" style="max-height: 561px; width: 100%;" />
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
