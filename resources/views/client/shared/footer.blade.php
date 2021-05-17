<section id="footer" class="ftr-heading-w ftr-heading-mgn-2">
    <div id="footer-top" class="banner-padding ftr-top-grey ftr-text-grey">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 footer-widget ftr-about ftr-our-company">
                    <h3 class="footer-heading">{{trans('allclient.dev')}}</h3>
                    <p>
                        <h4>Trần Minh Tùng</h4>
                    </p>
                    <ul class="social-links list-inline list-unstyled">
                        <li><a href="#"><span><i class="fa fa-facebook"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-twitter"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-google-plus"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-pinterest-p"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-instagram"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-linkedin"></i></span></a></li>
                        <li><a href="#"><span><i class="fa fa-youtube-play"></i></span></a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 footer-widget ftr-map">
                    <div class="map">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14895.80604219965!2d105.7835012!3d21.0346261!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xea1ddbf88f84453f!2zQ8O0bmcgVHkgVG5oaCBYw7pjIFRp4bq_biBUaMawxqFuZyBN4bqhaSBWw6AgRHUgTOG7i2NoIEF0cw!5e0!3m2!1svi!2s!4v1620362581189!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-bottom" class="ftr-bot-black">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="copyright">
                    <p>© 2021 {{trans('allclient.copy_right')}} Book Tour. </p>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="terms">
                    <ul class="list-unstyled list-inline">
                        <li><a href="{{route('term')}}">{{trans('allclient.rule')}}</a></li>
                        <li><a href="{{route('term')}}">{{trans('allclient.policy')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
  </script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="116249303503707"
  theme_color="#ffc300"
  logged_in_greeting="Xin chào! Booking tour có thể giúp gì cho bạn?"
  logged_out_greeting="Xin chào! Booking tour có thể giúp gì cho bạn?">
      </div> --}}