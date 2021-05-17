<section id="tour-offers" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-heading">
                    <h2>Tour</h2>
                    <hr class="heading-line" />
                </div><!-- end page-heading -->
                
                    <div class="owl-carousel owl-theme owl-custom-arrow" id="owl-tour-offers">
                    @foreach($dataTour as $data)
                    <div class="item">
                        <div class="main-block tour-block">
                            <div class="main-img">
                                <a href="{{route('tour.detail',$data->id)}}">
                                    <img src="{{ asset('administration/imagerooms').'/'.$data->tour_image }}" class="img-responsive" alt="tour-img" />
                                </a>
                            </div><!-- end offer-img -->
                            
                            <div class="offer-price-2">
                                <ul class="list-unstyled">
                                    <li class="price">
                                        @if($data->discount)
                                        <strike>{{number_format($data->price_adult)}} VND/1 {{trans('allclient.people')}}</strike>
                                        {{number_format($data->price_adult - ($data->price_adult*$data->discount/100))}} VND/1 {{trans('allclient.people')}}
                                        @else
                                         {{number_format($data->price_adult)}} VND/1 {{trans('allclient.people')}}
                                        @endif
                                        <a href="{{route('tour.detail',$data->id)}}" ><span class="arrow"><i class="fa fa-angle-right"></i></span></a>
                                    </li>
                                </ul>
                            </div><!-- end offer-price-2 -->
                                
                            <div class="main-info tour-info">
                                <div class="main-title tour-title">
                                    <a href="{{route('tour.detail',$data->id)}}">{{$data->tour_name}}</a>
                                    <p>{{trans('allclient.Startingpoint')}}: {{$data->departure_location}}</p>
                                    <p>{{trans('allclient.Destination')}}: {{$data->destination}}</p>
                                    <p>{{trans('allclient.From')}} {{date('d-m-Y',strtotime($data->departure_date))}} {{trans('allclient.Come')}} {{date('d-m-Y',strtotime($data->return_date))}}</p>
                                    <div class="rating">
                                        <span><i class="fa fa-star orange"></i></span>
                                        <span><i class="fa fa-star orange"></i></span>
                                        <span><i class="fa fa-star orange"></i></span>
                                        <span><i class="fa fa-star orange"></i></span>
                                        <span><i class="fa fa-star grey"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   @endforeach
                    
                    

                    
                </div>
                
                <div class="view-all text-center">
                    <a href="{{route('tour')}}" class="btn btn-orange">{{trans('allclient.seemore')}} </a>
                </div><!-- end view-all -->
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end tour-offers -->