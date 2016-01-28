@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('MenuController@postItemUpdate').'/'.$item->id}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.title'))}}</label>
		                    <input type="text" name="title" class="form-control" value="{{Input::old('title', $item->title)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.url'))}}</label>
		                    <input type="text" name="url" class="form-control" value="{{Input::old('url', $item->url)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.order'))}}</label>
		                    <input type="text" name="ordering" class="form-control" value="{{Input::old('ordering', $item->ordering)}}" />
		                </div>
		                <div class="form-group">
			                <label>{{__(Lang::get('admin.parent'))}}</label>
			                <select name="parent" class="form-control chosen-select">
			                	<option value="NULL" @if($item->parent_id == null) selected = "selected" @endif>
			                		{{__(Lang::get('admin.noparent'))}}
			                	</option>
								@foreach($item->menu->items as $i)
									@if($item->id == $i->id) <?php continue; ?> @endif
									@if($item->parent_id == $i->id)
										<option value="{{$i->id}}" selected="selected">{{$i->title}}</option>
									@else 
										<option value="{{$i->id}}">{{$i->title}}</option>
									@endif
								@endforeach
							</select>
						</div>
						<div class="form-group">
			                <label>{{__(Lang::get('admin.target'))}}</label>
			                <select name="target" class="form-control chosen-select2">
			                	<option value="" @if($item->target == NULL) selected="selected" @endif>{{__(Lang::get('admin.notarget'))}}</option>
			                	<option value="_blank" @if($item->target == '_blank') selected="selected" @endif>_blank</option>
			                	<option value="_self" @if($item->target == '_self') selected="selected" @endif>_self</option>
			                	<option value="_parent" @if($item->target == '_parent') selected="selected" @endif>_parent</option>
			                	<option value="_top" @if($item->target == '_top') selected="selected" @endif>_top</option>
							</select>
						</div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.cssClass'))}}</label>
		                    <input type="text" name="class" class="form-control" value="{{Input::old('class', $item->item_class)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.cssID'))}}</label>
		                    <input type="text" name="cssid" class="form-control" value="{{Input::old('cssid', $item->item_id)}}" />
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
						
		            </div>
		            <div class="box-footer">
		            	<input type="hidden" value="{{Session::get('_token')}}" name="_token"/>
                        <input type="submit" class="btn btn-primary" value="{{__(Lang::get('admin.save'))}}"/>
                        <a href="#" data-href="{{URL::action('MenuController@getItemDestroy')}}/{{$item->id}}" class="btn btn-danger pull-right" data-toggle="modal" data-target="#confirm-delete">{{__(Lang::get('admin.delete'))}}</a>
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
	<script type="text/javascript" src="{{URL::asset('assets/admin/tinymce/tinymce.min.js')}}"></script>
	<script type="text/javascript">
		$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
		$(".chosen-select2").chosen({no_results_text: "Oops, nothing found!"}); 
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
	</script>
@stop