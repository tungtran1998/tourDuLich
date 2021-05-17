@extends('admin.layouts.main')
@section('title',trans('tour.detail'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('tour.detail')}} {{$tour->tour_name}}</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <div class="row">
                <div class="col-md-6">
                  <ul class="list-group">
                  <li class="list-group-item">
                    {{trans('tour.tour_code')}}: {{$tour->tour_code}}
                  </li>
                  <li class="list-group-item">
                    {{trans('tour.tour_name')}}: {{$tour->tour_name}}
                  </li>
                  <li class="list-group-item">
                    {{trans('tour.departure_location')}}: {{$tour->departure_location}}
                  </li>
                  <li class="list-group-item">
                    {{trans('tour.destination')}}: {{$tour->destination}}
                  </li>
                  <li class="list-group-item">
                    Provincial: {{$tour->provences->name}}
                  </li>
                  <li class="list-group-item">
                    {{trans('tour.price_adult')}}: {{number_format($tour->price_adult)}} VND
                  </li>
                  <li class="list-group-item">
                    {{trans('tour.price_kid')}}: {{number_format($tour->price_kid)}} VND
                  </li>
                  <li class="list-group-item">
                   @if($tour->createByAdmin->name)
                    {{trans('tour.createby')}} : {{$tour->createByAdmin->name}} {{trans('tour.time')}} :  
                    {{date('H:i | d/m/Y',strtotime($tour->created_at))}}
                    @endif
                  </li>
                </ul>
                </div>
                <div class="col-md-6">
                  <ul class="list-group">
                  <li class="list-group-item">
                    {{trans('tour.single_room_price')}}: {{number_format($tour->single_room_price)}} VND
                  </li>
                  <li class="list-group-item">
                    Promotion: {{$tour->discount}} %
                  </li>
                  <li class="list-group-item">
                    {{trans('tour.status')}}:
                    @if($tour->status == '0')
                    {{trans('tour.display')}}
                    @else
                    {{trans('tour.non-display')}}
                    @endif
                  </li>
                  <li class="list-group-item">
                    {{trans('tour.number_of_day')}}: {{$tour->number_of_day}}
                  </li>
                  <li class="list-group-item">
                   {{trans('tour.departure_time')}}: {{$tour->departure_time}}
                  </li>
                  <li class="list-group-item">
                   {{trans('tour.return_date')}}: {{$tour->return_date}}
                  </li>
                  <li class="list-group-item">
                   {{trans('tour.vehicle')}}: {{$tour->vehicle}}
                  </li>
                  <li class="list-group-item">
                   Amount of people: {{$sl_n}}/{{$tour->count_people}}
                  </li>

                  
                  <li class="list-group-item">
                    @if($tour->updateByAdmin->name)
                  {{trans('tour.updateby')}} : {{$tour->updateByAdmin->name}} {{trans('tour.time')}} :
                  {{date('H:i | d/m/Y',strtotime($tour->updated_at))}}
                  @endif
                  </li>

                </ul>
                </div>

                 
              </div>
              </div>
              <div class="col-md-4">
                <div class="col-md-12">
                  <label for="image" class=" form-control-label font-weight-bold">{{trans('tour.image')}}<span class="text text-danger"></span></label>
                </div>

                <div class="col-md-12">
                  <img class="mt-3 img-thumbnail" id="preview_avatar" src="{{ asset('administration/imagerooms').'/'.$tour->tour_image }}" alt="Photo avatar" style="height: 250px;" >
                </div>


              </div>
            </div>
            <br>
            <p class="font-weight-bold">{{trans('tour.tour_detail')}}: </p>
            <hr>
            {!! $tour->tour_detail !!}
            <p class="font-weight-bold">{{trans('tour.tour_note')}}: </p>
            <hr>
            {!! $tour->tour_note !!}
            <p class="font-weight-bold">{{trans('tour.tour_program')}}: </p>
            <hr>
            {!! $tour->tour_program !!}
          </div>

            <div class="card-footer">
              <a class="btn btn-outline-secondary" href="{{route('tour.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endsection
    @section('script')
    @endsection
