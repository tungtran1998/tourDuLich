@extends('admin.layouts.main')
@section('title',trans('province.edit'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{ trans('province.edit') }} {{$province->name}}</strong>
        </div>
        <div class="card-body">
          {{ Form::open(['route' => ['province.update',$province->id], 'method' => 'put','enctype '=>'multipart/form-data']) }}
          <input type="hidden" name="id" value="{{$province->id}}" placeholder=""> 
          <div class="form-group row">
            <div class="col-md-12">
              {{ Form::label(trans('province.name'),'',['class' => 'font-weight-bold']) }}
              {{ Form::text('name', $province->name, ['class' => 'form-control','placeholder'=> trans('placeholder.name'),'required' ]) }}
              <span class="text-danger">{{ $errors->first('name')}}</span>
            </div>
          </div> 
        </div>
        <div class="card-footer">
          {{ Form::submit(trans('province.save'),['class' => 'btn btn-primary']) }}
          <a class="btn btn-outline-secondary" href="{{route('province.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
        {{ Form::close() }} 
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
