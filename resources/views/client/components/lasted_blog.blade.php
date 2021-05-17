<section id="latest-blog" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-heading">
                    <h2>{{trans('allclient.lasted')}}</h2>
                    <hr class="heading-line" />
                </div>

                <div class="row">
                    @foreach($hot_news as $news)
                    <div class="col-sm-6 col-md-4">
                        <div class="main-block latest-block">
                            <div class="main-img latest-img">
                                <a href="{{route('news_detail',$news->slug) }}">
                                    <img
                                    src="administration/imageNews/{{ $news->thumbnail }}"
                                    class="img-responsive"
                                    alt="blog-img"
                                    style=" height:208px; object-fit: cover;"
                                    />
                                </a>
                            </div>
                            <div class="latest-info">
                                <ul class="list-unstyled">
                                    <li>
                                        <span
                                        ><i
                                        class="fa fa-calendar-minus-o"
                                        ></i></span
                                        ><a>{{ date('H:i | d-m-Y', strtotime($news->created_at)) }}</a><span class="author"
                                        >{{trans('allclient.byG')}}:
                                        <a href="#">{{ $news->created_by }}</a></span
                                        >
                                    </li>
                                </ul>
                            </div>
                            <!-- end latest-info -->
                            
                            <div class="main-info latest-desc">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 main-title">
                                        <a class="text-center" href="{{route('news_detail',$news->slug) }}">{{ $news->title }}</a><br>
                                        <p>{!!  mb_substr(strip_tags($news->content), 0, 75, 'utf-8').'...' !!}</p>
                                    </div>
                                    <!-- end columns -->
                                </div>
                                <!-- end row -->
                                
                                
                            </div>
                            <!-- end latest-desc -->
                        </div>
                        <!-- end latest-block -->
                    </div>
                    @endforeach
                    <!-- end columns -->
                </div>
                <!-- end row -->

                <div class="view-all text-center">
                    <a href="{{route('news')}}" class="btn btn-orange">{{trans('allclient.seemore')}}</a>
                </div>
                <!-- end view-all -->
            </div>
            <!-- end columns -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- end latest-blog -->

