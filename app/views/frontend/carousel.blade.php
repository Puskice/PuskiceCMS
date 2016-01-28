@section('carousel')
<div class="row">
	<div class="col-md-12 carousel-container">
		<div class="news-carousel">
			@foreach($articles as $article)
		  	<div style="background-image:url('{{"//".implode("/", array_slice(explode("/", Puskice::firstImage($article, true)), 2))}}')" class="carousel-item">
		  		<div class="carousel-title">
			  		<h4><a href="{{_l(Request::root()."/vest/".dateToUrl($article->created_at)."/".$article->permalink)}}">{{__(dots($article->title, 70))}}</a></h4>
			  	</div>
		  	</div>
		  	@endforeach
		</div>
	</div>
</div>
@stop