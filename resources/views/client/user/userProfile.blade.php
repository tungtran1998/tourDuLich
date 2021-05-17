@extends('client.layouts.main')
@section('title',trans('allclient.Myaccount'))
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
<!--========== PAGE-COVER =========-->
<section class="page-cover dashboard">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">
                {{trans('allclient.Myaccount')}}</h1>
                <ul class="breadcrumb">
                    <li><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
                    <li class="active">{{trans('allclient.Myaccount')}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<section class="innerpage-wrapper">
    <div id="dashboard" class="innerpage-section-padding" style="padding-top:0">
        <div class="container" style="margin-top: -100px">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="dashboard-wrapper">
                        <div class="row">
                            @include('client.components.user_dasboard')
                            <div class="col-xs-12 col-sm-10 col-md-10 dashboard-content user-profile">
                                {{ Form::open(['route' => ['profile.updateuser',$user->id], 'method' => 'put','enctype '=>'multipart/form-data']) }}

                                <div class="panel panel-default" style="margin-top: 25px;">
                                    <div class="panel-heading">
                                        <h4 style="display: inline; margin-right: 20px">{{trans('allclient.pi')}} </h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-4 user-img " style="margin-top: 4px;">
                                                <img id="preview_avatar" width="222px" height="222px" src="
                                                @if ($user->image == null)   
                                                client/images/user_default.png
                                                @else
                                                administration/imageRooms/{{$user->image}}
                                                @endif
                                                " class="img-responsive img-thumbnail" alt="user-img" />
                                                <input type="file" id="avatar" name="image" class="form-control-file" value="{{old('image')}}" style="margin-top: inherit;">
                                            </div>
                                            <div class="col-sm-3 col-md-4  user-detail mt-2" >
                                                <ul class="list-unstyled">
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.name_account'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::text('username', $user->username, ['class' => 'form-control','placeholder'=>trans('allclient.pq'),'readonly']) }}
                                                        <span class="text-danger">{{ $errors->first('username')}}</span>
                                                    </li>
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.pw'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::text('first_name', $user->first_name, ['class' => 'form-control','placeholder'=>trans('allclient.pe') ]) }}
                                                        <span class="text-danger">{{ $errors->first('first_name')}}</span>
                                                    </li>
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.pw'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::text('last_name', $user->last_name, ['class' => 'form-control','placeholder'=>trans('allclient.pw') ]) }}
                                                        <span class="text-danger">{{ $errors->first('last_name')}}</span>
                                                    </li>
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.email'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::text('email', $user->email, ['class' => 'form-control','placeholder'=>trans('allclient.pr'),'readonly' ]) }}
                                                        <span class="text-danger">{{ $errors->first('email')}}</span>
                                                    </li>
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.pt'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::date('dateofbirth', $user->dateofbirth, ['class' => 'form-control','placeholder'=>trans('allclient.py') ]) }}
                                                        <span class="text-danger">{{ $errors->first('dateofbirth')}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-sm-3 col-md-4  user-detail mt-2">
                                                <ul class="list-unstyled">
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.pu'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::select('gender', array('0' => trans('allclient.po'), '1' =>trans('allclient.pa')),$user->gender,['class' => 'form-control'])}}
                                                        <span class="text-danger">{{ $errors->first('gender')}}</span>
                                                    </li>
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.ps'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::text('street', $user->street, ['class' => 'form-control', 'placeholder'=>trans('allclient.pd')]) }}
                                                        <span class="text-danger">{{ $errors->first('street')}}</span>
                                                    </li>
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.pf'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::text('state', $user->state, ['class' => 'form-control','placeholder'=>trans('allclient.pg') ]) }}
                                                        <span class="text-danger">{{ $errors->first('state')}}</span>
                                                    </li>
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.ph'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::text('city', $user->city, ['class' => 'form-control','placeholder'=>trans('allclient.pj') ]) }}
                                                        <span class="text-danger">{{ $errors->first('city')}}</span>
                                                    </li>
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.pk'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::number('phone', $user->phone, ['class' => 'form-control','placeholder'=>trans('allclient.pl')]) }}
                                                        <span class="text-danger">{{ $errors->first('phone')}}</span>
                                                    </li>
                                                    <li class="edit">
                                                        {{ Form::label(trans('allclient.pz'),'',['class' => 'font-weight-bold']) }}
                                                        {{ Form::select('nationality', array('VietName' => 'Việt Nam', '
                                                        America' => 'America'),$user->nationality,['class' => 'form-control'])}}
                                                        <span class="text-danger">{{ $errors->first('nationality')}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="input-edit">
                                            <button type="submit" class="btn-save"><i class="fa fa-save"></i> {{trans('allclient.px')}}</button>
                                        </div>
                                    </div>
                                </div>    
                                {{ Form::close() }} 
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
<script>
    $(document).ready(function(){
        $('.account-management').addClass('profile');
    });
</script>
@endsection
