@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('MemeController@postInstanceUpdate')}}/{{$meme->id}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
                    	<div class="form-group">
		                    <label>{{__(Lang::get('admin.firstLine'))}}</label>
		                    <input type="text" name="first_line" class="form-control" value="{{Input::old('first_line', $meme->first_line)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.secondLine'))}}</label>
		                    <input type="text" name="second_line" class="form-control" value="{{Input::old('second_line', $meme->second_line)}}" />
		                </div>
                    	<div class="form-group">
							<label>{{__(Lang::get('admin.meme'))}}</label><br/>
							<select class="form-control chosen-select2" name="meme">
		                    	@foreach($memes as $m)
		                    		@if($m->id == $meme->meme_id)
		                    			<option value="{{$m->id}}" selected="selected">{{$m->name}}</option>
		                    		@else
		                    			<option value="{{$m->id}}">{{$m->name}}</option>
		                    		@endif
		                    	@endforeach
		                    </select>
	                    </div>
		            </div>
	            </div>
			</div>
			<div class="col-md-4">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
					<div class="box-body">
						<div class="form-group">
			                <div class='input-group date' id='datetimepicker1' data-date-format="DD.MM.YYYY HH:mm">
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                    <input type='text' name="createdAt" class="form-control" value="{{Input::old('createdAt', $meme->created_at)}}" />
			                </div>
			            </div>
		            </div>
		            <div class="box-footer">
		            	<input type="hidden" value="{{Session::get('_token')}}" name="_token"/>
                        <input type="submit" class="btn btn-primary" value="{{__(Lang::get('admin.save'))}}"/>
                        <a href="#" data-href="{{URL::action('MemeController@getInstanceDelete')}}/{{$meme->id}}" class="btn btn-danger pull-right" data-toggle="modal" data-target="#confirm-delete">{{__(Lang::get('admin.delete'))}}</a>
                    </div>
		        </div>
			</div>
		</form>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{__(Lang::get('admin.close'))}}</span></button>
	        <h4 class="modal-title" id="myModalLabel">{{__(Lang::get('admin.confirmDelete'))}}</h4>
	      </div>
	      <div class="modal-body">
	        <i class="fa fa-exclamation-triangle fa-4x"></i>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">{{__(Lang::get('admin.close'))}}</button>
	        <a href="#" class="btn btn-danger danger">{{__(Lang::get('admin.confirm'))}}</a>
	      </div>
	    </div>
	  </div>
	</div>
	<script type="text/javascript">

		$('.featured_img').fancybox({	
			'width'		: '90%',
			'type'		: 'iframe',
		    'height'    : 500,
			'fitToView' : false,
			'autoSize'  : false
		});
		$(".chosen-select2").chosen({no_results_text: "Oops, nothing found!"}); 
		$(function () {
            $('#datetimepicker1').datetimepicker();
        });
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
	</script>
@stop