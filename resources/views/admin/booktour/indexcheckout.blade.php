@extends('admin.layouts.main')
@section('title',trans('admin.roomcheckout'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{ trans('admin.roomcheckout') }}</strong>
          @can('booking-export')
          <a  class="btn btn-outline-success btn-sm" href="{{route('booking.export')}}"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
          @endcan
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>{{ trans('booking.stt') }}</th>
                <th>{{ trans('booking.booking-code') }}</th>
                <th>{{ trans('booking.transaction-date') }}</th>
                <th>{{ trans('booking.status') }}</th>
                <th>{{ trans('booking.total-amount') }}</th>
                <th>{{ trans('roomtype.action') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($booking as $key => $data)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$data->booking_code}}</td>
                <td>{{date('H:i | d/m/Y',strtotime($data->transaction_date))}} </td>
                <td>
                  @if($data->status == '0')
                    <span class="badge badge-danger">{{trans('booking.unconfirm')}}</span>
                  @elseif($data->status == '1')
                    <span class="badge badge-success">{{trans('booking.cofirmed')}}</span>
                  @elseif($data->status == '2')
                    <span class="badge badge-primary">{{trans('booking.check-in')}}</span>
                  @else
                  <span class="badge badge-info">{{trans('booking.check-out')}}</span>
                  @endif
                </td>
                <td>{{number_format($data->total_amount)}}</td>
                <td width="100" class="text-center">
                  @can('booking-edit')
                  <a href="{{route('booking.show',$data->id)}}"><i class="fa fa-tripadvisor"></i></a>
                  @endcan()
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
{{Form::open(['route' => ['booking_delete'], 'method' => 'DELETE'])}}  
@include('admin.modal.modaldelete')
{{ Form::close() }}
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
