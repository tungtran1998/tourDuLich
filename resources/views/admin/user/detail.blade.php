@extends('admin.layouts.main')
@section('title',trans('user.detail'))
@section('content')
<div class="animated fadeIn">
  <div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('user.detail')}} {{$user->username}}</strong>
        </div>
        <div class="card-body row">
          <div class="col-md-7">
            <p class="font-weight-bold">{{trans('user.name')}}: {{$user->first_name}} {{$user->last_name}}</p>
            <p class="font-weight-bold">{{trans('user.useraccout')}}: {{$user->username}}</p>
            <p class="font-weight-bold">
              @if($user->google_id)
              {{trans('user.google')}}
            @endif</p>
            <p class="font-weight-bold">{{trans('user.Gender')}}: 
             @if($user->gender == '0')
             {{trans('user.Male')}}
             @else
             {{trans('user.Female')}}
             @endif
           </p>
           <p class="font-weight-bold">{{trans('user.Email')}}: {{$user->email}}</p>
           <p class="font-weight-bold">{{trans('user.Street')}}: {{$user->street}}</p>
           <p class="font-weight-bold">{{trans('user.State')}}: {{$user->state}}</p>
           <p class="font-weight-bold">{{trans('user.City')}}: {{$user->city}}</p>
           <p class="font-weight-bold">{{trans('user.Phone')}}: {{$user->phone}}</p>
           <p class="font-weight-bold">{{trans('user.Nationality')}}: {{$user->nationality}}</p>
           <p class="font-weight-bold">{{trans('user.Dateofbirth')}}: {{date('d/m/Y',strtotime($user->dateofbirth))}}</p>
           <p class="font-weight-bold">{{trans('user.Status')}}:
            @if($user->status == '0')
            {{trans('user.Active')}}
            @else
            {{trans('user.Paused')}}
            @endif
          </p> 
        </div>

        <div class="col-md-5">
          <img class="img-thumbnail" id="preview_avatar" src="{{ asset('administration/imageRooms').'/'.$user->image }}" alt="Photo avatar" >
        </div>
      </div>
      <div class="card-footer">
        <a class="btn btn-outline-secondary" href="{{route('user.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
        
      </div>	
    </div>
  </div>
</div>
@if($tour->isEmpty())
  <hr>
  <p class="text-center text text-info">This account has no bookings yet!</p>
  @else
  <div class="card">

    <div class="card-header">
      <strong class="card-title">Tour booking history</strong>
    </div>
    <div class="card-body">
      <table id="bootstrap-data-table" class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>{{ trans('booking.stt') }}</th>
            <th>{{ trans('admin.Tourbookingcode') }}</th>
            <th>{{ trans('admin.Dateofbooking') }}</th>
            <th>{{ trans('admin.Status') }}</th>
            <th>{{ trans('admin.Totalmoney') }}</th>
            <th>{{ trans('admin.action') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tour as $key => $data)
          <tr>
            <td>{{ ++$key }}</td>
            <td >{{$data->book_code}}
            </td>
            <td>{{ date('H:i || d-m-Y ',strtotime($data->transaction_date)) }}
            </td>
            <td>
              @if($data->status==0)
              <h5><span class="label label-danger">{{trans('allclient.hy')}}<i class="fa fa-info-circle" aria-hidden="true"></i></span></h5>
              @elseif($data->status==1)
              <h5><span class="label label-info">{{trans('allclient.hu')}}<i class="fa fa-check-circle" aria-hidden="true"></i></span></h5>
              @elseif($data->status==2)
              <h5><span class="label label-success">{{trans('allclient.hi')}}<i class="fa fa-money" aria-hidden="true"></i></span></h5>
              @else
              <h5><span class="label label-primary">{{trans('allclient.ho')}}<i class="fa fa-money" aria-hidden="true"></i></span></h5>
              @endif
            </td>
            <td>{{number_format($data->total_amount)}} VND</td>
            <td><a href="{{route('booktour.show',$data->id)}}">{{trans('allclient.hp')}}</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <a class="btn btn-outline-secondary" href="{{route('user.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>

    </div>
    @endif
  </div>
</div>
@endsection
@section('script')
@endsection
