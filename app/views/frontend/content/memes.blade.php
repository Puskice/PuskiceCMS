@section('center')
    <div class="row">
      <div class="col-md-12 content-container">
        @yield('banners')
        @foreach($articles as $key => $article)
        <div class="content">
          <div class="title">
            <h2><a href="{{_l(Request::root()."/meme/".$article->id."-".$article->permalink)}}">{{__(mb_strtoupper($article->first_line))}}</a> @if(Session::get('user_level') >= Config::get('cms.editMemes')) <small><a href="{{URL::action('MemeController@getInstanceEdit').'/'.$article->id}}">{{__("Измени")}}</a></small> @endif</h2>
          </div>
          <div class="meta">
            <small>{{date("d.m.Y H:i", strtotime($article->created_at))}}</small>
          </div>
          <div class="share_area">
            <div class="fb-share-button" data-href="{{_l(Request::root()."/meme/".$article->id."-".$article->permalink)}}" data-type="button_count"></div>
            <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/meme/".$article->id."-".$article->permalink)}}" data-via="puskice" data-related="puskice">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <?php 
              $media = Request::root()."/meme/decoder/".$article->id."/".$article->meme_id."/".rawurlencode($article->first_line)."/".rawurlencode($article->second_line);
            ?>
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/meme/".$article->id."-".$article->permalink)}}"></div>
            <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/meme/'.$article->id."-".$article->permalink)}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t($article->title))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
            <img style="max-width: 100%;" src="{{Request::root()."/meme/decoder/".$article->id."/".$article->meme_id."/".rawurlencode($article->first_line)."/".rawurlencode($article->second_line)}}" />
          </div>
          <div class="follow_buttons">
            <a href="https://twitter.com/puskice" class="twitter-follow-button" data-show-count="false">Follow @puskice</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
            <div class="fb-like" data-href="http://www.facebook.com/puskice" data-send="false" data-layout="button_count" data-width="150" data-show-faces="false" data-font="segoe ui"></div>
            
            <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/106103133810705694757" data-rel="publisher"></div>
          </div>
        </div>
        @endforeach

        {{$articles->links()}}
      </div>
    </div>
@stop