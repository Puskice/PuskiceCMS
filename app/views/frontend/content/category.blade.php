@section('center')
<div class="row">
	<div class="col-md-12 content-container">
    	<div class="content">
    		<div class="category-title"><h3>{{__($category->title)}}</h3></div>
    		@foreach($categoryNews as $news)
    			<div class="article">
    				<h3><a href="{{_l(Request::root()."/vest/".dateToUrl($news->created_at)."/".$news->permalink)}}">{{__($news->title)}}</a></h3>
    				<div class="meta">
    					<small>{{date("d.m.Y H:i", strtotime($news->created_at))}}</small>
    				</div>
    				<div class="share_area">
				        <div class="fb-share-button" data-href="{{_l(Request::root()."/vest/".dateToUrl($news->created_at)."/".$news->permalink)}}" data-type="button_count"></div>
				        <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{_l(Request::root()."/vest/".dateToUrl($news->created_at)."/".$news->permalink)}}" data-via="puskice" data-related="puskice" @if($news->fonbg == 1) data-hashtags="fonbg" @endif>Tweet</a>
				        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
				        <?php if($news->featured_image == "")
				          $media = "http://puskice.org/puskice-logo.jpg";
				          else $media = $news->featured_image;
				        ?>
				        <!-- Place this tag where you want the +1 button to render. -->
				        <div class="g-plusone" data-size="medium" data-width="50" data-href="{{_l(Request::root()."/vest/".dateToUrl($news->created_at)."/".$news->permalink)}}"></div>
						<script type="IN/Share" data-counter="right"></script>
				        <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root().'/vest/'.dateToUrl($news->created_at).'/'.$news->permalink)}}&amp;media={{rawurlencode($media)}}&amp;description={{rawurlencode(Trans::_t($news->title))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pinit" /></a>
				    </div>
    				<div class="short">
    					@if($category->show_pictures && $news->featured_image != "")
    						<img style="width:100%" src="{{$news->featured_image}}" />
    					@endif
    					{{__(strip_tags($news->short_content))}}
    				</div>
    			</div>
    		@endforeach

    		{{$categoryNews->links()}}
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