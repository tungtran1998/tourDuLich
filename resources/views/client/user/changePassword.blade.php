@extends('client.layouts.main')
@section('title',trans('allclient.cq'))
@section('css')
<style>
    .user-profile .panel-default {
        box-shadow: 1px 1px 10px 2px #b5b1b1;
    }
    .panel-body {
        padding: 25px 40px !important;
    }
    .bg-light{
        background: #efeff0;
        padding: 20px 40px;
    }
    .bg-light p{
        margin-bottom: 0px !important;
    }
    .custom-form{
        background: none !important;
        padding: 20px 40px;
    }
    .input-edit input{
        padding-left: 5px;
        box-shadow: 1px 1px 3px 1px grey;
        border: none !important;
        margin: 5px 5px 0px 5px;
        border-radius: 3px !important;
        width: 100%;
        display: block;
    }
    .dashboard-content .btn,.panel-heading h4 {
        font-weight: bold !important;
    }
    .alert {
        padding: 10px !important;
    }
</style>
@endsection
@section('breadcrumb')
<section class="page-cover dashboard">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">{{trans('allclient.Myaccount')}}</h1>
                <ul class="breadcrumb">
                    <li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
                    <li class="active">{{trans('allclient.cq')}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<section class="innerpage-wrapper">
    <div id="dashboard" class="innerpage-section-padding">
        <div class="container" style="margin-top: -100px">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <div class="dashboard-wrapper">
                        <div class="row">

                            @include('client.components.user_dasboard')
                            <div class="col-xs-12 col-sm-10 col-md-10 dashboard-content user-profile">
                                <h2 class="dash-content-title">{{trans('allclient.cq')}}</h2>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 style="display: inline; margin-right: 20px">{{trans('allclient.cq')}}</h4>
                                        <span id="noti" class="">
                                        </span>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="bg-light">
                                                <p>
                                                    {{trans('allclient.cw')}}
                                                </p>
                                            </div>
                                            <div class="custom-form custom-form-fields">
                                                <form action="{{route('changePass')}}" method="POST">
                                                    {{ csrf_field() }}
                                                    <div class="form-group input-edit">
                                                        <input type="password" class="form-control" name="current-password" placeholder="{{trans('allclient.old_password_required')}}" />
                                                        <span><i class="fa fa-lock"></i></span>
                                                        <span id="noti_password" class="noti-valid"></span>
                                                         <span class="text-danger">{{ $errors->first('current-password')}}</span>

                                                    </div>

                                                    <div class="form-group input-edit">
                                                        <input type="password" class="form-control" name="new-password" placeholder="{{trans('allclient.new_password_required')}}"  />
                                                        <span><i class="fa fa-lock"></i></span>
                                                        <span id="noti_new_password" class="noti-valid"></span>
                                                        <span class="text-danger">{{ $errors->first('new-password')}}</span>
                                                    </div>

                                                    <div class="form-group input-edit">
                                                        <input type="password" class="form-control" name="new-password_confirmation" placeholder="{{trans('allclient.old_password_required')}}"  />
                                                        <span><i class="fa fa-lock"></i></span>
                                                        <span id="noti_cfnew_password" class="noti-valid"></span>
                                                        <span class="text-danger">{{ $errors->first('new-password_confirmation')}}</span>
                                                    </div>

                                                    <button id="save" type="submit" class="btn btn-orange center-block">{{trans('allclient.ce')}}</button>
                                                </form>

                                                <div class="other-links">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</section>
@endsection
@section('script1')
@endsection

