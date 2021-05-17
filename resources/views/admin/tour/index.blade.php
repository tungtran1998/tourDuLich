@extends('admin.layouts.main')
@section('title',trans('tour.listing'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('tour.listing')}}</strong>
           @can('tours-create')
          <a class="btn btn-primary btn-sm" href="{{route('tour.create')}}"><i class="fa fa-plus"></i> {{trans('tour.addnew')}}</a>
          @endcan
          @can('tours-export')
          <a  class="btn btn-outline-success btn-sm" href="{{route('tour.export')}}"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
          @endcan
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>STT</th>
                <th>{{trans('admin.TourCode')}}</th>
                <th>{{trans('admin.TourName')}}</th>
                <th>{{trans('admin.Departure')}}</th>
                <th>{{trans('admin.Provincial')}}</th>
                <th>{{trans('admin.Timestart')}}</th>
                <th>{{trans('admin.Status')}}</th>
                <th>{{trans('admin.Actions')}}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tours as $key => $data)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$data->tour_code}}</td>
                <td>{{$data->tour_name}}</td>
                <td>{{$data->departure_location}}/{{$data->destination}}</td>
                <td>{{$data->provences->name}}</td>
                <td>{{$data->departure_time}} / {{$data->departure_date}} || {{$data->return_date}}</td>
                <td>
                  @if($data->status == '0')
                    <span class="badge badge-success">{{trans('admin.Display')}}</span>
                  @else
                    <span class="badge badge-danger">{{trans('admin.Notdisplay')}}</span>
                  @endif  
                </td>
                <td width="100px" class="text-center">
                   @can('tours-show')
                  <a href="{{route('tour.show',$data->id)}}"><i class="fa fa-tripadvisor"></i></a>
                  @endcan
                  @can('tours-delete')
                  <a type="button" class="fa fa-trash deletebutton btn" data-id="{{$data->id}}" data-toggle="modal" data-target="#Modal" ></a>
                 @endcan
                  @can('tours-edit')
                  <a href="{{route('tour.edit',$data->id)}}" class="ml-1"><i class="fa fa-pencil"></i></a>
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
{{Form::open(['route' => ['tour_delete'], 'method' => 'DELETE'])}}  
@include('admin.modal.modaldelete')
{{ Form::close() }}
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
