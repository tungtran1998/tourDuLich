@extends('admin.layouts.main')
@section('title',trans('role.edit'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('role.edit')}} {{$role->name}}</strong>
        </div>
        <div class="card-body">
          {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
          
          <div class="form-group row">
            <div class="col-md-12">
              {{ Form::label(trans('role.name'),'',['class' => 'font-weight-bold']) }}
              {!! Form::text('name', null, array('placeholder'=> trans('placeholder.name'),'class' => 'form-control')) !!}
              <span class="text-danger">{{ $errors->first('name')}}</span>
            </div>
            <div class="col-md-12 mt-2">
              {{ Form::label(trans('role.permission'),'',['class' => 'font-weight-bold']) }}
              <br/>
              @foreach($permission as $value)
                  <label class="mr-2 btn btn-outline-info">{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                  {{ $value->name }}</label>
              @endforeach
              <span class="text-danger">{{ $errors->first('permission')}}</span>
            </div>
          </div>
        </div>
        <div class="card-footer">
          {{ Form::submit(trans('role.save'),['class' => 'btn btn-primary']) }}
          <a class="btn btn-outline-secondary" href="{{route('roles.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
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
