@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h2>{{__("Да ли си спреман да будеш тајни агент Пушкица?")}}</h2>
      </div>
      <div class="meta">
      <?php $vladar = unserialize($kviz->vladar); $resp = 0; ?>
      <?php $resp = ''; ?>
        @if(sizeof($vladar) == 1 && in_array('Неко трећи', $vladar) || $kviz->biliclan == 'Не бих')
          <?php $resp = "Пушкице кажу да сам залутао. Има ли неко компас? #fonbg"; ?>
        @else 
          @if($kviz->biliclan == 'Дабоме' || $kviz->biliclan == 'Дакако')
            <?php $resp = 'Изгледа да сам скроз као Џејмс Бонд. Пробај и ти Пушкице квиз! #fonbg'; ?>
          @else
            @if($kviz->kadsuculi == 'У трећој години' || $kviz->kadsuculi == 'У четвртој години' || $kviz->kadsuculi == 'У другој години' || $kviz->biliclan == 'Јел дајете сендвиче? Не? Онда ништа.')
              <?php $resp = 'Треба да будем у тиму за специјалне истраге у ПентаФОН-у. Играј и ти Пушкице квиз! #fonbg'; ?>

            @endif
          @endif  
        @endif
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/kviz/")}}" data-type="button_count"></div>
        <a href ="https://twitter.com/intent/tweet?text=<?php echo urlencode($resp); ?>&{{_l(Request::root()."/kviz/")}}&via=puskice" class="twitter-share-button" data-width="85" data-url="" data-via="puskice" data-related="puskice">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php 
          $media = "http://puskice.org/puskice-logo.jpg";
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/kviz/")}}"></div>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/kviz/')}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t("Квиз | Пушкице"))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
        @if(sizeof($vladar) == 1 && in_array('Неко трећи', $vladar) || $kviz->biliclan == 'Не бих')
          <?php $resp = 3; ?>
          <img style="float: left;width: 50%;margin-right:2%;" src="{{URL::to('/')}}/assets/images/mib.jpg" />
          <h3>{{ Trans::_t('Да ниси случајно залутао/ла?') }}</h3>
          <p>{{ Trans::_t('Мораћемо да ти избришемо сећање на овај квиз.') }}</p>
        @else 
          @if($kviz->biliclan == 'Дабоме' || $kviz->biliclan == 'Дакако')
            <?php $resp = 1; ?>
            <img style="float: left;width: 50%;margin-right:2%;" src="{{URL::to('/')}}/assets/images/bond.jpg" />
            <h3>{{ Trans::_t('Па ти си прави Џејмс Бонд!') }}</h3>
            <p><a href="{{URL::to('/')}}/novi-clanovi" class="btn btn-success">Пријави се за наш тим тајних агената</a></p>
          @else
            @if($kviz->kadsuculi == 'У трећој години' || $kviz->kadsuculi == 'У четвртој години' || $kviz->kadsuculi == 'У другој години' || $kviz->biliclan == 'Јел дајете сендвиче? Не? Онда ништа.')
              <?php $resp = 2; ?>
              <img style="float: left;width: 50%;margin-right:2%;" src="{{URL::to('/')}}/assets/images/dora.jpg" />
              <h3>{{ Trans::_t('Твоји одговори говоре да би се одлично уклопио у тим за специјалне истраге Пушкица') }}</h3>
              <p><a href="{{URL::to('/')}}/novi-clanovi" class="btn btn-success">Пријави се</a></p>
            @endif
          @endif  
        @endif
        <div class="clearfix"></div>
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
</div>
@stop