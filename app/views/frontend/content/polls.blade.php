@section('center')
<div class="row">
	<div class="col-md-12 content-container">
    	<div class="content">
    		<div class="category-title"><h3>{{__("Анкете")}}</h3></div>
    		@foreach($polls as $poll)
    			<div class="article">
    				<h3><a href="{{_l(Request::root()."/ankete/".$poll->id)}}">{{__($poll->title)}}</a></h3>
    				<div class="meta">
    					<small>{{date("d.m.Y H:i", strtotime($poll->created_at))}}</small>
    				</div>
    				<div class="share_area">
				        <div class="fb-share-button" data-href="{{_l(Request::root()."/ankete/".$poll->id)}}" data-type="button_count"></div>
				        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/ankete/".$poll->id)}}" data-via="puskice" data-related="puskice">Tweet</a>
				        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				        <?php
				          $media = "http://puskice.org/puskice-logo.jpg";
				        ?>
				        <!-- Place this tag where you want the +1 button to render. -->
				        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/ankete/".$poll->id)}}"></div>
						<script type="IN/Share" data-counter="right"></script>
				        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/ankete/'.$poll->id)}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t($poll->title))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
				    </div>
    				<div class="short">
    					@foreach($poll->pollOptions as $key => $option)
    						<p><strong>{{$key +1}}. {{$option->title}}</strong>: {{$option->vote_count}} ({{number_format($option->vote_count/$poll->vote_count*100, 2)}}%)</p>
    					@endforeach
    				</div>
    			</div>
    		@endforeach

    		{{$polls->links()}}
    	</div>
    	<script src="//platform.linkedin.com/in.js" type="text/javascript">
		  lang: en_US
		</script>
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
</div>
@stop