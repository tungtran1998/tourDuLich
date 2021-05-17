  <div class="search-tabs" id="search-tabs-1">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                
                <ul class="nav nav-tabs center-tabs">
                    <li class="active"><a href="#hotels" data-toggle="tab"><span><i class="fa fa-building"></i></span><span class="st-text">{{trans('allclient.Tourbooking')}} !</span></a></li>
                </ul>

                <div class="tab-content">
                    <div id="hotels" class="tab-pane in active">
                        <form  method="GET" action="{{route('search_tour')}}">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group left-icon">
                                                <input name="departure_location" type="text" class="form-control" placeholder="{{trans('allclient.PlaceofOrigin')}}">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group left-icon">
                                                <input name="destination" type="text" class="form-control" placeholder="{{trans('allclient.Destination')}}">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                            
                                        </div>
                                    </div>							
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group left-icon">
                                                <input name="departure_date" type="text" class="form-control dpd1" autocomplete="off" placeholder="{{trans('allclient.check_out')}}">
                                                <i class="fa fa-calendar">
                                                </i>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group left-icon">
                                                <input name="return_date" autocomplete="off" type="text" class="form-control dpd2" placeholder="{{trans('allclient.Returndate')}}">
                                                <i class="fa fa-calendar">
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