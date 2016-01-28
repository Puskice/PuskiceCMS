@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h2>{{__("Hextrix")}}</h2>
      </div>
      <div class="meta">

      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/hextrix/")}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/hextrix/")}}" data-via="puskice" data-related="puskice">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php 
          $media = "http://puskice.org/puskice-logo.jpg";
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/hextrix/")}}"></div>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/hextrix/')}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t("Пакмен | Пушкице"))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
          <canvas id="canvas"></canvas>
          <div id='devtools' style='z-index:3;display:none;position:absolute;left:50%;width:400px;height:400px;top:50%;margin-top:-200px;margin-left:-200px;'>
            <h2 id = 'clickToExit' style = 'background-color:#fff;color:#000'>Click to exit</h2>
            <textarea id ='devtoolsText' style = 'height:300px;width:400px;'></textarea>
          </div>
          <div class="faded overlay"></div>
          <div id="attributions">Started by <a href="http://github.com/teamsnowman" target="_blank">@teamsnowman</a> at <a href= 'http://www.hackexeter.com/' target="_blank">HackExeter</a><br>
            Finished by <a href="http://github.com/meadowstream" target="_blank">Logan Engstrom</a> & <a href='http://github.com/garrettdreyfus' target="_blank">Garrett Finucane</a> on <a href = 'http://github.com/hextris/hextris' target="_blank">GitHub</a><br>
            <a href = 'https://itunes.apple.com/us/app/id903769553?mt=8'><b>iOS</b></a> <b>&</b> <a href ='https://play.google.com/store/apps/details?id=com.hextris.hextris'><b>Android</b></a> apps + <a href ='http://hextris.github.io/presskit/info.html'>press kit</a> @ <a href='http://hextris.github.io/'>http://hextris.github.io/</a>
          </div>
          <div id='startBtn' style='position:absolute;left:40%;top:38%;height:25%;width:25%;z-index:99999999;cursor:pointer;'></div>
          <div id="helpScreen" class = 'unselectable'>
            <h1 class = 'instructions_body'>Instructions</h1>
            <p class = 'instructions_body' id = 'inst_main_body'></p>
          </div>
          <div id="openSideBar" class = 'helpText'><i class="fa fa-info-circle fa-lg"></i> <i class="fa fa-arrow-left"><b>  Help</b></i></div>
          <div class="faded overlay"></div>
          <div id = 'pauseBtn'><div id = 'pauseBtnInner'><i class="fa fa-pause fa-2x"></i></div></div>
          <div id = 'restartBtn'><div id = 'restartBtnInner'><i class="fa fa-refresh fa-2x"></i></div></div>
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