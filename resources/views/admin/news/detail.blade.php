@extends('admin.layouts.main')
@section('title',trans('news.detail'))
@section('content')
<div class="animated fadeIn">
  <div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('news.detail')}} {{$news->title}}</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <h2 class="text-center mb-3"><strong>{{$news->title}}</strong></h2>
               <p class="font-weight-bold">
              @if($news->createByAdmin->name)
              {{trans('news.createby')}} : {{$news->createByAdmin->name}} {{trans('news.time')}} :  
              {{date('H:i | d/m/Y',strtotime($news->created_at))}}
              @endif
            </p>
              <p class="font-weight-bold">
                @if($news->updateByAdmin->name)
                {{trans('news.updateby')}} : {{$news->updateByAdmin->name}} {{trans('news.time')}} :
                {{date('H:i | d/m/Y',strtotime($news->updated_at))}}
                @endif
              </p>

              <p class="font-weight-bold">{{trans('news.status')}}:
                @if($news->status == '0')
                {{trans('news.display')}}
                @else
                {{trans('news.nodisplay')}}
                @endif
              </p>
              <p class="font-weight-bold">Provincial: {{$news->provences->name}}</p> 
              <div class="form-group">
                @if($news->hot == true)
                {{ Form::checkbox('hot', '1', true) }}
                @else
                {{ Form::checkbox('hot', '0') }}
                @endif
                <label class="font-weight-bold"><i>{{trans('news.hot')}}</i></label>
              </div>
              <p class="font-weight-bold">{!! $news->content !!}</p>
            </div>
          </div>

        </div>
        <div class="card-footer">
          <a class="btn btn-outline-secondary border-left-primary" href="{{route('news.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
