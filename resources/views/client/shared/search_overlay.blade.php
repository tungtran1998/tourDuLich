<div class="overlay">
    <a href="javascript:void(0)" id="close-button" class="closebtn">&times;</a>
    <div class="overlay-content">
        <div class="form-center">
            <form  method="GET" action="{{route('searchnews')}}">
                <div class="form-group">
                    <div class="input-group">
                        <input type="search" class="form-control" name="query" placeholder="{{trans('allclient.search')}}" required />
                        <span class="input-group-btn"><button type="submit" class="btn" id="btnSearch"><span><i class="fa fa-search"></i></span></button></span>
                    </div><!-- end input-group -->
                </div><!-- end form-group -->

                <div class="suggest-result form-group d-none form-left" id="suggest-result">

                </div>
            </form>
            
        </div><!-- end form-center -->
        
    </div><!-- end overlay-content -->
</div><!-- end overlay -->
