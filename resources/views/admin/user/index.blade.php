@extends('admin.layouts.main')
@section('title',trans('user.listing'))
@section('content')
<div class="animated fadeIn">
  <div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('user.listing')}}</strong>
          @can('user-export')
          <a  class="btn btn-outline-success btn-sm" href="{{route('user.export')}}"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
          @endcan
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table  table-hover table-bordered table-striped ">
            <thead>
              <tr>
                <th>{{trans('user.stt')}}</th>
                <th>{{trans('user.useraccout')}}</th>
                <th>{{trans('user.Email')}}</th>
                <th>{{trans('user.Status')}}</th>
                <th>{{trans('user.action')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $key => $data)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$data->username}}</td>
                <td>{{$data->email}}</td>
                 <td>
                  <form id="data_status_edit" action="{{route('user.editStatus', ['id'=>$data->id])}}" method="post" enctype="multipart/form-data" class="form-horizontal" data-parsley-validate="">
                    @csrf 
                    @if($data->status == 0)
                    <select style="padding: 0px;font-size: 15px;" name="status" id="booking_status" class="form-control" data-parsley-trigger="change">                          
                      <option value="0" selected="selected" >{{trans('user.Active')}}</option>
                      <option value="1">{{trans('user.Paused')}}</option>
                    </select>
                     @can('user-edit')
                    <button type="submit"  class="btn btn-primary btn-sm">
                      <i class="fa fa-dot-circle-o"></i> {{trans('user.save')}}
                    </button>
                    @endcan
                    @else
                    <select style="padding: 0px;font-size: 15px; " name="status" id="booking_status" class="form-control" data-parsley-trigger="change">                          
                      <option value="0"  >{{trans('user.Active')}}</option>
                      <option value="1" selected="selected">{{trans('user.Paused')}}</option>
                    </select>
                    @can('user-edit')
                    <button type="submit"  class="btn btn-primary btn-sm btn-op">
                      <i class="fa fa-dot-circle-o"></i> {{trans('user.save')}}
                    </button>
                    @endcan
                    @endif
                  </form>	
                </td>
                <td width="100" class="text-center">
                  @can('user-show')
                  <a href="{{route('user.show',$data->id)}}"><i class="fa fa-tripadvisor"></i></a>
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
{{Form::open(['route' => ['user_delete'], 'method' => 'DELETE'])}}  
@include('admin.modal.modaldelete')
{{ Form::close() }}
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
