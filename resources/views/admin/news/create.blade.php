@extends('admin.layouts.main')
@section('title',trans('news.create'))
@section('content')
<div class="animated fadeIn">
  <div class="card">
    <div class="card-header">
      <strong class="card-title">{{trans('news.create')}}</strong>
    </div>
    {{ Form::open(['route' => 'news.store', 'method' => 'post','enctype '=>'multipart/form-data']) }}
    <div class="card-body">
      <div class="row col-md-12">
        <div class="col-md-7">
          <div class="form-group">
             {{ Form::label(trans('news.create_tile'),'',['class' => 'font-weight-bold']) }}
            {{ Form::text('title', null, ['class' => 'form-control','placeholder'=> trans('placeholder.title'),'required'  ]) }}
            <span class="text-danger">{{ $errors->first('title')}}</span>
          </div>
          <div class="form-group">
            {{Form::checkbox('hot',null)}}
            <label class="font-weight-bold"><i>{{trans('news.hot')}}</i></label>
          </div>
          <div class="form-group">
                {{ Form::label(trans('tour.province_id'),'',['class' => 'font-weight-bold']) }}
                {{Form::select('province_id',$provinces,null,['class' => " form-control",'placeholder'=>trans('tour.placeholderprovince'),'required'])}}
                <span class="text-danger">{{ $errors->first('province_id')}}</span>
            </div>
          
          
        </div>
        <div class="col-md-5 mt-2">
              <div class="row form-group">
                <div class="col-12">
                  <label for="image" class=" form-control-label font-weight-bold">{{trans('news.image')}}</label>
                </div>
                <div class="col-12">
                  <img class="mb-2 img-thumbnail" id="preview_avatar" src="administration/images/default_image.png" alt="Photo avatar" style="height: 250px;">
                  <input type="file" id="image" name="thumbnail" class="form-control-file" required value="{{old('thumbnail')}}">
                  <span class="text-danger">{{ $errors->first('thumbnail')}} </span>
                </div>
              </div>
            </div>
          <div class="form-group col-md-12">
            {{ Form::label(trans('news.create_content'),'',['class' => 'font-weight-bold']) }}
            {{ Form::textarea('content', null, ['class' => 'form-control','placeholder'=> trans('placeholder.content'), 'id' => 'editor'  ]) }}
            <span class="text-danger">{{ $errors->first('content')}}</span>
          </div>
      </div>
      
    </div>
     <div class="card-footer">
    {{ Form::submit(trans('room.save'),['class' => 'btn btn-primary']) }}
    <a class="btn btn-outline-secondary" href="{{route('news.index')}}"><i class="fa fa-undo" aria-hidden="true"></i>
    </a>
  </div>
  {{ Form::close() }} 
  </div>
</div>
<script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
@endsection
@section('script')
@include('admin.shared.scrip')
<script>
ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
</script>
@include('admin.shared.scriptLoadimage')
@include('admin.shared.notification')
@endsection
