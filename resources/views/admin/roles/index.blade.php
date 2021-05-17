@extends('admin.layouts.main')
@section('title',trans('role.listing'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="card-header">
          <strong class="card-title">{{trans('role.listing')}}</strong>
          @can('role-create')
          <a class="btn btn-primary btn-sm" href="{{route('roles.create')}}"><i class="fa fa-plus"></i>
          {{trans('role.addnew')}}
          </a>
          @endcan
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table table-hover table-bordered  table-striped">
            <thead>
              <tr>
                <th>{{trans('role.stt')}}</th>
                <th>{{trans('role.name')}}</th>
                <th>{{trans('role.action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($roles as $key => $role)
              <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td width="100" class="text-center">
                  @can('role-delete')
                  <a href="{{route('roles.show',$role->id)}}"><i class="fa fa-tripadvisor"></i></a>
                  @endcan
                  @can('role-show') 
                   <a type="button" class="fa fa-trash deletebutton btn" data-id="{{$role->id}}" data-toggle="modal" data-target="#Modal" >
                  @endcan
                  @can('role-edit')
                  <a href="{{route('roles.edit',$role->id)}}" class="ml-1"><i class="fa fa-pencil"></i></a>
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
{{Form::open(['route' => ['role_delete'], 'method' => 'DELETE'])}}  
@include('admin.modal.modaldelete')
{{ Form::close() }}
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
