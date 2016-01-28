@section('imageOfTheWeek')
	@if(sizeof($featuredImage) > 0)
		<div class="image-of-the-week">
			<h4><a href="{{Request::root()}}/slike">{{__("Слике")}}</a></h4>
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					@foreach($featuredImage as $key => $img)
						<li data-target="#carousel-example-generic" data-slide-to="{{$key}}" @if($key==0) class="active" @endif></li>
				    @endforeach
				</ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner">
			  		@foreach($featuredImage as $key => $img)
					    <div class="item @if($key == 0) active @endif">
					    	<a href="{{_l(Request::root()."/vest/".dateToUrl($img->created_at)."/".$img->permalink)}}">
					    		<img src="{{firstImage($img)}}" alt="{{__(dots($img->title))}}">
					    	</a>
					    </div>
				    @endforeach
			  </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			  </a>
			  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right"></span>
			  </a>
			</div>
		</div>
	@endif
@stop