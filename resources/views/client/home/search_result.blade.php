@extends('client.layouts.main')
@section('title',trans('allclient.search_all'))
@section('content')

<section class="page-cover" id="cover-hotel-grid-list">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">{{trans('allclient.sdfa')}}</h1>
                <ul class="breadcrumb">
                    <li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
                    <li class="active">{{trans('allclient.sdfa')}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="innerpage-wrapper">
    <div id="hotel-grid" class="innerpage-section-padding">
        <div class="container">
            <div class="row">           
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-side">
                        @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                        <div class="row">
                         <h2>
                            @if(ucfirst($type) == 'News')
                                {{trans('allclient.new')}}
                            @else
                                {{trans('allclient.roomtype')}}
                            @endif
                         </h2>
                         <hr>
                         @foreach($modelSearchResults as $searchResult)
                            <div class="col-sm-6 col-md-6 col-lg-4">
                            <div class="grid-block main-block h-grid-block">
                                <div class="main-img h-grid-img">
                                    <div class="block-info h-grid-info">
                                        <h3 class="block-title"><a href="hotel-detail-left-sidebar.html"> {{$searchResult->title}}</a></h3>
                                        <div class="grid-btn">
                                            <a href="{{ $searchResult->url }}" class="btn btn-orange btn-block btn-lg">{{trans('allclient.detail')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        @endforeach
                        <br>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </section>
    @endsection
    @section('script1')
    <script>
        $(document).ready(function(){
            $('.home-status').removeClass('active');
            $('.room-status').addClass('active');
        });

    </script>
    @endsection
