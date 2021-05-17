@extends('admin.layouts.main')
@section('title',trans('admin.byyear'))
@section('content')
<div class="animated fadeIn">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="mb-3"><strong>{{trans('admin.byyear')}}</strong> </h4>
          <canvas id="sales-chart"></canvas>
        </div>
      </div>
    </div>
  </div>

</div><!-- .animated -->
@endsection
@section('script')
<!-- Scripts -->
<!--Chartist Chart-->
<script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>




<!--  Chart js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>


<!--Flot Chart-->
<script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

<script>
  $(function () {
    $.ajax({
      url: '{{action('Admin\StatisticalController@revenueStatistics')}}',
      method  : 'get',
      success : function(response){
        initChart(response);
      }
    });
    function initChart(result){
      "use strict";
      //Sales chart
      var ctx = document.getElementById( "sales-chart" );
      ctx.height = 150;
      var myChart = new Chart( ctx, {
        type: 'line',
        data: {
          labels: result[0],
          type: 'line',
          defaultFontFamily: 'Montserrat',
          datasets: [ {
            label: "Revenue (VND)",
            data: result[1],
            backgroundColor: 'transparent',
            borderColor: 'rgba(220,53,69,0.75)',
            borderWidth: 3,
            pointStyle: 'circle',
            pointRadius: 5,
            pointBorderColor: 'transparent',
            pointBackgroundColor: 'rgba(220,53,69,0.75)',
          }]
        },
        options: {
          responsive: true,
          tooltips: {
            mode: 'index',
            titleFontSize: 12,
            titleFontColor: '#000',
            bodyFontColor: '#000',
            backgroundColor: '#fff',
            titleFontFamily: 'Montserrat',
            bodyFontFamily: 'Montserrat',
            cornerRadius: 3,
            intersect: false,
          },
          legend: {
            display: false,
            labels: {
              usePointStyle: true,
              fontFamily: 'Montserrat',
            },
          },
          scales: {
            xAxes: [ {
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: false,
                labelString: 'Month'
              }
            } ],
            yAxes: [ {
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: true,
                labelString: 'Value'
              }
            } ]
          },
          title: {
            display: false,
            text: 'Normal Legend'
          }
        }
      } );
    }
  });
</script>
@endsection
