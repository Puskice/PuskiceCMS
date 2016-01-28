@section('bottomBoxes')
<div class="news-box">
	<div class="col-md-4">
		<div class="news-column">
			<div class="column-header">
				<h3><a href="{{{Request::root()}}}/nas-komentar">{{{__("Резултати")}}}</a></h3>
			</div>
			<div class="column-body">
				@if(isset($results))
					@foreach($results as $key => $news)
						<div class="column-article">
							<img src="{{{firstImage($news, true)}}}" width="64" height="40" alt="{{__(dots($news->title))}}">
							<h4><a href="{{{_l(Request::root()."/vest/".dateToUrl($news->created_at)."/".$news->permalink)}}}">{{{__(dots($news->title))}}}</a></h4>
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
				<h3><a href="http://bazaznanja.puskice.org" target="_blank">{{{__("База знања")}}}</a></h3>
			</div>
			<div class="column-body">
				@if(isset($feed) && sizeof($feed) > 0)
					@foreach($feed as $key => $item)
							<div class="column-article">
								<img src="//www.puskice.org/puskice2.png" width="64" height="40" alt="{{__(dots($item->title))}}">
								<h4><a href="{{{$item->link}}}" target="_blank">{{{__(dots($item->title, 40))}}}</a></h4>
								<div class="clearfix"></div>
							</div>
					@endforeach
				@endif
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="news-column poll right-fix">
			<div class="column-header">
				<h3><a href="{{{Request::root()}}}/ankete">{{{__("Анкета")}}}</a></h3>
			</div>
			<div class="column-body">
				@if(isset($poll->id))
					<p>{{{__($poll->title)}}}</p>
					<div id="fade_container">
						@if(isset($poll->pollOptions))
							@foreach($poll->pollOptions as $option)
								<div class="checkbox">
							        <label>
							        	<input type="radio" name="option_id" value="{{{$option->id}}}"> {{{__($option->title)}}}
							        </label>
							    </div>
						    @endforeach
					    @endif
					    <input type="hidden" name="poll_id" id="poll_id" value="{{{$poll->id}}}" />
					    <input type="hidden" name="_token" id="token" value="{{{Session::get('_token')}}}" />
					    <a href="javascript:void(0)" onclick="vote()" class="btn btn-default">{{{__("Гласај")}}}</a>
					    <a href="javascript:void(0)" onclick="results()" class="btn btn-default pull-right">{{{__("Резултати")}}}</a>
				    </div>
			    @endif
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
@stop