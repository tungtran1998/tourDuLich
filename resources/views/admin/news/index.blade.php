@extends('admin.layouts.main')
@section('title',trans('news.title'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('news.title')}}</strong>
          @can('new-create')
          <a class="btn btn-primary btn-sm" href="{{route('news.create')}}"><i class="fa fa-plus"></i> {{trans('room.addnew')}}</a>
          @endcan
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>{{trans('news.stt')}}</th>
                <th>{{trans('news.new_tile')}}</th>
                <th>Provincial</th>
                <th>{{trans('news.status')}}</th>
                <th class="text-center">{{trans('news.thumbnail')}}</th>
                <th>{{trans('news.action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($news as $key => $data)
              <tr>
                <td>{{++$key}}</td>
                <td>
                  {{substr(strip_tags($data->title), 0, 100)."..." }}
                </td>
                <td>{{$data->provences->name}}</td>
                <td>
                  @if($data->status == '0')
                  <span class="badge badge-success">{{trans('news.display')}}</span>
                  @else
                  <span class="badge badge-danger">{{trans('news.nodisplay')}}</span>
                  @endif  
                </td>
                <td class="text-center">
                   <img class="rounded-circle" src="{{ asset('administration/imageNews').'/'.$data->thumbnail }}" alt="Photo avatar" width="100px" height="100px">
                </td>
                <td width="100" class="text-center">
                  @can('new-show')
                  <a href="{{route('news.show',$data->id)}}"><i class="fa fa-tripadvisor"></i></a>
                  @endcan
                  @can('new-delete')
                  <a type="button" class="fa fa-trash deletebutton btn" data-id="{{$data->id}}" data-toggle="modal" data-target="#Modal" > </a>
                  @endcan
                  @can('new-edit')
                  <a href="{{route('news.edit',$data->id)}}" class="ml-1"><i class="fa fa-pencil"></i></a> 
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
{{Form::open(['route' => ['news_delete'], 'method' => 'DELETE'])}}  
@include('admin.modal.modaldelete')
{{ Form::close() }}
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
