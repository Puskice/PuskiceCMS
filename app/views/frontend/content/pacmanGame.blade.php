@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h2>{{__("Пакмен - Легендарна игрица")}}</h2>
      </div>
      <div class="meta">

      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/pacman/")}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/pacman/")}}" data-via="puskice" data-related="puskice">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php 
          $media = "http://puskice.org/puskice-logo.jpg";
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/pacman/")}}"></div>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/pacman/')}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t("Пакмен | Пушкице"))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
      <style type='text/css'>
        @font-face {
        font-family: 'BDCartoonShoutRegular';
          src: url('assets/frontend/pacman/BD_Cartoon_Shout-webfont.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
        }
        #pacman {
          height:450px;
          width:342px;
          margin:20px auto;
        }
        #shim { 
          font-family: BDCartoonShoutRegular; 
          position:absolute;
          visibility:hidden
        }
        a { text-decoration:none; }
      </style>
      <div class="text-content">
        <div id="shim">shim for font face</div>
        <div id="pacman"></div>
        <script src="{{Request::root()}}/assets/frontend/pacman/pacman.js"></script>
        <script src="{{Request::root()}}/assets/frontend/pacman/modernizr-1.5.min.js"></script>
        <script>

          var el = document.getElementById("pacman");

          if (Modernizr.canvas && Modernizr.localstorage && 
              Modernizr.audio && (Modernizr.audio.ogg || Modernizr.audio.mp3)) {
            window.setTimeout(function () { PACMAN.init(el, "./"); }, 0);
          } else { 
            el.innerHTML = "Sorry, needs a decent browser<br /><small>" + 
              "(firefox 3.6+, Chrome 4+, Opera 10+ and Safari 4+)</small>";
          }
        </script>
        {{__("Заслуге: ")}}<a href="http://arandomurl.com/">Writeup</a> | <a href="http://arandomurl.com/">Github</a>
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