@extends('admin.layouts.main')
@section('title',trans('tour.create'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card show">
        <div class="card-header">
          <strong class="card-title">{{trans('tour.create')}}</strong>
        </div>
        <div class="card-body"> 
          {{ Form::open(['route' => 'tour.store', 'method' => 'post','enctype '=>'multipart/form-data', 'files' => true]) }} 
          <div class="form-group row">
            <div class="col-md-7 row">
              <div class="col-md-12 mb-1">
                {{ Form::label(trans('tour.tour_name'),'',['class' => 'font-weight-bold']) }}
                {{ Form::text('tour_name', null, ['class' => 'form-control','placeholder'=> trans('tour.placeholdertourname'),'required' ]) }}
                <span class="text-danger">{{ $errors->first('tour_name')}}</span>
              </div>
              <div class="col-md-6 mb-1">
                <label class="font-weight-bold">{{trans('tour.vehicle')}}</label>
                <input type="text" name="vehicle" class="form-control" required placeholder="{{trans('tour.placeholdervehicle')}}">
                <span class="text-danger">{{ $errors->first('vehicle')}}</span>
              </div>
              <div class="col-md-6 mb-1">
                {{ Form::label(trans('tour.departure_location'),'',['class' => 'font-weight-bold']) }}
                {{ Form::text('departure_location', null, ['class' => 'form-control','placeholder'=> trans('tour.placeholderdeparturelocation'),'required' ]) }}
                <span class="text-danger">{{ $errors->first('departure_location')}}</span>
              </div>
              <div class="col-md-6 mb-1">
                {{ Form::label(trans('tour.destination'),'',['class' => 'font-weight-bold']) }}
                {{ Form::text('destination', null, ['class' => 'form-control','placeholder'=> trans('tour.placeholderdestination'),'required' ]) }}
                <span class="text-danger">{{ $errors->first('destination')}}</span>
              </div>

              <div class="col-md-6 mb-1">
                {{ Form::label(trans('tour.province_id'),'',['class' => 'font-weight-bold']) }}
                {{Form::select('province_id',$provinces,null,['class' => " form-control",'placeholder'=>trans('tour.placeholderprovince'),'required'])}}
                <span class="text-danger">{{ $errors->first('province_id')}}</span>
              </div>

              <div class="col-md-6 mb-1">
                {{ Form::label(trans('tour.status'),'',['class' => 'font-weight-bold']) }}
                {{ Form::select('status', array('0' => trans('tour.display'), '1' => trans('tour.non-display')),null,['class' => 'form-control','required'])}}
                <span class="text-danger">{{ $errors->first('status')}}</span>
              </div>

              <div class="col-md-6 mb-1">
                {{ Form::label(trans('tour.price_adult'),'',['class' => 'font-weight-bold']) }}
                {{ Form::number('price_adult', null, ['class' => 'form-control','placeholder'=> trans('tour.placeholderprice_adult'),'required' ]) }}
                <span class="text-danger">{{ $errors->first('price_adult')}}</span>
              </div>
              <div class="col-md-6 mb-1">
                {{ Form::label(trans('tour.price_kid'),'',['class' => 'font-weight-bold']) }}
                {{ Form::number('price_kid', null, ['class' => 'form-control','placeholder'=> trans('tour.placeholderprice_kid'),'required' ]) }}
                <span class="text-danger">{{ $errors->first('price_kid')}}</span>
              </div>

              <div class="col-md-6 mb-1">
                {{ Form::label(trans('tour.single_room_price'),'',['class' => 'font-weight-bold']) }}
                {{ Form::number('single_room_price', null, ['class' => 'form-control','placeholder'=> trans('tour.placeholdersingle_room_price'),'required' ]) }}
                <span class="text-danger">{{ $errors->first('single_room_price')}}</span>
              </div>

              <div class="col-md-6 mb-1">
                {{ Form::label(trans('tour.number_of_day'),'',['class' => 'font-weight-bold']) }}
                {{ Form::number('number_of_day', null, ['class' => 'form-control','placeholder'=> trans('tour.placeholdernumber_of_day'),'required' ]) }}
                <span class="text-danger">{{ $errors->first('number_of_day')}}</span>
              </div>
              <div class="col-md-4 mb-1">
                <label class="font-weight-bold">{{trans('tour.departure_time')}}</label>
                <input type="time" name="departure_time" class="form-control" required >
                <span class="text-danger">{{ $errors->first('departure_time')}}</span>
              </div>

              <div class="col-md-6 mb-1">
                <label class="font-weight-bold">{{trans('tour.departure_date')}}</label>
                <input type="date" name="departure_date" class="form-control" required >
                <span class="text-danger">{{ $errors->first('departure_date')}}</span>
              </div>

              <div class="col-md-6 mb-1">
                <label class="font-weight-bold">{{trans('tour.return_date')}}</label>
                <input type="date" name="return_date" class="form-control" required >
                <span class="text-danger">{{ $errors->first('return_date')}}</span>
              </div>

              <div class="col-md-6 mb-1">
                <label class="font-weight-bold">{{trans('tour.count_people')}}</label>
                <input type="number" name="count_people" class="form-control" required placeholder="{{trans('tour.placeholdercount_people')}}" >
                <span class="text-danger">{{ $errors->first('count_people')}}</span>
              </div>
              <div class="col-md-6 mb-1">
                 <label class="font-weight-bold">{{trans('tour.Discount')}}</label>
                <input type="number" name="discount" class="form-control" required placeholder="{{trans('tour.placeholderdiscount')}}" >
                <span class="text-danger">{{ $errors->first('discount')}}</span>
              </div>

            </div>
            <div class="col-md-5 row ml-1">
                <div class="col-md-12">
                  <label for="image" class=" form-control-label font-weight-bold">{{trans('tour.image')}}</label>
                  <img class=" mb-2 img-thumbnail" id="preview_avatar" src="administration/images/default_image.png" alt="Photo avatar" style="height: 250px;">
                  <input type="file" id="image" name="image" class="form-control-file" required value="{{old('image')}}">
                  <span class="text-danger">{{ $errors->first('image')}} </span>
                </div>
            </div>
            <div class="col-md-12 mb-1">
              {{ Form::label(trans('tour.tour_detail'),'',['class' => 'font-weight-bold']) }}
              <textarea class="form-control" id="tour_detail" name="tour_detail" rows="4" placeholder="{{trans('tour.placeholdertour_detail')}}" required="required"></textarea>
              <script>
                CKEDITOR.replace( 'tour_detail' );
              </script>
              <span class="text-danger">{{ $errors->first('tour_detail')}} </span>
            </div>
            <div class="col-md-12 mb-1">
              {{ Form::label(trans('tour.tour_note'),'',['class' => 'font-weight-bold']) }}
              <textarea class="form-control" id="tour_note" name="tour_note" rows="4" placeholder="{{trans('tour.tour_notetour_note')}}" required="required"></textarea>
              <script>
                CKEDITOR.replace( 'tour_note' );
              </script>
              <span class="text-danger">{{ $errors->first('tour_note')}} </span>
            </div>
            <div class="col-md-12 mb-1">
              {{ Form::label(trans('tour.tour_program'),'',['class' => 'font-weight-bold']) }}
              <textarea class="form-control" id="tour_program" name="tour_program" rows="4" placeholder="{{trans('tour.placeholdertour_program')}}" required="required"></textarea>
              <script>
                CKEDITOR.replace( 'tour_program' );
              </script>
              <span class="text-danger">{{ $errors->first('tour_program')}} </span>
            </div>
            
          </div>
        </div>

        <div class="card-footer">
          {{ Form::submit(trans('tour.save'),['class' => 'btn btn-primary']) }}
          <a class="btn btn-outline-secondary" href="{{route('tour.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
        {{ Form::close() }} 
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
@include('admin.shared.scrip')

@include('admin.shared.scriptLoadimage')
@include('admin.shared.notification')
@endsection