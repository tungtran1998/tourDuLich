@extends('client.layouts.main')
@section('title','Chi tiết tour')
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
                    <li><a>{{trans('allclient.Myaccount')}}</a></li>
                    <li class="active">Chi tiết tour</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<!--===== INNERPAGE-WRAPPER ====-->
<section class="innerpage-wrapper">
    <div id="dashboard" class="innerpage-section-padding" style="padding-top:0">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="dashboard-wrapper">
                        <div class="row">
                            @include('client.components.user_dasboard')
                            <div class="col-xs-12 col-sm-10 col-md-10 dashboard-content user-profile">
                                <div class="panel panel-default" style="margin-top: 25px;">
                                    <div class="panel-heading">
                                        <h4 style="display: inline; margin-right: 20px">Chi tiết tour</h4>
                                    </div>
                                    <div class="panel-body">
                                       <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Ảnh</th>
                                                <th>Tên tour</th>
                                                <th>Điển xuất phát</th>
                                                <th>Điển đến</th>
                                                <th>Giờ/Ngày xuất phát</th>
                                                <th>Ngày về</th>
                                                <th>Phương tiện</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td><img width="60px" src="{{asset('administration/imageRooms/'.$book_tour->tour_book->tour_image)}}"></td>
                                                <td><a href="{{route('tour.detail',$book_tour->tour_book->id )}}">{{ $book_tour->tour_book->tour_name }}</a></td>
                                                <td>{{ $book_tour->tour_book->departure_location }}</td>
                                                <td>{{ $book_tour->tour_book->destination }}</td>
                                                <td>{{ $book_tour->tour_book->departure_time }}/{{ $book_tour->tour_book->departure_date }}</td>
                                                <td>{{ $book_tour->tour_book->return_date }}</td>
                                                <td>{{ $book_tour->tour_book->vehicle }}</td>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel panel-default" style="margin-top: 50px">
                                    <div class="panel-heading">
                                        <h4 style="display: inline; margin-right: 20px">Chi tiết đơn đặt tour</h4>
                                    </div>
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">Mã đơn đặt tour: {{ $book_tour->book_code }}</li>

                                            <li class="list-group-item">Ngày đặt tour: {{ date('d-m-Y',strtotime($book_tour->transaction_date)) }}</li>

                                            <li class="list-group-item">SL Người lớn / Giá: {{$book_tour->adult}} Người /{{number_format($book_tour->adult * $book_tour->price_adult)}} VNĐ</li>
                                            <li class="list-group-item">SL Trẻ em / Giá: {{ $book_tour->kid }}Người / {{number_format($book_tour->kid * $book_tour->price_kid)}} VNĐ</li>
                                            <li class="list-group-item">Khuyến mãi: {{ $book_tour->discount }} %</li>
                                            <li class="list-group-item">Người đặt: {{ $book_tour->fullname }}</li>
                                            <li class="list-group-item">Email: {{ $book_tour->email }}</li>
                                            <li class="list-group-item">Số điện thoại: {{ $book_tour->phone }}</li>

                                            <li class="list-group-item">
                                                <div class="float-left">Trạng thái đơn đặt tour</div>
                                                <div class="float-left">
                                                    @if($book_tour->status==0)
                                                    <h5><span class="label label-danger">
                                                        {{trans('allclient.hy')}} <i class="fa fa-info-circle" aria-hidden="true"></i></span></h5>
                                                        @elseif($book_tour->status==1)
                                                        <h5><span class="label label-info">
                                                            {{trans('allclient.hu')}} <i class="fa fa-check-circle" aria-hidden="true"></i></span></h5>
                                                            @elseif($book_tour->status==2)
                                                            <h5><span class="label label-success">
                                                                {{trans('allclient.hi')}} <i class="fa fa-money" aria-hidden="true"></i></span></h5>
                                                                @else
                                                                <h5><span class="label label-primary">
                                                                    {{trans('allclient.ho')}} <i class="fa fa-money" aria-hidden="true"></i></span></h5>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                            @if($book_tour->message)
                                                            <li class="list-group-item">
                                                                {{trans('allclient.bs')}}: {{ $book_tour->message }}</li>
                                                                @endif

                                                                <li class="list-group-item">
                                                                    @if($book_tour->discount)
                                                                    {{trans('allclient.total')}}: 
                                                                    <strike> 
                                                                        {{number_format(($book_tour->adult*$book_tour->price_adult + $book_tour->kid*$book_tour->price_kid + $book_tour->single_room*$book_tour->single_room_price))}} VNĐ
                                                                    </strike> 
                                                                    <br>
                                                                    {{number_format($book_tour->total_amount)}} VNĐ
                                                                    @else
                                                                    {{trans('allclient.total')}}: {{number_format($book_tour->total_amount)}} VNĐ
                                                                    @endif
                                                                    
                                                                </li>
                                                                <li class="list-group-item">
                                                                    @if($book_tour->payment==1)
                                                                        <span class="label label-success">{{trans('allclient.bf')}}</span>
                                                                    @elseif($book_tour->status==3 && $book_tour->payment==0)
                                                                        <span class="label label-success">{{trans('allclient.bd')}}</span>
                                                                    @else
                                                                        <span class="label label-warning">{{trans('allclient.unpaid')}}</span>
                                                                        <a href="{{ route('paymenttour',$book_tour->id) }}">{{trans('allclient.payment-now')}}</a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                            <div class="grid-btn">
                                                                @if($book_tour->status==3)
                                                                <a class="btn btn-block btn-orange" href="{{ url('vote',$book_tour->id) }}">{{trans('allclient.bl')}}</a>
                                                                @endif
                                                                @if($can == 1)
                                                                {{Form::open(['route' => ['updatetour.update',$book_tour->id], 'method' => 'put','enctype '=>'multipart/form-data', 'class'=>'row ml-2']) }}
                                                                <input type="submit" class="btn btn-orange btn-block btn-lg" name="" value="Cancel book tour">
                                                            </div>
                                                            {{ Form::close() }}
                                                            @endif
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
                <script type="text/javascript">

                  @if(request()->get('page'))
                  document.getElementById("show_price").style.display = "block";
                  @endif
              </script>
              @endsection
              @section('script1')
              @endsection
