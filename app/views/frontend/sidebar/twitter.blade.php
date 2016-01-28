@section('twitter')
<div class="news-column right-fix">
	<div class="column-header">
		<h3><a href="#">{{__("Твитер")}}</a></h3>
	</div>
	<div class="column-body">
		<a class="twitter-timeline" href="https://twitter.com/search?q=%23fonbg" data-widget-id="370309992710037504">Tweets about "#fonbg"</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>
</div>
@stop