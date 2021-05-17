@extends('admin.layouts.main')
@section('title',trans('feedback.list'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('feedback.list')}}</strong>
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th class="text-center" width="7%">{{trans('feedback.stt')}}</th>
                <th class="text-center" width="17%">{{trans('feedback.name')}}</th>
                <th class="text-center" width="30%">{{trans('feedback.title')}}</th>
                <th class="text-center" width="15%">{{trans('feedback.email')}}</th>
                <th class="text-center">{{trans('feedback.ReplyBy')}}</th>
                <th class="text-center">{{trans('feedback.Action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($feedbacks as $key => $data)
              @if($data->reply_by)
              <tr class="table-success">
                @else
                <tr>
                  @endif
                  <td>{{++$key}}</td>
                  <td>{{$data->name}}</td>
                  <td>{{$data->title}}</td>
                  <td>{{$data->email}}</td>
                  <td class="text-center">
                    @if($data->reply_by)
                      {{$data->reply_by}}
                    @else
                    {{trans('feedback.Noresponseyet')}}
                    @endif
                  </td>
                  <td class="text-center" width="100">
                  @can('feedback-reply')
                  <a href="{{route('feedback.reply',$data->id)}}"><i class="fa fa-tripadvisor"></i>
                  </a>
                  @endcan
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
