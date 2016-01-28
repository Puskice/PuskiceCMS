@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h2>{{__("Креирајте Пушкице налог")}}</h2>
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/login/register")}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/login/register")}}" data-via="puskice" data-related="puskice" data-hashtags="fonbg">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php 
          $media = Config::get('settings.defaultImage');
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/login/register")}}"></div>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(_l(Request::root().'/login/register'))}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(__("Нови чланови | Пушкице | Тачка спајања студената ФОН-а"))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
        <p>
        {{__("Отварањем налога на порталу Пушкице отварате могућност да учествујете у бројним наградним играма и другим погодностима које нудимо студентима.<br/>")}}
      </p>
      <p>
          {{__("Такође, путем овог профила можете користити Базу знања, оцењивати професоре или правити меме постере.<br/>")}}
      </p>
      <p><i>{{__("За све прецизније информације погледајте наше Услове коришћења.")}}</i></p>
      <form action="{{_l(URL::action('LoginController@postRegister'))}}" method="post">
            <div class="body bg-gray">
                <div class="form-group">
                    <input type="text" name="firstName" class="form-control" placeholder="{{__(Lang::get('login.firstName'))}}" value="{{Input::old('firstName')}}" />
                </div>
                <div class="form-group">
                    <input type="text" name="lastName" class="form-control" placeholder="{{__(Lang::get('login.lastName'))}}" value="{{Input::old('lastName')}}"/>
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="{{__(Lang::get('login.username'))}}" value="{{Input::old('username')}}"/>
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="{{__(Lang::get('login.email'))}}" value="{{Input::old('email')}}"/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="{{__(Lang::get('login.password'))}}"/>
                </div>
                <div class="form-group">
                    <input type="password" name="repeatPassword" class="form-control" placeholder="{{__(Lang::get('login.repeatPassword'))}}"/>
                </div>
            </div>
            <div class="footer">                    
                <input type="hidden" value="{{Session::get('_token')}}" name="_token" />
                <button type="submit" class="btn btn-primary btn-block">{{__(Lang::get('login.register'))}}</button>

                <a href="{{URL::action('LoginController@getIndex')}}" class="text-center">{{__(Lang::get('login.alreadyMember'))}}</a>
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

