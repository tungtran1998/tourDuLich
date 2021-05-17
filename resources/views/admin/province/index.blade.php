@extends('admin.layouts.main')
@section('title',trans('province.listing'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{ trans('province.listing') }}</strong>
          @can('provinces-create')
          <a class="btn btn-primary btn-sm ml-2" href="{{route('province.create')}}"><i class="fa fa-plus"></i> {{ trans('province.addnew') }}</a>
          @endcan
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>{{ trans('province.stt') }}</th>
                <th>{{ trans('province.name') }}</th>
                <th>{{ trans('province.action') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($provinces as $key => $data)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$data->name}}</td>
                <td width="100" class="text-center">
                  @can('provinces-show')
                  <a href="{{route('province.show',$data->id)}}"><i class="fa fa-tripadvisor"></i></a>
                  @endcan
                  @can('provinces-delete')
                  <a type="button" class="fa fa-trash deletebutton btn" data-id="{{$data->id}}" data-toggle="modal" data-target="#Modal" >
                  </a>
                  @endcan
                  @can('provinces-edit')
                  <a href="{{route('province.edit',$data->id)}}" class="ml-1"><i class="fa fa-pencil"></i></a> 
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
{{Form::open(['route' => ['province_delete'], 'method' => 'DELETE'])}}  
@include('admin.modal.modaldelete')
{{ Form::close() }}
@endsection
@section('script')
@include('admin.shared.scriptModalDialog')
@include('admin.shared.notification')
@endsection
