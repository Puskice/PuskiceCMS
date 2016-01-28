@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h1>{{__("Пријавите се на Пушкице налог")}}</h1>
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/login")}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/login")}}" data-via="puskice" data-related="puskice" data-hashtags="fonbg">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php 
          $media = Config::get('settings.defaultImage');
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/login")}}"></div>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(_l(Request::root().'/login'))}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(__("Нови чланови | Пушкице | Тачка спајања студената ФОН-а"))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
        <!-- Place this tag after the last +1 button tag. -->
        <script type="text/javascript">
          window.___gcfg = {lang: 'sr'};
          (function() {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
          })();
        </script>
        <script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
      </div>
      <div class="text-content">
      <form action="{{_l(URL::action('LoginController@postSignin'))}}" method="post">
            <div class="body bg-gray">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="{{__(Lang::get('login.username'))}}"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="{{__(Lang::get('login.password'))}}"/>
                </div>          
                <div class="form-group">
                    <input type="checkbox" name="remember" value="1"/> {{__(Lang::get('login.rememberMe'))}}
                    <input type="hidden" name="_token" value="{{Session::get('_token')}}">
                    <input type="hidden" name="subdomain" value="{{Input::get('subdomain', "")}}">
                    <input type="hidden" name="ref" value="{{Input::get('ref', "")}}">
                </div>
            </div>
            <div>           
                {{LoginController::getFacebookLoginFormLink()}}                                                    
                <button type="submit" class="btn btn-primary btn-block">{{__(Lang::get('login.signin'))}}</button>  
                <br/>
                <a class="btn btn-warning" href="{{Request::root()}}/login/reset-password">{{__(Lang::get('login.forgotPassword'))}}</a>
                
                <a class="btn btn-success pull-right" href="{{Request::root()}}/login/register" class="text-center">{{__(Lang::get('login.register'))}}</a>
            </div>
        </form>
      </div>
      <div class="follow_buttons">
        <a href="https://twitter.com/puskice" class="twitter-follow-button" data-show-count="false">Follow @puskice</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <div class="fb-like" data-href="http://www.facebook.com/puskice" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="segoe ui"></div>
        
        <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/106103133810705694757" data-rel="publisher"></div>
      </div>
    </div>
  </div>
</div>
@stop

