<nav class="navbar navbar-default main-navbar navbar-custom navbar-white" id="mynavbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" id="menu-button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="header-search hidden-lg">
                <a href="javascript:void(0)" class="search-button"><span><i class="fa fa-search"></i></span></a>
            </div>
            <a href="{{ url('/') }}" class="navbar-brand"><span><img height="72px" src="https://atstravel.com.vn/uploads/logo/ATS-TRAVEL-NEW-.png"></span></a>
        </div><!-- end navbar-header -->

        <div class="collapse navbar-collapse" id="myNavbar1">
            <ul class="nav navbar-nav navbar-right">
                <li class="home-status active"><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
                <li class="top-tour-status"><a href="{{route('tour')}}">TOUR</a>
                </li>
                <li class="top-tour-status"><a href="{{ route('news') }}">Vận chuyển</a></li>
        
                <li class="top-discount-status"><a href="{{route('discount')}}">{{trans('allclient.Promotiontour')}}</a></li>
                <li class="news-status"><a href="{{ route('news') }}">Tin tức</a></li>
               
                <li class="contact-status"><a href="{{ route('feedback') }}">{{trans('allclient.contact')}}</a></li>
       
                <li><a href="javascript:void(0)" class="search-button" onclick="display()"><span><i class="fa fa-search"></i></span></a></li>
            </ul>
        </div><!-- end navbar collapse -->
    </div><!-- end container -->
</nav><!-- end navbar -->

<div class="sidenav-content">
    <div id="mySidenav" class="sidenav" >
        <h2 id="web-name"><span><i class="fa fa-plane">BOOKING</i></span>TOUR</h2>

        <div id="main-menu">
            <div class="closebtn">
                <button class="btn btn-default" id="closebtn">&times;</button>
            </div><!-- end close-btn -->
            <div class="list-group panel">
                <li class="home-status active list-group-item"><a href="{{route('home.client')}}">{{trans('allclient.home')}}</a></li>
                <li class="top-tour-status list-group-item"><a href="{{route('tour')}}">TOUR</a></li>
              
                <li class="top-discount-status list-group-item"><a href="{{route('discount')}}">{{trans('allclient.Promotiontour')}}</a></li>
                <li class="news-status list-group-item"><a href="{{ route('news') }}">Blog</a></li>
            
                <li class="contact-status list-group-item"><a href="{{ route('feedback') }}">{{trans('allclient.contact')}}</a></li>

            
            </div><!-- end list-group -->
        </div><!-- end main-menu -->
    </div><!-- end mySidenav -->
</div><!-- end sidenav-content -->