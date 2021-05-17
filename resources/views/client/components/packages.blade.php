<section id="hotel-packages" class="section-padding"> 
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">         	
                <div class="page-heading">
                    <h2>{{trans('allclient.most_view')}}</h2>
                    <hr class="heading-line" />
                </div><!-- end page-heading -->
                
                <div class="row" id="hotel-package-tables">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-offset-1 col-lg-10 col-lg-offset-1"> 
                    
                        <div class="row">
                            @foreach($data as $data)
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 text-center no-pd-r">
                                <div class="package hotel-package">        
                                    <div class="h-pkg-heading">
                                        <h2 class="h-pkg-price">{{$data->views}}<span>{{trans('allclient.view')}}</span></h2>
                                    </div><!-- end h-pkg-heading -->
                                    
                                    <div class="pkg-features">
                                        <ul class="list-unstyled text-center">
                                            <li>{{$data->roomtypes->name}}</li>
                                            <li>{{number_format($data->price)}} VND</li>
                                            <li>{{  substr(strip_tags($data->description), 0, 100)."..." }}</li>
                                        </ul>
                                    </div><!-- end features -->
                                    <a class="btn" href="{{route('roomtype.room.detail',$data->id)}}">{{trans('allclient.detail')}}</a>  
                                </div><!-- end hotel-package -->
                            </div><!-- end columns -->
                            @endforeach


                        </div><!-- end row -->
                    </div><!-- end columns -->
                </div><!-- end row -->
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end hotel-packages -->