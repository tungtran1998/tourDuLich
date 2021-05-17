@extends('admin.layouts.main')
@section('title',trans('acadmin.listing'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('acadmin.listing')}}</strong>
          @can('admin-create')
          <a class="btn btn-primary btn-sm" href="{{route('admin.create')}}"><i class="fa fa-plus"></i> {{trans('acadmin.addnew')}} </a>
          @endcan
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table  table-hover table-bordered table-striped ">
            <thead>
              <tr>
              <th>{{trans('acadmin.stt')}}</th>
              <th>{{trans('acadmin.name')}}</th>
              <th>{{trans('acadmin.Email')}}</th>
              <th>{{trans('acadmin.role')}}</th>
              <th>{{trans('acadmin.action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($admins as $key => $data)
              <tr>
              <td>{{++$key}}</td>
              <td>{{$data->name}} </td>
              <td>{{$data->email}}</td>
              <td>
                @if(!empty($data->getRoleNames()))
                  @foreach($data->getRoleNames() as $v)
                     <label class="badge badge-success">{{ $v }}</label>
                  @endforeach
                @endif
              </td>
                <td width="100" class="text-center">
                  @can('admin-show')
                  <a href="{{route('admin.show',$data->id)}}"><i class="fa fa-tripadvisor"></i></a>
                  @endcan
                  @can('admin-delete')
                  <a type="button" class="fa fa-trash deletebutton btn" data-id="{{$data->id}}" data-toggle="modal" data-target="#Modal" >
                  @endcan
                  @can('admin-edit')
                  <a href="{{route('admin.edit',$data->id)}}" class="ml-1"><i class="fa fa-pencil"></i></a>
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
{{Form::open(['route' => ['admin_delete'], 'method' => 'DELETE'])}}  
@include('admin.modal.modaldelete')
{{ Form::close() }}
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
