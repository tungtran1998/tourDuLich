<div class="breadcrumbs ">
    <div class="breadcrumbs-inner shadow">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><a href="{{route('dashboard')}}">{{ trans('admin.dashboard') }}</a> </h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a>@yield('title')</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>