@extends('client.layouts.main')
@section('title',trans('allclient.home'))
@section('content')

<!--========================= FLEX SLIDER =====================-->
<section class="flexslider-container" id="flexslider-container-1">
  <!--slider -->
  @include('client.shared.slider')
  <!-- end slider -->

  <div class="search-tabs" id="search-tabs-1">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                
                <ul class="nav nav-tabs center-tabs">
                    <li class="active"><a href="#hotels" data-toggle="tab"><span><i class="fa fa-building"></i></span><span class="st-text">{{trans('allclient.booknow')}}</span></a></li>
                </ul>

                <div class="tab-content">
                    <div id="hotels" class="tab-pane in active">
                        <form  method="GET" action="{{route('room')}}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group left-icon">
                                                <input name="checkin" type="text" class="form-control dpd1" autocomplete="off" placeholder="{{trans('allclient.check_in')}}">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group left-icon">
                                                <input name="checkout" autocomplete="off" type="text" class="form-control dpd2" placeholder="{{trans('allclient.check_out')}}">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            
                                        </div>
                                    </div>							
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-4">
                                            <div class="form-group right-icon">
                                                <select name="room_type" class="form-control">
                                                    <option value="">{{trans('allclient.room')}}</option>
                                                    @foreach($room_type as $room_type)
                                                    <option value="{{$room_type->id}}">{{$room_type->name}}</option>
                                                    @endforeach
                                                </select>
                                                <i class="fa fa-angle-down">
                                                </i>
                                            </div>
                                            
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group right-icon">
                                                <select name="adult" class="form-control">
                                                    <option value="">{{trans('allclient.adult')}}</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="3">4</option>
                                                    <option value="3">5</option>
                                                </select>
                                                <i class="fa fa-angle-down">
                                                </i>
                                            </div>
                                            
                                        </div><!-- end columns -->

                                        <div class="col-xs-6 col-sm-6 col-md-4">
                                            <div class="form-group right-icon">
                                                <select name="kid" class="form-control">
                                                    <option value="">{{trans('allclient.kid')}}</option>
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                                <i class="fa fa-angle-down">
                                                </i>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 search-btn">
                                    <button type="submit" class="btn btn-orange">{{trans('allclient.find')}}</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</section>

<!--=============== LUXURY ROOMS ===============-->
 {{--@include('client.components.luxury_rooms')--}} 

<!--================ PACKAGES ==============-->

 @include('client.components.packages')


<!--==================== HIGHLIGHTS ====================-->
@include('client.components.hightlights')



<!--================ LATEST BLOG ==============-->
@include('client.components.lasted_blog')

<!--========================= NEWSLETTER-1 ==========================-->
@include('client.components.newsletter_1')

@endsection
@section('script1')
@endsection
