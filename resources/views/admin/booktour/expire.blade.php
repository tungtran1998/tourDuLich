@extends('admin.layouts.main')
@section('title',trans('booking.detail'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('admin.list_booking_expire')}}</strong>
        </div>
        <div class="card-body">
          <div class="row">
            @foreach($data as $key=>$data)
            <div class="col-md-6">
              <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                  <strong class="d-inline-block mb-2 text-success">{{$data->booking_code}}</strong>
                  <h4 class="mb-0">
                    <strong class="d-inline-block mb-2 text-dark">{{$data->fullname}}</strong>
                  </h4>
                  <ul class="ml-4">
                    <li>{{trans('admin.from')}} {{date('d-m-Y', strtotime($data->check_in_date))}}</li>
                    <li>{{trans('admin.to')}} <b class="text-danger">{{date('d-m-Y', strtotime($data->check_out_date))}}</b> ({{trans('admin.tomorrow')}})</li>
                    <li>{{trans('admin.total')}} <b>{{number_format($data->total_amount)}}</b> VND</li>
                    <li>Email <b>{{$data->email}}</b></li>
                  </ul>
                  <a style="color: green" href="{{route('bookingExpire',$data->email)}}"><b>{{trans('admin.send_noti')}}</b></a>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 200px;" src="@if ($data->users->image == null)   
                                                client/images/user_default.png
                                                @else
                                                administration/imageRooms/{{$data->users->image}}
                          @endif" data-holder-rendered="true">

              </div>
            </div>
            @endforeach
              
          </div>
        </div>
       <div class="card-footer">
        <a class="btn btn-outline-secondary" href="{{url('admin/dashboard')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
      </div>
    </div>
  </div>
</div>
</div>

@endsection
@section('script')
@include('admin.shared.notification')
@endsection
