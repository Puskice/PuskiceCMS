@section('slider')
<div class="news-slider">
	<ul class="pgwSlider">
		@foreach($featured as $f)
	    <li>
	    	<a href="{{_l(Request::root()."/vest/".dateToUrl($f->created_at)."/".$f->permalink)}}">
		    	<img src="{{$f->featured_image}}" alt="{{__($f->title)}}" data-description="{{__($f->short_content)}}">
		    	<span>{{__($f->title)}}</span>
		    </a>
		</li>
	    @endforeach
	</ul>
	<div class="clearfix"></div>
</div>
@stop