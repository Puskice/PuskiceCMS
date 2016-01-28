@section('poll')
<div class="news-column poll right-fix">
	<div class="column-header">
		<h3><a href="{{Request::root()}}/ankete">{{__("Анкета")}}</a></h3>
	</div>
	<div class="column-body">
		@if(isset($poll->id))
			<p>{{__($poll->title)}}</p>
			<div id="fade_container">
				@if(isset($poll->pollOptions))
					@foreach($poll->pollOptions as $option)
						<div class="checkbox">
					        <label>
					        	<input type="radio" name="option_id" value="{{$option->id}}"> {{__($option->title)}}
					        </label>
					    </div>
				    @endforeach
			    @endif
			    <input type="hidden" name="poll_id" id="poll_id" value="{{$poll->id}}" />
			    <input type="hidden" name="_token" id="token" value="{{Session::get('_token')}}" />
			    <a href="javascript:void(0)" onclick="vote()" class="btn btn-default">{{__("Гласај")}}</a>
			    <a href="javascript:void(0)" onclick="results()" class="btn btn-default pull-right">{{__("Резултати")}}</a>
		    </div>
	    @endif
	</div>
</div>
@stop