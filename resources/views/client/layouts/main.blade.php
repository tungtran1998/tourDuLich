<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <base href="{{asset('')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="client/images/favicon.png" type="image/x-icon">


    <!-- link toast -->
    <script src="client/js/toast.min.js"></script>
    <script type="text/javascript" src="client/js/toastr.min.js"></script>
    <link href="client/css/toastr.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="client/css/css.css" rel="stylesheet">

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="client/css/bootstrap.min.css">

    <!-- Font Awesome Stylesheet -->
    <link rel="stylesheet" href="client/css/font-awesome.min.css">

    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="client/css/style.css">
    <link rel="stylesheet" id="cpswitch" href="client/css/orange.css">
    <link rel="stylesheet" href="client/css/responsive.css">

    <!-- Owl Carousel Stylesheet -->
    <link rel="stylesheet" href="client/css/owl.carousel.css">
    <link rel="stylesheet" href="client/css/owl.theme.css">

    <!-- Flex Slider Stylesheet -->
    <link rel="stylesheet" href="client/css/flexslider.css" type="text/css" />

    <!--Date-Picker Stylesheet-->
    <link rel="stylesheet" href="client/css/datepicker.css">

    <!-- Magnific Gallery -->
    <link rel="stylesheet" href="client/css/magnific-popup.css">

    <!-- Slick Stylesheet -->
    <link rel="stylesheet" href="client/css/slick.css">
    <link rel="stylesheet" href="client/css/slick-theme.css">
    <script src="client/js/jquery.min.js"></script>
    <style>
        .user-area {
            float: right;
            padding-right: 0;
            position: relative;
            padding-left: 20px;
        }
        .dropdown .dropdown-toggle {
            line-height: 55px;
            
        }
        .user-area .dropdown-toggle {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }
        .user-area .dropdown-toggle {
            position: relative;
            z-index: 0;
        }
        .user-area .user-menu {
            background: #fff;
            border: none;
            left: inherit !important;
            right: 0;
            top: 40px !important;
            margin: 0;
            max-width: 150px;
            padding: 5px 10px;
            position: absolute;
            width: 100%;
            z-index: 999;
            -webkit-box-shadow: 0 3px 5px rgba(0, 0, 0, 0.7);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.7);
        }
        .user-area .user-avatar {
            float: right;
            width: 30px;
            border: 2px solid #849896;
        }
        .rounded-circle {
            border-radius: 50%!important;
        }
        .user-options{
            overflow-wrap: break-word;
            word-wrap: break-word;
            hyphens: auto;
            padding: 0px;
            display: block;
            margin-left: -5px;
            color: #58595b;
        }
    </style>
    @yield('css')
</head>
<body id="@yield('id-body')">

    <!--====== LOADER =====-->
    <div class="loader"></div>


    <!--======== SEARCH-OVERLAY =========-->
    @include('client.shared.search_overlay')


    <!--============= TOP-BAR ===========-->
    @include('client.shared.top_bar')

    <!--================ NAV BAR===============-->
    @include('client.shared.nav_bar')
    
    @yield('breadcrumb')

    @yield('content')

    <!--======================= FOOTER =======================-->
    @include('client.shared.footer')


<!-- Page Scripts Starts -->

<script src="client/js/jquery.magnific-popup.min.js"></script>
<script src="client/js/bootstrap.min.js"></script>
<script src="client/js/jquery.flexslider.js"></script>
<script src="client/js/bootstrap-datepicker.js"></script>
<script src="client/js/owl.carousel.min.js"></script>
<script src="client/js/custom-navigation.js"></script>
<script src="client/js/custom-flex.js"></script>
<script src="client/js/custom-owl.js"></script>
<script src="client/js/custom-date-picker.js"></script>
<script src="client/js/custom-gallery.js"></script>
<script src="client/js/slick.min.js"></script>
<script src="client/js/custom-slick.js"></script>
<script src="client/js/custom-ajax.js"></script>

    <script>
        function readURL(file){
            if(file.files && file.files[0]){
                var reader = new FileReader();

                reader.onload = function(e){
                    $('#preview_avatar').attr('src',e.target.result);
                }
                reader.readAsDataURL(file.files[0]);
            }
        };

        $("#avatar").change(function(){
            readURL(this)
        })

        $('.changepass').removeClass('active');
        $('.profile').addClass('active');
        $('.booking-management').removeClass('active');


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
        <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f3bf704b7f44f406e95c35a/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
<!-- Page Scripts Ends -->
@yield('script1')

</body>
</html>
