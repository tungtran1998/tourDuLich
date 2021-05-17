@extends('client.layouts.main')
@section('title',$data->tour_name )
@section('content')
@section('content')
@php
if(Auth::check()){
$fullname = Auth::user()->first_name.' '.Auth::user()->last_name;
$email = Auth::user()->email;
$phone = Auth::user()->phone;
}else{
$fullname = '';
$email = '';
$phone = '';
}
@endphp
<section class="page-cover" id="cover-hotel-grid-list">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="page-title">{{trans('allclient.TourDetails')}}</h1>
        <ul class="breadcrumb">
          <li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
          <li class="active">{{ $data->tour_name }}</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<section class="innerpage-wrapper">
  <div id="hotel-details" class="innerpage-section-padding">
    <div class="container">
      
      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-4 side-bar left-side-bar">
          <div class="side-bar-block booking-form-block">
            <div class="booking-form">
             <h4>{{trans('allclient.Booknowjust')}} (028) 3933 8002</h4>
             @if (session('success'))
             <div class="alert alert-success">
              {{session('success')}}
            </div>
            @endif
            @if (session('errorSQL'))
            <div class="alert alert-danger">
              {{session('errorSQL')}}
            </div>
            @endif
            <label>{{trans('allclient.Departuredate')}}: {{date('d/m/Y',strtotime($data->departure_date))}} </label>
            <label>{{trans('allclient.Departuretime')}}: {{$data->departure_time}}</label>
            <label>{{trans('allclient.Returndate')}}: {{date('d/m/Y',strtotime($data->return_date))}}</label>
            <label>{{trans('allclient.Vehicle')}}: {{$data->vehicle}}</label>
            <label>{{trans('allclient.Startingpoint')}}: {{$data->departure_location}}</label>
            {!! Form::open(['url' => ['check_tour'], 'method' => 'POST']) !!}
            @csrf
            <input type="hidden" name="id" value="{{$data->id}}" placeholder=""> 
            <label>{{trans('allclient.fullname')}}</label>
            <div class="form-group">
              {{Form::text('fullname', $fullname,['class' => 'form-control','placeholder' => trans('allclient.20qaz'),'required'])}}   
              <span class="text-danger">{{ $errors->first('fullname')}}</span>                                    
            </div>
            <label>Email</label>
            <div class="form-group">
              {{Form::email('email', $email,['class' => 'form-control','placeholder' => trans('allclient.21qaz')])}}  
              <span class="text-danger">{{ $errors->first('email')}}</span>                                     
            </div>
            <label>{{trans('allclient.phone')}}</label>
            <div class="form-group">
              {{Form::number('phone', $phone,['class' => 'form-control','placeholder' =>trans('allclient.22qaz')])}}
              <span class="text-danger">{{ $errors->first('phone')}}</span>                                      
            </div>
            <div class="form-group">
              <label>{{trans('allclient.adult')}}:</label>
              {{Form::number('adult', null,['class' => 'form-control','placeholder' => trans('allclient.required.adult') ])}}   
              <span class="text-danger">{{ $errors->first('adult')}}</span>                                    
            </div>
            <label>{{trans('allclient.children')}}:</label>
            <div class="form-group">
              {{Form::number('kid', null,['class' => 'form-control','placeholder' => trans('allclient.required.kid')])}}  
              <span class="text-danger">{{ $errors->first('kid')}}</span>                       
            </div>
            <label>{{trans('allclient.Roomnumber')}}:</label>
            <div class="form-group">
              {{Form::number('single_room', null,['class' => 'form-control','placeholder' => trans('allclient.Pleaseenter')])}}  
              <span class="text-danger">{{ $errors->first('single_room')}}</span>                       
            </div>
            <div class="form-group">
              <label>{{trans('allclient.note')}}: </label>
              {{Form::textarea('message', '',['class' => 'form-control','placeholder' => trans('allclient.enter_note'),'rows'=>'1'])}}
              <span class="text-danger">{{ $errors->first('message')}}</span>
            </div>
            <div class="checkbox custom-check">
              <input type="checkbox" id="check01" name="checkbox" required/>
              <label for="check01"><span><i class="fa fa-check"></i></span>{{trans('allclient.agree')}} <a href="{{route('term')}}">{{trans('allclient.term_policy')}}</a></label>
            </div>
            <button type="submit" class="btn btn-block btn-orange  fl_right">{{trans('allclient.Booktournow')}}</button>
            {!! Form::close() !!}
          </div>
        </div>
        <div class="row">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-9 col-lg-8 content-side">
        <h1 class="font-weight-bold border">{{$data->tour_name}}</h1>  
        <div class="detail-slider">
          <div class="feature-slider">
              <img class="card-img" src="{{ asset('administration/imagerooms').'/'.$data->tour_image }}" class="img-responsive" alt="feature-img" style="width: 848px; height: 494px;"/>
          </div>
          <div class="col-md-6">
            <h4>{{trans('allclient.Pricelist')}}<hr></h4>
          <ul>
            <li>{{trans('allclient.adult')}}: {{number_format($data->price_adult)}} VND</li>
            <li> {{trans('allclient.kid')}}:  {{number_format($data->price_kid)}} VND</li>
            <li>{{trans('allclient.Singleroomprice')}}: {{number_format($data->single_room_price)}} VND</li>
            <li> {{trans('allclient.Startingpoint')}}: {{$data->departure_location}}</li>
          </ul>
          <hr>
          </div>
          <div class="col-md-6">
            <h4>{{trans('allclient.Information')}}<hr></h4>
          <ul>
            <li>{{trans('allclient.Promotion')}}: {{$data->discount}} %</li>
            <li>{{trans('allclient.TourCode')}}: {{$data->tour_code}} </li>
            <li>{{trans('allclient.Destination')}}: {{$data->destination}} </li>
            <li>{{trans('allclient.Time123')}}: {{$data->number_of_day}} {{trans('allclient.day12323')}} </li>
          </ul>
          <hr>
          </div>
          {!! $data->tour_detail !!}
          <h3>{{trans('allclient.Thetour')}}</h3>
          {!! $data->tour_program !!}
         
          @if($data->tour_note)
           <h3>{{trans('allclient.LuuY')}}</h3>
          {!! $data->tour_note !!}
          @endif
        </div>   
      </div>
      @include('client.components.cruise_offers')
    </div>
  </div>
</div>
</div>

</section>
@endsection
@section('script1')
<script>
  $(document).ready(function(){
    $('.home-status').removeClass('active');
    $('.top-tour-status').addClass('active');
  });
  document.getElementById("payment").onchange = function() {
    if(this.value==1){
      $('.payment').show();
    }
    else{
      $('.payment').hide();
    }
  }
</script>
@endsection