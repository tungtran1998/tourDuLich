<header id="header" class="header">
  <div class="top-left">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{route('dashboard')}}"><img src="administration/images/ats.png" alt="Logo"></a>
      <a class="navbar-brand hidden" href="./"><img src="administration/images/logo2.png" alt="Logo"></a>
      <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
    </div>
  </div>
  <div class="top-right">
    <div class="header-menu">
      <div class="header-left">
        <button class="search-trigger"><i class="fa fa-search"></i></button>
        <div class="form-inline">
          <form class="search-form">
            <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
            <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
          </form>
        </div>
        @if(Auth::user()->can('notification-show','notification-showhight'))
        @if (count($notifications) >= 0)
        <div class="dropdown for-notification ">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell"></i>
            <span class="count bg-danger" id="count">{{ count($notifications) }}</span>
          </button>
          <div class="dropdown-menu menu-notification" aria-labelledby="notification" id="thongBao">
            <p class="red">{{ trans('admin.you_have') }} <span id="count2">{{ count($notifications) }}</span> {{ trans('admin.notification') }}</p>
            @foreach ($notifications  as $notification)
            <div id="notification-title"></div>
            <a class="dropdown-item media"  href="{{route('notification.show',$notification->id)}}">
              <i class="fa fa-check"></i>
              <p>
                {{ json_decode($notification->data)->title }}
              </p>
            </a>
            @endforeach
          </div>
        </div>
        @endif
        @endif
        <div class="dropdown for-message">
          <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i style="font-size: 30px" class="fa fa-language" aria-hidden="true">
            </i>

          </button>
          <div class="dropdown-menu" aria-labelledby="message">
            <a class="dropdown-item media" href="{{ route('lang',['lang' => 'vi']) }}">VI</a>

            <a class="dropdown-item media" href="{{ route('lang',['lang' => 'en' ]) }}">EN</a>
          </div>
        </div>
      </div>

      <div class="user-area dropdown float-right">
        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="user-avatar rounded-circle" src="administration/images/admin.png" alt="">
        </a>

        <div class="user-menu dropdown-menu">
          <a class="nav-link" href="{{route('adminProfile',Auth::guard('admin')->user()->id)}}"><i class="fa fa- user"></i>{{ trans('admin.myprofile') }}</a>
          <a class="nav-link" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
            <i class="fa fa-power -off"></i>{{ trans('admin.logout') }}</a>
          </a>
          <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
          </form> 
        </div>
      </div>

    </div>
  </div>
</header>