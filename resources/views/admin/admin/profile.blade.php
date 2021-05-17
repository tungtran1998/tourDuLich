@extends('admin.layouts.main')
@section('title',trans('acadmin.profile'))
@section('content')
<div class="animated fadeIn">
	<div class="row">
		<div class="col-md-5">
			<div class="card">
				<div class="card-header">
					<strong class="card-title mb-3">{{trans('admin.admin')}}</strong>
				</div>
				<div class="card-body">
					<div class="mx-auto d-block">
						<img class="rounded-circle mx-auto d-block"  width="200px" height="200px" src="administration/images/admin.png" alt="Card image cap">
						<h5 class="text-sm-center mt-2 mb-1">
						</h5>
					</div>
					<hr>
					<div class="card-text row">
						<div class="col-md-6">
						<p>{{trans('acadmin.name')}} : {{$admin->name}} 
						</p>
						
					</div>
					<div class="col-md-6">
						<p>{{trans('admin.created_at')}} : {{$admin->created_at}}</p>
					</div>
					<div class="col-md-12">
						<p>{{trans('admin.email')}} : {{$admin->email}}</p>
					</div>
					<div class="col-md-12">
						<p>{{trans('acadmin.role')}}: @if(!empty($admin->getRoleNames()))
		                  @foreach($admin->getRoleNames() as $v)
		                     <label class="badge badge-success">{{ $v }}</label>
		                  @endforeach
		                @endif</p>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">{{trans('admin.changepassword')}}</strong>
				</div>
				<div class="card-body">
					<form action="{{route('postchange')}}" method="POST">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="font-weight-bold">{{trans('admin.current')}} :</label>
							<input type="password" class="form-control" name="current-password" />
							<span class="text-danger">{{ $errors->first('current-password')}}</span>
						</div>
						<div class="form-group">
							<label class="font-weight-bold">{{trans('admin.new_password')}} :</label>
							<input type="password" class="form-control" name="new-password" />
							<span class="text-danger">{{ $errors->first('new-password')}}</span>
						</div>
						<div class="form-group">
							<label class="font-weight-bold">{{trans('admin.cofirm')}} :</label>
							<input type="password" class="form-control" name="new-password_confirmation"  />
							<span class="text-danger">{{ $errors->first('new-password_confirmation')}}</span>
						</div>
						<button id="save" type="submit" class="btn btn-primary center-block">{{trans('admin.change')}}</button>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
