@extends('admin.layouts.main')
@section('title',trans('acadmin.detail'))
@section('content')
<div class="animated fadeIn">
  <div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('acadmin.detail')}} {{$admin->name}}</strong>
        </div>
        <div class="card-body row">
          <div class="col-md-7">
            <p class="font-weight-bold">{{trans('acadmin.name')}}: {{$admin->name}} </p>
            <p class="font-weight-bold">{{trans('acadmin.Email')}}: {{$admin->email}}</p>
            <p class="font-weight-bold">
              {{trans('acadmin.role')}}:
              @if(!empty($admin->getRoleNames()))
              @foreach($admin->getRoleNames() as $v)
              <label class="badge badge-success">{{ $v }}</label>
              @endforeach
              @endif
            </p>
          </div>
        </div>
        <div class="card-footer">
          <a class="btn btn-outline-secondary border-left-primary" href="{{route('admin.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
@section('script')
@endsection
