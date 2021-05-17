@if(count($data) > 0)
@foreach($data as $value)
<div class="col-sm-6 col-md-6 col-lg-4">
	<div class="grid-block main-block h-grid-block">
		<div class="main-img h-grid-img">
			<a href="{{route('tour.detail',$value->id)}}">
				<img src="{{ asset('administration/imagerooms').'/'.$value->tour_image }}" class="img-responsive" alt="hotel-img" style="height: 190px;" />
			</a>
			<div class="main-mask">
				<ul class="list-unstyled list-inline offer-price-1">
					<li class="price">
						@if($value->discount)
						<strike>{{number_format($value->price_adult)}} VND/1 {{trans('allclient.people')}}</strike>
						{{number_format($value->price_adult - ($value->price_adult*$value->discount/100))}} VND/1 {{trans('allclient.people')}}
						@else
						{{number_format($value->price_adult)}} VND/1 {{trans('allclient.people')}}
						@endif
					</li>
				</ul>
			</div>
		</div>
		<div style="min-height: 178px;" class="block-info h-grid-info">

			<p>
				<a href="{{route('tour.detail',$value->id)}}">{{$value->tour_name}}</a>

			</p>
			<p>{{trans('allclient.Startingpoint')}}: {{$value->departure_location}}</p>
			<p>{{trans('allclient.From')}} {{date('d-m-Y',strtotime($value->departure_date))}} {{trans('allclient.Come')}} {{date('d-m-Y',strtotime($value->return_date))}}
			</p>
			<div class="grid-btn">
				<a class="btn btn-block btn-orange" href="{{route('tour.detail',$value->id)}}">{{trans('allclient.detail')}}</a>
			</div>
		</div>
	</div>
</div>
@endforeach
<div class="clearfix"></div>
<div class="view-all text-center">
	{{ $data->appends(request()->except('page'))->links() }}
</div>
@else 
No data
@endif