@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h1 itemprop="name">{{__($page->title)}} @if(Session::get('user_level') >= Config::get('cms.editNews')) <small><a href="{{URL::action('PageController@getEdit').'/'.$page->id}}">{{__("Измени")}}</a></small> @endif</h1>
      </div>
      <div class="meta">
        <small>{{date("d.m.Y H:i", strtotime($page->created_at))}}</small>
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/stranica/".$page->permalink)}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/stranica/".$page->permalink)}}" data-via="puskice" data-related="puskice" @if($page->fonbg == 1) data-hashtags="fonbg" @endif>Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php if($page->featured_image == "")
          $media = "http://puskice.org/puskice-logo.jpg";
          else $media = $page->featured_image;
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/stranica/".$page->permalink)}}"></div>
        <script src="//platform.linkedin.com/in.js" type="text/javascript">
          lang: en_US
        </script>
        <script type="IN/Share" data-counter="right"></script>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/stranica/'.$page->permalink)}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t($page->title))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
      @if($page->featured_image != "") 
        <div class="featured-image">
          @if($page->image_caption != "") 
            <div class="image-caption">
              <p>{{$page->image_caption}}</p> 
            </div>
          @endif
          <img src="{{$page->featured_image}}"/>
        </div>
      @endif
      <div class="text-content">
        {{__($page->long_content)}}
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