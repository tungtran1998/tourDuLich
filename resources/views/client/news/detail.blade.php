@extends('client.layouts.main')
@section('title',$data->title)
@section('content')
<section class="page-cover" id="cover-hotel-grid-list">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">{{trans('allclient.new')}}</h1>
                <ul class="breadcrumb">
                    <li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
                    <li><a href="{{route('news')}}">{{trans('allclient.new')}}</a></li>
                    <li class="active">{!! $data->title !!}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section id="latest-blog" class="section-padding" style="padding-top: 50px;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <h3 class="font-weight-bold text-center">{!! $data->title !!}</h3>
            <hr>
            <i>{{ date('H:i | d/m/Y', strtotime($data->created_at)) }} </i><br>
            <br>
            <img class="center-block" style="width: 80%; object-fit: cover;" src="administration/imageNews/{{ $data->thumbnail }}"/><br>
            <div class="news">{!! $data->content !!}</div>
            <i><p class="text-right"> {{trans('allclient.byG')}}: {{ $data->created_by }}</p></i>
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
