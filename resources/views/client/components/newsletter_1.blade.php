<section id="newsletter-1" class="section-padding back-size newsletter"> 
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                <h2>{{trans('allclient.register_infor')}}</h2>
                <p>{{trans('allclient.incentive')}}</p>	
                {!! Form::open(['route' => 'member.store', 'method' => 'post']) !!}
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" name="email" id="emailSubscription" class="form-control input-lg" value="" placeholder="{{trans('allclient.enter_email')}}" required/>
                            <span class="input-group-btn"><button class="btn btn-lg" id="btn-email" type="submit"><i class="fa fa-envelope"></i></button></span>
                            <span class="text-danger">{{ $errors->first('email')}}</span>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div><!-- end columns -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end newsletter-1 -->