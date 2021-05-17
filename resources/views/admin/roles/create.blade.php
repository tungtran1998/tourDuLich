@extends('admin.layouts.main')
@section('title',trans('role.create'))
@section('content')

<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card show">
        <div class="card-header">
          <strong class="card-title">{{trans('role.create')}}</strong>
        </div>
        <div class="card-body">
          {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!} 
          <div class="form-group row">
            <div class="col-md-12">
              {{ Form::label(trans('role.name'),'',['class' => 'font-weight-bold']) }}
              {!! Form::text('name', null, array('placeholder'=> trans('placeholder.name'),'class' => 'form-control')) !!}
              <span class="text-danger">{{ $errors->first('name')}}</span>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong class="font-weight-bold">{{trans('role.permission')}}:</strong>
                    <br/>
                    @foreach($permission as $value)
                        <label class="mr-2 btn btn-outline-info">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->name }}</label>
                    @endforeach
                </div>
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
