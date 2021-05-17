@extends('admin.layouts.main')
@section('title',trans('booktour.Tourbookinglisting'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{ trans('booktour.Tourbookinglisting') }}</strong>
          @can('booktour-export')
          <a  class="btn btn-outline-success btn-sm" href="{{route('booktour.export')}}"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
          @endcan
        </div>
        <div class="card-body">
          <table id="bootstrap-data-table" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>{{ trans('booktour.stt') }}</th>
                <th>{{ trans('booktour.Tourbookingcode') }}</th>
                <th>{{ trans('booktour.Tourname') }}</th>
                <th>{{ trans('booktour.Dateofbooking') }}</th>
                <th>{{ trans('booktour.Status') }}</th>
                <th>{{ trans('booktour.Totalmoney') }}</th>
                <th>{{ trans('roomtype.action') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach($booktour as $key => $data)
              <tr>
                <td>{{++$key}}</td>
                <td>{{$data->book_code}}</td>
                <th>{{$data->tour_book->tour_name}}</th>
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
                  @can('booktour-edit')
                  <a href="{{route('booktour.show',$data->id)}}"><i class="fa fa-tripadvisor"></i></a>
                  
                  @endcan()
                  <!-- a type="button" class="fa fa-trash deletebutton btn" data-id="{{$data->id}}" data-toggle="modal" data-target="#Modal" >
                  </a> -->
                  
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
{{Form::open(['route' => ['booktour_delete'], 'method' => 'DELETE'])}}  
@include('admin.modal.modaldelete')
{{ Form::close() }}
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
