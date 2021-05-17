@extends('admin.layouts.main')
@section('title',trans('province.detail'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('province.detail')}} {{$province->name}}</strong>
        </div>
        <div class="card-body row">
          <div class="col-md-12">
            <p class="font-weight-bold">{{trans('province.name')}} : {{$province->name}}</p>
            <p class="font-weight-bold">
              @if($province->createByAdmin->name)
              {{trans('province.createby')}} : {{$province->createByAdmin->name}} {{trans('province.time')}} :  
              {{date('H:i | d/m/Y',strtotime($province->created_at))}}
              @endif
              <p class="font-weight-bold">
                @if($province->updateByAdmin->name)
                {{trans('province.updateby')}} : {{$province->updateByAdmin->name}} {{trans('province.time')}} :
                {{date('H:i | d/m/Y',strtotime($province->updated_at))}}
                @endif
              </p>
          </div>
        </div>
        <div class="card-footer">
          <a class="btn btn-outline-secondary" href="{{route('province.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
