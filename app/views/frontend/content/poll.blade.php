@section('center')
<div class="row">
  <div class="col-md-12 content-container">
    <div class="content">
      <div class="title">
        <h1>{{__($displayPoll->title)}}</h1>
      </div>
      <div class="meta">
        <small>{{date("d.m.Y H:i", strtotime($displayPoll->created_at))}}</small>
      </div>
      <div class="share_area">
        <div class="fb-share-button" data-href="{{_l(Request::root()."/ankete/".$displayPoll->id)}}" data-type="button_count"></div>
        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/ankete/".$displayPoll->id)}}" data-via="puskice" data-related="puskice">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <?php 
          $media = "http://puskice.org/puskice-logo.jpg";
        ?>
        <!-- Place this tag where you want the +1 button to render. -->
        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/ankete/".$displayPoll->id)}}"></div>
        <script src="//platform.linkedin.com/in.js" type="text/javascript">
              lang: en_US
            </script>
            <script type="IN/Share" data-counter="right"></script>
        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/ankete/'.$displayPoll->id)}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t($displayPoll->title))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
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
        @if(sizeof($displayPoll->pollOptions) > 0)
          @foreach($displayPoll->pollOptions as $key => $option)
            <p><strong>{{$key +1}}. {{$option->title}}</strong>: {{$option->vote_count}} 
              @if($displayPoll->vote_count > 0)
                ({{number_format($option->vote_count/$displayPoll->vote_count*100, 2)}}%)
              @endif
            </p>
          @endforeach
        @endif
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