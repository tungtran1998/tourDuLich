<section id="cruise-offers" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="">Các tour liên quan</h2>
                <div class="row">
                    @foreach($data_similar as $data)
                    <div class="col-sm-6 col-md-6">
                        <div class="main-block cruise-block">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-md-push-6 no-pd-l">
                                    <div class="main-img cruise-img">
                                        <a href="{{route('tour.detail',$data->id)}}">
                                            <img src="{{ asset('administration/imagerooms').'/'.$data->tour_image }}"/>
                                            <div class="cruise-mask">
                                                <p>{{$data->number_of_day}} Ngày</p>
                                            </div><!-- end cruise-mask -->
                                        </a>
                                    </div><!-- end cruise-img -->
                                </div><!-- end columns -->
                                
                                <div class="col-sm-12 col-md-6 col-md-pull-6 no-pd-r">
                                    <div class=" main-info cruise-info">
                                        <div class="main-title cruise-title">
                                            <a href="{{route('tour.detail',$data->id)}}">{{$data->tour_name}}</a>
                                           <p>Điển Xuất Phát: {{$data->departure_location}}</p>
                                           <p>Điển Đến: {{$data->destination}}</p>
                                            <div class="rating">
                                                <span><i class="fa fa-star orange"></i></span>
                                                <span><i class="fa fa-star orange"></i></span>
                                                <span><i class="fa fa-star orange"></i></span>
                                                <span><i class="fa fa-star orange"></i></span>
                                                <span><i class="fa fa-star grey"></i></span>
                                            </div><!-- end rating -->
                                            
                                            <span class="cruise-price">{{number_format($data->price_adult)}} VND/1 Người</span>
                                        </div><!-- end cruise-title -->
                                    </div><!-- end cruise-info -->
                                </div><!-- end columns -->
                                
                            </div><!-- end row -->	
                        </div><!-- end cruise-block -->
                    </div><!-- end columns -->
                    @endforeach
                </div><!-- end row -->
                
                
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end cruise-offers -->