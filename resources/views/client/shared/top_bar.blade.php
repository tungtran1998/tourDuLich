<div id="top-bar" class="tb-text-grey">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div id="info">
                    <ul class="list-unstyled list-inline">
                        <li>
                            <a href="{{ route('clientlang',['lang' => 'vi']) }}">VI</a>

                            <a href="{{ route('clientlang',['lang' => 'en' ]) }}">EN</a>
                        </li>
                        <li><span><i class="fa fa-map-marker"></i></span>Công Ty TNHH ATS</li>
                        <li><span><i class="fa fa-phone"></i></span>0325664555 </li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div id="links">
                    <ul class="list-unstyled list-inline">
                        @if(isset(Auth::user()->username))
                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" width="30px" height="30px" src="@if (Auth::user()->image == null)   
                                                client/images/user_default.png
                                                @else
                                                administration/imageRooms/{{Auth::user()->image}}
                                                @endif " alt="Avatar">
                            </a>
              
                            <div class="user-menu dropdown-menu">
                                <a class="user-options" href="{{route('profile.profileUser')}}"><i class="fa fa-user"></i>{{trans('allclient.user')}}</a>
                                <a class="user-options" href="{{route('profile.history')}}"><i class="fa fa-cog"></i>{{trans('allclient.history')}}</a>

                                <a class="user-options" href="#" onclick="event.preventDefault();document.querySelector('#admin-logout-form').submit();">
                                    <i class="fa fa-power-off"></i>{{trans('allclient.logout')}}
                                </a>
                                <form id="admin-logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form> 
                            </div>
                        </div>
                        <li><a href="{{route('profile.profileUser')}}"><span><i class="fa fa-lock"></i></span>{{trans('allclient.hii')}} {{Auth::user()->username}}</a></li>

                        @else
                        <li><a href="{{route('client.login')}}"><span><i class="fa fa-lock"></i></span>{{trans('allclient.login')}}</a></li>
                        <li><a href="{{route('register')}}"><span><i class="fa fa-plus"></i></span>{{trans('allclient.register')}}</a></li>
                        @endif
                        
                       
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>