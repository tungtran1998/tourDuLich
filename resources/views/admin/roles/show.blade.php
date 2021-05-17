@extends('admin.layouts.main')
@section('title',trans('role.detail'))
@section('content')
<div class="animated fadeIn">
  <div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('role.detail')}} {{ $role->name }}</strong>
        </div>
        <div class="card-body">
          <p class="font-weight-bold">{{trans('role.name')}} : {{ $role->name }}</p>
          <p class="font-weight-bold">{{trans('role.permission')}} : </p>
          @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <label class="mr-2 btn btn-outline-info">{{ $v->name }}</label>
                @endforeach
            @endif
          </div>
          <div class="card-footer">
            <a class="btn btn-outline-secondary" href="{{route('roles.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
  @section('script')
  @endsection
