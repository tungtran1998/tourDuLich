<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{route('dashboard')}}"><i class="menu-icon fa fa-laptop"></i>{{ trans('admin.dashboard') }} </a>
                </li>
                <!-- //User Managerment -->
                @can('user-list','role-list','admin-list')
                <li class="menu-title">{{ trans('admin.user_manager') }}</li>
                @can('user-list')
                <li>
                    <a href="{{route('user.index')}}"> <i class="menu-icon fa fa-users"></i>{{ trans('admin.user') }} </a>
                </li>
                @endcan
                @can('admin-list')
                <li>
                    <a href="{{route('admin.index')}}"> <i class="menu-icon fa fa-user-secret"></i>{{ trans('admin.admin') }} </a>
                </li>
                @endcan
                @can('role-list')
                <li>
                    <a href="{{route('roles.index')}}"> <i class="menu-icon fa fa-users"></i>{{ trans('admin.role') }} </a>
                </li>
                @endcan
                @endcan
                <!-- Tour -->
                <li class="menu-title">{{ trans('admin.Managerment') }}</li>
                <li>
                    <a href="{{route('province.index')}}"> <i class="menu-icon fa fa-address-card-o"></i>{{ trans('admin.Province') }}</a>
                </li>
                <li>
                    <a href="{{route('tour.index')}}"> <i class="menu-icon fa fa-address-card-o"></i>{{ trans('admin.Tour') }}</a>
                </li>
                
                <li>
                    <a href="{{route('booktour.index')}}"> <i class="menu-icon fa fa-address-card-o"></i>{{ trans('admin.Managetourbooking') }}</a>
                </li>
                

                <!-- //Other Managerment -->                        
                @can('new-list','feedback-list','audit-list','vote-list')        
                <li class="menu-title">{{ trans('admin.other') }}</li>

                @can('new-list')
                <li>
                    <a href="{{route('news.index')}}"> <i class="menu-icon fa fa-newspaper-o"></i>{{ trans('admin.new') }}</a>
                </li>
                @endcan
                 @can('feedback-list')
                <li>
                    <a href="{{route('feedback.index')}}"> <i class="menu-icon fa fa-commenting-o"></i>{{ trans('admin.feedback') }}</a>
                </li>
                @endcan
                @can('audit-list')
                <li>
                    <a href="{{route('audit')}}"> <i class="menu-icon fa fa-braille"></i>{{ trans('admin.audit') }}</a>
                </li>
                @endcan
           
                @endcan
                <!-- //Char  -->
                @can('revenue-statistics-by-year','revenue-statistics-by-month')
                <li class="menu-title">{{ trans('admin.chart') }}</li>
                @can('revenue-statistics-by-year')
                <li>
                    <a href="{{route('statistic.year')}}"> <i class="menu-icon fa fa-line-chart"></i>{{ trans('admin.byyear') }}</a>
                </li>
                @endcan
                @can('revenue-statistics-by-month')
                <li>
                    <a href="{{route('statistic.month')}}"> <i class="menu-icon fa fa-area-chart"></i>{{ trans('admin.bymonth') }}</a>
                </li>
                @endcan
                <li>
                    <a href="{{route('statistic.calendar')}}"> <i class="menu-icon fa fa-area-chart"></i>{{trans('admin.calendar')}}</a>
                </li>   
                @endcan 
                     
            </ul>
        </div>
    </nav>
</aside>