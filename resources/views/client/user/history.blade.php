@extends('client.layouts.main')
@section('title',trans('allclient.hq'))
@section('css')
<style>
    .hide{
        display: none;
    }
    .uppercase-first-letter{
        text-transform: capitalize;
        font-weight: normal !important;
    }
    .input-edit{
        font-weight: normal !important;
    }
    .input-edit .btn-save:hover{
        background: #1abd9d;
        color: whitesmoke;
    }
    .input-edit .btn-close:hover{
        background: #e84c3c;
        color: whitesmoke;
    }
    .input-edit button{
        margin: 15px 10px 10px 10px;
        padding: 5px 12px;
        font-size: 16px;
        box-shadow: 1px 1px 3px 1px grey;
        border-radius: 3px;
        border: none;
    }
    .input-edit textarea{
        height: ;
    }
    .input-edit input,.input-edit textarea, .input-edit select{
        padding-left: 5px;
        box-shadow: 1px 1px 3px 1px grey;
        border: none;
        margin: 5px 5px 0px 5px;
        border-radius: 3px;
        width: 100%;
        display: block;
    }
    .old-value{
        text-transform: none;
        font-weight: normal !important;
    }

    .edit-btn:hover{
        background: #29c4e3;
        color: whitesmoke;
    }
    .edit-btn{
        box-shadow: 1px 1px 3px 1px grey;
        font-size: 25px;
        border-radius: 3px;
        border: none;
    }
    .user-profile .panel-default {
        box-shadow: 1px 1px 10px 2px #b5b1b1;
    }
    .panel-body {
        padding: 25px 40px !important;
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
                    <li class="active">{{trans('allclient.hq')}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<section class="innerpage-wrapper">
    <div id="dashboard" class="innerpage-section-padding" style="padding-top:0">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="dashboard-wrapper">
                        <div class="row">
                            @include('client.components.user_dasboard')


                        <!-- tour -->
                        <div class="col-xs-12 col-sm-10 col-md-10 dashboard-content user-profile">
                            <div class="panel panel-default" style="margin-top: 25px;">
                                <div class="panel-heading">
                                    <h4 style="display: inline; margin-right: 20px"> Tour booking history</h4>
                                </div>
                                <div class="panel-body">
                                   <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Stt</th>
                                            <th>Tour booking code</th>
                                            <th>Date of booking</th>
                                            <th>Status</th>
                                            <th>Total money</th>
                                            <th>See details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tour as $key => $data)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td >{{$data->book_code}}
                                            </td>
                                            <td>{{ date('H:i || d-m-Y ',strtotime($data->transaction_date)) }}
                                            </td>
                                            <td>
                                                @if($data->status==0)
                                                <h5><span class="label label-danger">{{trans('allclient.hy')}}<i class="fa fa-info-circle" aria-hidden="true"></i></span></h5>
                                                @elseif($data->status==1)
                                                <h5><span class="label label-info">{{trans('allclient.hu')}}<i class="fa fa-check-circle" aria-hidden="true"></i></span></h5>
                                                @elseif($data->status==2)
                                                <h5><span class="label label-success">{{trans('allclient.hi')}}<i class="fa fa-money" aria-hidden="true"></i></span></h5>
                                                @else
                                                <h5><span class="label label-primary">{{trans('allclient.ho')}}<i class="fa fa-money" aria-hidden="true"></i></span></h5>
                                                @endif
                                            </td>
                                            <td>{{number_format($data->total_amount)}} VND</td>
                                            <td><a href="{{ route('tour_detail',$data->id) }}">{{trans('allclient.hp')}}</a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>    
                    </div>
                    <!-- endtour -->



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
