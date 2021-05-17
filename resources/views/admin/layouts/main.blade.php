<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <base href="{{asset('')}}">
    <meta name = "csrf-token" content = "{{csrf_token ()}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>


    <meta name="description" content="Ela Admin">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="administration/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="administration/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="administration/assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="administration/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    @include('admin.shared.leftPanel')
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel bg-danger">
        <!-- Header-->
        @include('admin.shared.header')

        <!-- /#header -->
        <!--breadcrumbs-->
            @include('admin.shared.breadcrumbs')
            <!--breadcrumbs-->
        <!-- Content -->
        <div class="content ">
            
            @yield('content')
            
        </div>
        <!-- /.content -->
        
        <!-- Footer -->
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="administration/assets/js/main.js"></script>

    <script src="administration/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="administration/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="administration/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="administration/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="administration/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="administration/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="administration/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="administration/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="administration/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="administration/assets/js/init/datatables-init.js"></script>

    
    

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );
  </script>
<script type="text/javascript">
    $(document).on('click','.deletebutton',function(){
        var userID=$(this).attr('data-id');
        $('#id').val(userID);
    });

    @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}"

        switch(type){
            case 'info':
                 toastr.info("{{ Session::get('message') }}");
                 break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//js.pusher.com/3.1/pusher.min.js"></script>


<script type="text/javascript">
    //Thay giá trị PUSHER_APP_KEY vào chỗ xxx này nhé
    var count = ({{ count($notifications) }});
    var pusher = new Pusher('f737559fc7bb5422bc36', {
        encrypted: true,
        cluster: "ap1"
    });
    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        // alert(JSON.stringify(data.link));
        count += 1;
        document.querySelector('#count').innerHTML = count;
        document.querySelector('#count2').innerHTML = count;
        var newNotificationHtml = `
        <a class="dropdown-item media"  href="admin/notificationHight/`+data.link+`"> 
            <i class="fa fa-check"></i> 
            <p>`+data.message+`</p>
        </a>`;
        document.querySelector('#notification-title').innerHTML = newNotificationHtml;
      
    });
</script>


@yield('script')
</body>
</html>
