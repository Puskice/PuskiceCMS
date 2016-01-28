@section('allNews')
<div class="center-column">
	<div class="center-header">
		<h4>{{__("Све вести")}}</h4>
	</div>
	<div class="center-body">
		@foreach($allNews as $key => $anews)
		<div class="center-article">
			<img src="{{firstImage($anews, true)}}" width="128" height="70" alt="{{__(dots($anews->title))}}">
			<h4><a href="{{_l(Request::root()."/vest/".dateToUrl($anews->created_at)."/".$anews->permalink)}}">{{__($anews->title)}}</a></h4>
			<span><small>{{date("d.m.Y H:i", strtotime($anews->created_at))}}</small></span>
			<p>{{__(strip_tags($anews->short_content))}}</p>
			<hr class="clearfix"/>
		</div>
		@endforeach
		{{$allNews->links()}}
		
	</div>
</div>
@stop