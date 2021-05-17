@extends('admin.layouts.main')
@section('title',trans('booktour.Tourbookingdetails'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">{{trans('booktour.Tourbookingdetails')}}  {{$book_tour->tour_book->tour_name}}</strong>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <ul class="list-group">
                <li class="list-group-item">{{trans('booktour.Tourbookingcode')}}: {{$book_tour->book_code}}</li>
                <li class="list-group-item">{{trans('booktour.Fullname')}}: {{$book_tour->fullname}}</li>
                <li class="list-group-item">{{trans('booktour.Phone')}}: {{$book_tour->phone}}</li>
                <li class="list-group-item">{{trans('booktour.Email')}}: {{$book_tour->email}}</li>
                <li class="list-group-item">
                  {{trans('booktour.Dateofbooking')}}: {{date('H:i | d/m/Y',strtotime($book_tour->transaction_date))}}</li>
                  <li class="list-group-item">{{trans('booktour.Departurelocation')}}: {{$book_tour->tour_book->departure_location}}</li>
                  <li class="list-group-item">{{trans('booktour.Destination')}}: {{$book_tour->tour_book->destination}}</li>
                  <li class="list-group-item">{{trans('booktour.SLadults')}}: {{$book_tour->adult}} 
                    {{trans('booktour.people')}} / {{$book_tour->price_adult}} 1 
                  {{trans('booktour.people')}}</li>
                  <li class="list-group-item">
                    {{trans('booktour.SLchildren')}} : {{$book_tour->kid}} 
                    {{trans('booktour.people')}} / {{$book_tour->price_kid}} 1 
                  {{trans('booktour.people')}}</li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="list-group">


                  <li class="list-group-item">{{trans('booktour.Numberofdays')}}: {{$book_tour->tour_book->number_of_day}} {{trans('booktour.day')}}</li>

                  <li class="list-group-item">
{{trans('booktour.Timestart')}}: {{$book_tour->tour_book->departure_time}}</li>
                  <li class="list-group-item">
{{trans('booktour.Daystogo')}}: {{$book_tour->tour_book->departure_date}}</li>
                  <li class="list-group-item">
{{trans('booktour.Returndate')}}: {{$book_tour->tour_book->return_date}}</li>
                  <li class="list-group-item">
{{trans('booktour.Vehicle')}}: {{$book_tour->tour_book->vehicle}}</li>

                  <li class="list-group-item">
{{trans('booktour.Promotion')}}: {{$book_tour->discount}} %</li>

                  <li class="list-group-item">
                    @if($book_tour->discount)
                    
{{trans('booktour.Totalmoney')}}:  
                    <strike> 
                      {{number_format(($book_tour->adult*$book_tour->price_adult + $book_tour->kid*$book_tour->price_kid + $book_tour->single_room*$book_tour->single_room_price))}} VNĐ
                    </strike> 
                    <br>
                    {{number_format($book_tour->total_amount)}} VNĐ
                    @else
                    {{trans('booktour.Totalmoney')}}: {{number_format($book_tour->total_amount)}} VNĐ
                    @endif

                  </li>


                  <li class="list-group-item">{{trans('booktour.Payments')}} : 
                    @if($book_tour->payment==1)
                    <span class="text text-success">{{trans('allclient.bf')}}</span>
                    @elseif($book_tour->status==3 && $book_tour->payment==0)
                    <span class="text text-success">{{trans('allclient.bd')}}</span>
                    @else
                    <span class="text text-warning">{{trans('allclient.unpaid')}}</span>
                    @endif
                  </li>

                </ul>
              </div>
            </div>
            <br>
            @if($book_tour->message)
            <p class="font-weight-bold">{{trans('booktour.Note')}}: {{$book_tour->message}}</p>
            @endif

            <p class="font-weight-bold">
{{trans('booktour.Status')}}:
             {{Form::open(['route'=>['booktour.update',$book_tour->id],'method'=>'put'])}}
             {{ Form::select('status',array(
             '0' => '
Unconfimred',
             '1' => 'Confirmed',
             ),$book_tour->status,['class'=>'form-control col-md-4 ']) }}
             {{ Form::submit('
Update',['class' => 'btn btn-outline-primary btn-sm mt-2']) }}
             {{ Form::close() }}
           </p>

         </div>
         <div class="card-footer">
          <a class="btn btn-outline-secondary" href="{{route('booktour.index')}}"><i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
@include('admin.shared.notification')
@endsection
