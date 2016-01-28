@section('errorReporting')
	@if(Session::get('message'))
	    <div class="alert alert-{{Session::get('notif', 'info')}} alert-dismissable">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        {{__(Session::get('message'))}}
	    </div>
	@endif
	@if ( $errors->count() > 0 )
		<div class="alert alert-danger alert-dismissable">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        <ul>
	            @foreach( $errors->all() as $message )
	              <li>{{ __($message) }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
@stop