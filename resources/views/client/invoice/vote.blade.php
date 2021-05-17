@extends('client.layouts.main')
@section('title',trans('allclient.vote_booking'))
@section('breadcrumb')
<!--========== PAGE-COVER =========-->
<section class="page-cover dashboard">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="page-title">
                {{trans('allclient.vote_booking')}}</h1>
                <ul class="breadcrumb">
                    <li><a href="/">{{trans('allclient.home')}}</a></li>
                    <li class="active">{{trans('allclient.vote')}}</li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
@section('content')
<div class="container khung">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <br>
            @if($vote==null)
            {{ Form::open(['route' => ['vote.store',$booking->id], 'method' => 'post']) }}
            {{-- <p class="text-center text text-info">{{trans('allclient.share_your')}}</p> --}}
            <div class="stars">
                <input name="star" value="5" class="star star-5" id="star-5" type="radio" name="star"/>
                <label class="star star-5" for="star-5"></label>
                <input name="star" value="4" class="star star-4" id="star-4" type="radio" name="star"/>
                <label class="star star-4" for="star-4"></label>
                <input name="star" value="3" class="star star-3" id="star-3" type="radio" name="star"/>
                <label class="star star-3" for="star-3"></label>
                <input name="star" value="2" class="star star-2" id="star-2" type="radio" name="star"/>
                <label class="star star-2" for="star-2"></label>
                <input name="star" value="1" class="star star-1" id="star-1" type="radio" name="star"/>
                <label class="star star-1" for="star-1"></label>
            </div>
         <span class="text-danger">{{ $errors->first('star')}}</span>       
        <div class="form-group">
            <label>{{trans('allclient.title')}}</label>
            {{ Form::text('title', '', ['class' => 'form-control']) }}
            <span class="text-danger">{{ $errors->first('title')}}</span>
        </div>
        <div class="form-group">
            <label>{{trans('allclient.comment')}}</label>
            {{ Form::textarea('comment', '', ['class' => 'form-control']) }}
            <span class="text-danger">{{ $errors->first('comment')}}</span>
        </div>
        {{ Form::submit(trans('allclient.complete_vote'), ['class' => 'btn btn-warning']) }} 
        {{ Form::close() }}
        @else
        <div class="vote-info">
        <div class="form-group">
          <label>{{trans('allclient.star')}}</label><br>
          @for($i=1;$i<=$vote->star;$i++)
          <i class="fa fa-star vote-star" aria-hidden="true"></i>
          @endfor
          @for($i=1;$i<=5-$vote->star;$i++)
          <i class="fa fa-star-o vote-star" aria-hidden="true"></i>
          @endfor
        </div>
        <div class="form-group">
          <label>{{trans('allclient.title')}}</label>
          <h4>{{ $vote->title }}</h4>
        </div>
        <div class="form-group">
          <label>{{trans('allclient.comment')}}</label>
          <h5>{{ $vote->comment }}</h5>
        </div>
        <p class="text-right">{{ date('d-m-Y', strtotime($vote->created_at)) }}</p>
        </div>
        @endif
        </div>
    </div>
    
</div>
<style type="text/css">
.khung{
  margin-top: 15px;
}
.vote-info{
  border: 1px dotted #faa61a;
  margin-bottom: 20px;
  padding: 20px 10px 20px 30px;
}
.vote-star{
  color: #FFCC00;
  font-size: 30px;
}
div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }
 
label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}
 
input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
 
input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}
 
input.star-1:checked ~ label.star:before { color: #F62; }
 
label.star:hover { transform: rotate(-15deg) scale(1.3); }
 
label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>
<script>
  $(document).ready(function(){
    $('.home-status').removeClass('active');
    $('.invoice-status').addClass('active');
  });
</script>
@endsection
@section('script1')
@endsection
