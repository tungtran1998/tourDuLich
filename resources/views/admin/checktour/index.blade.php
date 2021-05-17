@extends('admin.layouts.main')
@section('title','Check Tour')
@section('content')
<div class="animated fadeIn">
	<div class="row">
		@if($result == '0')
		<div class="col-md-6">
			<video id="preview"  class="img-thumbnail"></video>
			{{ Form::open(['route' => 'checktour.qr', 'method' => 'post','enctype '=>'multipart/form-data']) }}
			<div class="input-group ">
				<input class="form-control" type="text" id="search_result" name="id" value="">
				{{ Form::submit('Check tour',['class' => 'btn btn-primary saveabout border-left-primary']) }}
			</div>
			{{ Form::close() }} 
		</div>
		@endif
		<div class="col-md-4">
			@if($result)
			<div class="card">
				<div class="card-header">
					<strong class="card-title mb-3">{{trans('cico.useraccount')}}</strong>
				</div>
				<div class="card-body">
					<div class="mx-auto d-block">
						<img class="rounded-circle mx-auto d-block"  width="200px" height="200px" src="@if ($result->users->image == null)   
						client/images/user_default.png
						@else
						administration/imageRooms/{{$result->users->image}}
						@endif " alt="Card image cap">
						<h5 class="text-sm-center mt-2 mb-1">{{$result->users->first_name}}{{$result->users->last_name}}
						</h5>
						<div class="location text-sm-center"><i class="fa fa-map-marker"></i> {{$result->users->street}}, {{$result->users->state}} {{$result->users->city}} {{$result->users->nationality}} </div>
					</div>
					<hr>
					<div class="card-text row">
						<div class="col-md-6">
							<p>{{trans('cico.gender')}}: 
								{{($result->users->gender == 0) ? trans('cico.Male') : trans('cico.Female')}}
							</p>
							<p>{{trans('cico.Phone')}}: {{$result->users->phone}}</p>
						</div>
						<div class="col-md-6">
							<p>{{trans('cico.dateofbirth')}}: {{date('d/m/Y',strtotime($result->users->dateofbirth))}}</p>
						</div>
					</div>
				</div>
			</div>
			@endif
		</div>
		
		@if($result)
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">Tour booking details</strong>
				</div>
				<div class="card-body row">
					<div class="col-md-6">
						<ul class="list-group">
							<li class="list-group-item">Tour booking code: {{$result->book_code}}</li>
							<li class="list-group-item">Full name: {{$result->fullname}}</li>
							<li class="list-group-item">Phone: {{$result->phone}}</li>
							<li class="list-group-item">Email: {{$result->email}}</li>
							<li class="list-group-item">
								Date of booking: {{date('H:i | d/m/Y',strtotime($result->transaction_date))}}</li>
							<li class="list-group-item">Departure Location: {{$result->tour_book->departure_location}}</li>
							<li class="list-group-item">Destination: {{$result->tour_book->destination}}</li>
							<li class="list-group-item">SL adult / Price 1 adult: {{$result->adult}} people / {{$result->price_adult}} 1 people</li>
							<li class="list-group-item">SL children / Price 1 children: {{$result->kid}} people / {{$result->price_kid}} 1 people</li>
						</ul>
					</div>
					<div class="col-md-6">
						<ul class="list-group">


							<li class="list-group-item">Number of days: {{$result->tour_book->number_of_day}} ngày</li>

							<li class="list-group-item">Time start: {{$result->tour_book->departure_time}}</li>
							<li class="list-group-item">Days to go: {{$result->tour_book->departure_date}}</li>
							<li class="list-group-item">Return date: {{$result->tour_book->return_date}}</li>
							<li class="list-group-item">Vehicle: {{$result->tour_book->vehicle}}</li>

							<li class="list-group-item">Promotion: {{$result->discount}} %</li>

							<li class="list-group-item">
								@if($result->discount)
								Total money:  
								<strike> 
									{{number_format(($result->adult*$result->price_adult + $result->kid*$result->price_kid + $result->single_room*$result->single_room_price))}} VNĐ
								</strike> 
								<br>
								{{number_format($result->total_amount)}} VNĐ
								@else
								Total money: {{number_format($result->total_amount)}} VNĐ
								@endif

							</li>


							<li class="list-group-item">Payments: 
								@if($result->payment==1)
								<span class="text text-success">{{trans('allclient.bf')}}</span>
								@elseif($result->status==3 && $result->payment==0)
								<span class="text text-success">{{trans('allclient.bd')}}</span>
								@else
								<span class="text text-warning">{{trans('allclient.unpaid')}}</span>
								@endif
							</li>

						</ul>
					</div>
					<div class="col-md-12">
						<p>Lưu ý: {{$result->message}}</p>
					</div>
					<div class="col-md-12">
						<p>Trạng thái:</p>
						{{ Form::open(['route' => ['checktour.update',$result->id], 'method' => 'put','enctype '=>'multipart/form-data']) }}
						{{ Form::select('status',array(
						'0' => trans('cico.unconfirm'),
						'1' => trans('cico.cofirmed'),
						),$result->status,['class'=>'form-control col-md-4 ']) }}
						{{ Form::submit(trans('cico.update'),['class' => 'btn btn-outline-primary btn-sm mt-2']) }}
						{{ Form::close() }} 
					</div>

				</div>
			</div>
		</div>
		@endif
	</div>
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
	var age = document.getElementById("search_result").value;
	let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
	scanner.addListener('scan', function (code) {
		document.getElementById("search_result").value = code;
		console.log(code);
		
		$("#search_result").fadeIn();
		$("#search_result").html(code);
	});
	Instascan.Camera.getCameras().then(function (cameras) {
		if (cameras.length > 0) {
			scanner.start(cameras[0]);
		} else {
			console.error('No cameras found.');
		}
	}).catch(function (e) {
		console.error(e);
	});
</script>
@include('admin.shared.notification')
@endsection
