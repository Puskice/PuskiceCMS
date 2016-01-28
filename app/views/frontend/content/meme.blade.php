@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h1>{{__(mb_strtoupper($meme->first_line))}}</h1>
      </div>
      <div class="meta">
        <small>{{date("d.m.Y H:i", strtotime($meme->created_at))}}</small>
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/meme/".$meme->id."-".$meme->permalink)}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/meme/".$meme->id."-".$meme->permalink)}}" data-via="puskice" data-related="puskice" data-hashtags="fonbg">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php 
          $image = Request::root()."/meme/decoder/".$meme->id."/".$meme->meme_id."/".rawurlencode(__($meme->first_line))."/".rawurlencode(__($meme->second_line));
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="60" data-href="{{_l(Request::root()."/meme/".$meme->id."-".$meme->permalink)}}"></div>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root()."/meme/".$meme->id."-".$meme->permalink)}}&amp;media={{rawurlencode($image)}}&amp;description={{rawurlencode(Trans::_t($meme->first_line))}}" data-pin-do="buttonPin" data-pin-config="beside"><img alt="Pinit" src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
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
      <div class="meme_image">
        <img style="max-width: 100%;" src='{{Request::root()."/meme/decoder/".$meme->id."/".$meme->meme_id."/".rawurlencode(__($meme->first_line))."/".rawurlencode(__($meme->second_line))}}' />
      </div>
      <div class="follow_buttons">
        <a href="https://twitter.com/puskice" class="twitter-follow-button" data-show-count="false">Follow @puskice</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <div class="fb-like" data-href="http://www.facebook.com/puskice" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="segoe ui"></div>
        
        <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/106103133810705694757" data-rel="publisher"></div>
      </div>
      <div class="outbrains">
        <div data-src="{{_l(Request::root()."/meme/".$meme->id."-".$meme->permalink)}}" class="OUTBRAIN" ></div>
        <script type="text/javascript">(function(){window.OB_platformType=8;window.OB_langJS="http://widgets.outbrain.com/lang_sr.js";window.OBITm="1416699623536";window.OB_recMode="brn_strip";var ob=document.createElement("script");ob.type="text/javascript";ob.async=true;ob.src="http"+("https:"===document.location.protocol?"s":"")+"://widgets.outbrain.com/outbrainLT.js";var h=document.getElementsByTagName("script")[0];h.parentNode.insertBefore(ob,h);})();</script>
      </div>
      <div class="comment-form">
        <h2>{{Trans::_t("Постави коментар")}}</h2>
        <div class="comment_editor">
          <form name="post_comment" id="post_comment" action="{{Request::root()}}/apicomments/create-meme-comment/{{$meme->id}}" method="POST">
            @if(Session::get("id") == null)
            <div class="form-group">
              <label>{{Trans::_t("Псеудоним")}}: </label>
              <input tabindex="1" name="username" class="form-control" id="username" type="text" />
            </div>
             <div class="form-group">
              <span>E-mail: </span>
              <br />
              <input id="email" tabindex="2" name="email" class="form-control" type="text" />
            </div>
            @else
              <p><strong>{{Trans::_t("Пријављени сте као")}}: <i>{{Session::get("username")}}</i></strong></p>
              <input tabindex="1" name="username" class="form-control" id="username" type="hidden" value="{{Session::get('username')}}" />
              <input id="email" tabindex="2" name="email" class="form-control" type="hidden" />
              <input id="id" tabindex="2" name="id" class="form-control" type="hidden" value="{{Session::get('id')}}" />
            @endif
            <div class="form-group">
              <span>{{Trans::_t("Коментар")}}: </span>
              <br />
              <textarea id="comment_content" tabindex="3" name="comment_content" class="form-control"></textarea>
            </div> 
            <div class="form-group">
              <span>{{Trans::_t("Антиспам")}}: </span>
              <br />
              <p><strong id="num1">{{rand(0,20)}}</strong> + <strong id="num2">{{rand(0,20)}}</strong></p>
              <input id="antibot" type="text" name="antibot" class="form-control" tabindex="4">
            </div>   
            <div class="form-group">
              <input type="hidden" name="_token" value="{{Session::get('_token')}}" id="token" />
              <a class="btn btn-primary" href="javascript:void(0)" id="postbutton" onclick="postMemeComment({{$meme->id}})"><span>{{Trans::_t("Постави коментар")}}</span></a>
              <div style="clear:both"></div>
            </div>
            <div><strong id="response"></strong></div>
            <div><p><small>{{Trans::_t("Коментари пролазе модерацију, зато што смо тако у могућности")}}</small></p></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop