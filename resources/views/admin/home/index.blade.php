@extends('admin.layouts.main')
@section('title',trans('admin.dashboard'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-lg-3 col-md-6">
      <a href="{{route('news.index')}}">
        <div class="card">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib">
                <i class="ti-pulse"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text"><span class="count">{{$news}}</span></div>
                  <div class="stat-heading">{{trans('admin.new')}}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    
    <div class="col-lg-3 col-md-6">
      <div class="card">
        <a href="{{route('tour.index')}}">
          <div class="card-body">
            <div class="stat-widget-five">
              <div class="stat-icon dib flat-color-2">
                <i class="fa fa-home"></i>
              </div>
              <div class="stat-content">
                <div class="text-left dib">
                  <div class="stat-text"><span class="count">{{$tour_total}}</span></div>
                  <div class="stat-heading">Tours</div>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    
    
    <div class="col-lg-3 col-md-6">
     <a href="{{route('province.index')}}">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-five">
            <div class="stat-icon dib flat-color-3">
              <i class="fa fa-heart-o"></i>
            </div>
            <div class="stat-content">
              <div class="text-left dib">
                <div class="stat-text"><span class="count">{{$provinces}}</span></div>
                <div class="stat-heading">{{trans('admin.provinces')}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  
  
  <div class="col-lg-3 col-md-6">
    <a href="{{route('user.index')}}">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-five">
            <div class="stat-icon dib flat-color-4">
              <i class="pe-7s-users"></i>
            </div>
            <div class="stat-content">
              <div class="text-left dib">
                <div class="stat-text"><span class="count">{{$user_total}}</span></div>
                <div class="stat-heading">{{trans('admin.user')}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="box-title">{{trans('admin.Statistics')}} </h4>
      </div>
      <div class="row">
        <div class="col-lg-8">
          <div class="card-body">
            <!-- <canvas id="TrafficChart"></canvas>   -->
            <div id="traffic-chart" class="traffic-chart"></div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card-body">
            <div class="progress-box progress-1">
              <h4 class="por-title">{{trans('admin.Registeredaccount')}}</h4>
              <div class="progress mb-2" style="height: 5px;">
                <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 100%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
            <div class="progress-box progress-2">
              <h4 class="por-title">{{trans('admin.Booktournumber')}}</h4>
              <div class="progress mb-2" style="height: 5px;">
                <div class="progress-bar bg-flat-color-4" role="progressbar" style="width: 100%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div> <!-- /.card-body -->
        </div>
      </div> <!-- /.row -->
      <div class="card-body"></div>
    </div>
  </div><!-- /# column -->
</div>
</div>
@endsection
@section('script')
<!-- Scripts -->
<!--Chartist Chart-->
<script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
<script src="admin/assets/js/init/weather-init.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
<script src="admin/assets/js/init/fullcalendar-init.js"></script>

<script>
  $(function () {
    $.ajax({
      url     : '{{action('Admin\HomeController@chart')}}',
      method  : 'get',
      success : function(response){
        initChart(response);
      }
    });
    function initChart(result){
      var chart = new Chartist.Line('#traffic-chart', {
        labels: result[0],
        series: [
        result[1], 
        result[2]
        ]
      }, {
        low: 0,
        showArea: true,
        showLine: false,
        showPoint: false,
        fullWidth: true,
        axisX: {
          showGrid: true
        }
      });

      chart.on('draw', function(data) {
        if(data.type === 'line' || data.type === 'area') {
          data.element.animate({
            d: {
              begin: 2000 * data.index,
              dur: 2000,
              from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
              to: data.path.clone().stringify(),
              easing: Chartist.Svg.Easing.easeOutQuint
            }
          });
        }
      });
    }
  });
</script>
@include('admin.shared.notification')
@endsection
