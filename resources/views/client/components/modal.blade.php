<div class="modal fade" id="myModal" role="dialog" >
  <div class="modal-dialog" style="width: 1000px">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="row">
          <div class="col-md-3"><h4 class="modal-title">{{trans('allclient.qaz')}}</h4></div>
          <div class="col-md-3"></div>
          <div class="col-md-6 row">
            <div class="col-md-6">
              <i style="font-size: 50px; color: blue" class="fa fa-bed" aria-hidden="true"></i> 
              <h4>{{trans('allclient.wsx')}}</h4>
            </div>
            <div class="col-md-6"><i style="font-size: 50px; color: red" class="fa fa-bed" aria-hidden="true"></i>
              <h4>{{trans('allclient.edc')}}</h4>
            </div>
          </div>
        </div>
        
      </div>
      <div class="modal-body" style="text-align: center;">
        <h2>{{trans('allclient.rfv')}}</h2>
        <div class="row">
          @foreach($first as $key => $room)
            @if($room->booking_detail)
              <div class="col-md-2">
                <a href="{{route('roomtype.room.detail',$room->id)}}"><i  style="font-size: 50px; color: red" class="fa fa-bed"   aria-hidden="true"></i></a>
                <p>{{$room->name}}</p> 
              </div> 
            @else
            <div class="col-md-2">
                <a href="{{route('roomtype.room.detail',$room->id)}}"><i  style="font-size: 50px; color: blue" class="fa fa-bed" aria-hidden="true"></i></a>
                <p>{{$room->name}}</p> 
              </div> 
            @endif    
          @endforeach
        </div>

        <h2>{{trans('allclient.rgb')}}</h2>
        <div class="row">
          @foreach($second as $key => $room)
            @if($room->booking_detail)
              <div class="col-md-2">
                <a href="{{route('roomtype.room.detail',$room->id)}}"><i  style="font-size: 50px; color: red" class="fa fa-bed" aria-hidden="true"></i></a>
                <p>{{$room->name}}</p> 
              </div> 
            @else
            <div class="col-md-2">
                <a href="{{route('roomtype.room.detail',$room->id)}}"><i  style="font-size: 50px; color: blue" class="fa fa-bed" aria-hidden="true"></i></a>
                <p>{{$room->name}}</p> 
              </div> 
            @endif   
          @endforeach
        </div>

        <h2>{{trans('allclient.thn')}}</h2>
        <div class="row">
          @foreach($thirst as $key => $room)
            @if($room->booking_detail)
              <div class="col-md-2">
                <a href="{{route('roomtype.room.detail',$room->id)}}"><i  style="font-size: 50px; color: red" class="fa fa-bed" aria-hidden="true"></i></a>
                <p>{{$room->name}}</p> 
              </div> 
            @else
            <div class="col-md-2">
                <a href="{{route('roomtype.room.detail',$room->id)}}"><i  style="font-size: 50px; color: blue" class="fa fa-bed" aria-hidden="true"></i></a>
                <p>{{$room->name}}</p> 
              </div> 
            @endif   
          @endforeach
        </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('allclient.ukm')}}</button>
        </div>
      </div>
      
    </div>
  </div>