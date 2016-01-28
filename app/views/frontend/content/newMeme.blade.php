@section('center')
<div class="row">
 	<div class="col-md-12 content-container">
 		<div class="content">
			<h1 class="title">{{Trans::_t("Додајте нови меме")}}</h1>
			<div class="publish_info">
			  <div class="share_area">
			    <div class="fb-share-button" data-href="{{Request::root()}}/memes/new" data-type="button_count"></div>
			    <a href ="https://twitter.com/share" class="twitter-share-button" data-width="85" data-url="{{Request::root()}}/memes/new" data-via="puskice" data-related="puskice" data-hashtags="fonbg">Tweet</a>
			    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			    <?php 
			      $featured_image = "http://puskice.org/puskice-logo.jpg";
			    ?>
			    <a href="//pinterest.com/pin/create/button/?url={{rawurlencode(Request::root()."/memes/new")}}&media={{rawurlencode($featured_image)}}&description={{rawurlencode(Trans::_t("Нови меме - Пушкице"))}}" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>
			    <!-- Place this tag where you want the +1 button to render. -->
			    <div class="g-plusone" data-size="medium" data-width="60" data-href="{{Request::root()}}/memes/new"></div>

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
			<div class="clear_text">
			  <?php echo $errors->first('first_line'); ?>
			  <?php echo $errors->first('second_line'); ?>
			  <?php echo $errors->first('meme_id'); ?>
			  <form action="{{Request::root()}}/memes/add" method="post">
			    <div class="form-group">
			      <label for="first_line">{{Trans::_t("Горњи текст")}}</label>
			      <input type="text" id="first_line" class="form-control" name="first_line" placeholder="{{Trans::_t('Горњи текст')}}" value="{{Input::old('first_line', "")}}">
			    </div>
			    <div class="form-group">
			      <label for="second_line">{{Trans::_t("Доњи текст")}}</label>
			      <input type="text" id="second_line" class="form-control" name="second_line" placeholder="{{Trans::_t('Доњи текст')}}" value="{{Input::old('second_line', "")}}">
			    </div>
			    <div class="form-group">
	              	<span>{{__("Антиспам")}}: </span>
	              	<br />
	              	<p><strong id="num1">{{Session::get('antispam1')}}</strong> + <strong id="num2">{{Session::get('antispam2')}}</strong></p>
	              	<input id="antibot" type="text" name="antibot" class="form-control" tabindex="4">
	            </div>  
			    <label>{{Trans::_t("Одаберите лик")}}</label>
			    <div class="memes"> 
			      @foreach($memes as $key => $meme)
			      <div class="meme">
			        <label for="meme-{{$key+1}}"><img src="{{Request::root()}}/{{$meme->img}}" style="max-height:120px; width: auto" /><br/>
			        <input id="meme-{{$key+1}}" @if(Input::old('meme_id') == $meme->id) checked="checked" @endif type="radio" name="meme_id" value="{{$meme->id}}" /> {{Trans::_t($meme->name)}}</label>
			      </div>
			      @endforeach
			      <div class="clearfix"></div>
			    </div>
			    <div class="form-group">
			     	<input type="hidden" value="{{Session::get('_token')}}" name="_token"/>
			      	<input type="submit" id="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="{{Trans::_t('Направи меме')}}">
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