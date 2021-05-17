@extends('client.layouts.main')
@section('title',trans('allclient.new'))
@section('content')
<section class="page-cover" id="cover-hotel-grid-list">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="page-title">{{trans('allclient.new')}}</h1>
				<ul class="breadcrumb">
					<li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
					<li class="active">{{trans('allclient.new')}}</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section id="latest-blog" class="section-padding" style="padding-top: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    @foreach($data as $news)
                    <div class="col-sm-6 col-md-4">
                        <div class="main-block latest-block">
                            <div class="main-img latest-img">
                                <a href="{{route('news_detail',$news->slug) }}">
                                    <img
                                    src="administration/imageNews/{{ $news->thumbnail }}"
                                    class="img-responsive"
                                    alt="blog-img"
                                    style="height:208px; object-fit: cover;"
                                    />
                                </a>
                            </div>
                            <!-- end latest-img -->
                            
                            <div class="latest-info">
                                <ul class="list-unstyled">
                                    <li>
                                        <span class="gray-lighter">
                                         <i class="fa fa-calendar-minus-o"></i>
                                         <a>{{ date('H:i | d-m-Y', strtotime($news->created_at))}}</a>
                                        </span>
                                        
                                        <span class="author">{{trans('allclient.byG')}}:
                                        <a>{{ $news->created_by }}</a></span>
                                    </li>
                                </ul>
                            </div>
                            <div  class="main-info latest-desc">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 main-title">
                                        <a class="text-center" href="{{ route('news_detail',$news->slug) }}">{{ $news->title }}</a>
                                        <p>{!!  mb_substr(strip_tags($news->content), 0, 75, 'utf-8').'...' !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="view-all text-center">
                    {{ $data->links() }}
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
		$('.news-status').addClass('active');
	});
</script>
@endsection
