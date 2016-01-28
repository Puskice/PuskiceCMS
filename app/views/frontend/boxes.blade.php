@section('boxes')
<div class="news-box">
	<div class="col-md-4">
		<div class="news-column">
			<div class="column-header">
				<h3><a href="{{Request::root()}}/nas-komentar">{{__("Наш коментар")}}</a></h3>
			</div>
			<div class="column-body">
				@if(isset($ourComment))
					@foreach($ourComment as $key => $news)
						<div class="column-article">
							<img src="{{firstImage($news, true)}}" width="64" height="40" alt="{{__(dots($news->title))}}">
							<h4><a href="{{_l(Request::root()."/vest/".dateToUrl($news->created_at)."/".$news->permalink)}}">{{__(dots($news->title))}}</a></h4>
							<div class="clearfix"></div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="news-column">
			<div class="column-header">
				<h3><a href="http://bazaznanja.puskice.org" target="_blank">{{__("База знања")}}</a></h3>
			</div>
			<div class="column-body">
				@if(isset($feed) && sizeof($feed) > 0)
					@foreach($feed as $key => $item)
							<div class="column-article">
								<img src="//www.puskice.org/puskice2.png" width="64" height="40" alt="Baza znanja">
								<h4><a href="{{$item->link}}" target="_blank">{{__(dots($item->title, 40))}}</a></h4>
								<div class="clearfix"></div>
							</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="news-column right-fix">
			<div class="column-header">
				<h3><a href="{{Request::root()}}/magazin">{{__("Магазин")}}</a></h3>
			</div>
			<div class="column-body">
				@if(isset($magazine))
					@foreach($magazine as $key => $news)
						<div class="column-article">
							<img src="{{firstImage($news, true)}}" width="64" height="40" alt="{{__(dots($news->title))}}">
							<h4><a href="{{_l(Request::root()."/vest/".dateToUrl($news->created_at)."/".$news->permalink)}}">{{__(dots($news->title))}}</a></h4>
							<div class="clearfix"></div>
						</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
@stop