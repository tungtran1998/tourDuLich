<div class="side-bar-block filter-block">
    <h3>{{trans('allclient.filter')}}</h3>
    <p>{{trans('allclient.dream')}}</p>
    <form method="GET" action="{{route('filter')}}">
        <div class="panels-group">
            <div class="panel panel-default">
                <div class="panel-heading">					
                    <a href="#panel-1" data-toggle="collapse" >{{trans('allclient.roomtype_name')}}<span><i class="fa fa-angle-down"></i></span></a>
                </div>
                <div id="panel-1" class="panel-collapse collapse">
                    <div class="panel-body text-left">
                        <ul class="list-unstyled my_check role_city">
                            @foreach($data as $roomtype)
                            <li class=""><input type="checkbox" value="{{$roomtype->id}}"  name="checkbox[]"/>      {{$roomtype->name}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-btn">
            <input type="submit" class="btn btn-orange btn-block btn-lg"  value="{{trans('allclient.find')}}">
        </div>
        <div class="grid-btn">
          <a class="btn btn-orange btn-block btn-lg" data-toggle="modal" data-target="#myModal" class="btn btn-orange btn-block btn-lg"  value="Xem phòng trống">{{trans('allclient.zxc')}}</a>
        </div>
    </form>
</div>
@section('javascript')
<script src="client/js/pagination.min.js"></script>
<script>
    var roles = {
        rate : [],
        city : [],
        price : '',
    };
        // var dataSource;
    var dataContainer = $('#contai');
    function removeValue(arr,value){
            var index = arr.indexOf(value);
            if(index > -1){
                arr.splice(index,1);
            }
    }
    $('.my_check').click(function(ev){
            $('#oldPanigation').fadeOut(0);
            if(ev.target.value) {

                var isChecked = ev.target.checked;
                var value = ev.target.value;

                if (isChecked == true) {
                    if ($(this).hasClass('role_rate')) {
                        roles.rate.push(value);   
                    } else if($(this).hasClass('role_price')) {
                        roles.price = value;
                    }else{
                        roles.city.push(value);
                    }
                } else {
                    if ($(this).hasClass('role_rate')) {
                        removeValue(roles.rate,value);
                    } else if($(this).hasClass('role_city')) {
                        removeValue(roles.city,value);
                    }
                }
                // console.log(roles);
                // console.log(roles);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                request = $.ajax({
                    url: "",
                    method: 'GET',
                    data: {
                        roles: roles,
                    }
                });
                request.done(function(jsonResult) {
                    // console.log( jsonResult );
                    dataSource = jsonResult;
                    //phaan trang
                    $('#contai11').pagination({
                        dataSource: jsonResult,
                        pageSize: 6,
                        showPrevious: false,
                        showNext: false,
                        callback: function(data, pagination) {
                            // console.log(data);
                            // console.log(pagination);
                            var html = template(data);
                            // console.log(html);
                            dataContainer.html(html);
                        }
                    })
                });
                request.fail(function(jqXHR) {
                    console.log( jqXHR.responseJSON.errors );
                });

            }
    });
    function template(data){
            var html = '';
            $.each(data, function (index, item) {

                html += '<div class="col-sm-6 col-md-6 col-lg-4">'
                +   '<div class="grid-block main-block h-grid-block">'
                +   '<div class="main-img h-grid-img">'
                +   ' <a href="' + '/room/detail/' + item['id'] + '">'
                +   '<img src="'
                +   '{{ asset("upload/images") }}'+ '/' + item['image']
                +   '" class="img-responsive" alt="hotel-img" style="width: 264px; height: 190px;" />'
                +   '</a>'
                +    '<div class="main-mask"><ul class="list-unstyled list-inline offer-price-1">'
                +    '<li class="price">'
                +    item['price']
                +   '<span class="divider">|</span><span class="pkg">1 Ðêm</span></li>'
                +    '</ul>'
                +    '</div><!-- end main-mask -->'
                +    '</div><!-- end h-grid-img --><div class="block-info h-grid-info"><div class="rating">'
                ;       
                for (i = 0; i < item['hotel_star']; i++)
                    {html +='<span><i class="fa fa-star orange"></i></span>'};
                for (i = 0; i < (5 -item['hotel_star']); i++)
                    {html +='<span><i class="fa fa-star lightgrey"></i></span>'};
                html += '</div><!-- end rating --><h3 class="block-title"><a href="hotel-detail-left-sidebar.html">'
                        +    item['name'] + '</a></h3>'
                        +   '<p class="block-minor">Khách sạn:' + item['hotel_name'] + '</p>'
                        +   '<div class="grid-btn">'
                        +    '<a href="' + '/room/detail/' + item['id'] + '" class="btn btn-orange btn-block btn-lg">Xem chi tiết</a>'
                        +    '</div><!-- end grid-btn -->'
                        +   '</div><!-- end h-grid-info -->'
                        +   '</div><!-- end h-grid-block -->'
                        +   '</div><!-- end columns -->';
                    });
            return html;
    };
    function avg(arr) {
            if (arr.length > 0) {
                var sum = arr.map( function(elt){ // assure the value can be converted into an integer
                    return /^\d+$/.test(elt) ? parseInt(elt) : 0; 
                })
                    .reduce( function(a,b){ // sum all resulting numbers
                        return a+b
                    });
                    return sum / arr.length;
                } else {
                    return 'dasdas';
                }
            }
</script>
<script>
    $(document).ready(function(){
        $('.home-status').removeClass('active');
        $('.room-status').addClass('active');
    });
</script>
@endsection