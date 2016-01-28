@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('MenuController@postUpdate').'/'.$menu->id}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.title'))}}</label>
		                    <input type="text" name="title" class="form-control" value="{{Input::old('title', $menu->menu_title)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.cssClass'))}}</label>
		                    <input type="text" name="class" class="form-control" value="{{Input::old('class', $menu->menu_class)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.cssID'))}}</label>
		                    <input type="text" name="cssid" class="form-control" value="{{Input::old('cssid', $menu->menu_id)}}" />
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
                        <a href="#" data-href="{{URL::action('MenuController@getDestroy')}}/{{$menu->id}}" class="btn btn-danger pull-right" data-toggle="modal" data-target="#confirm-delete">{{__(Lang::get('admin.delete'))}}</a>
                    </div>
		        </div>
			</div>
		</form>
	</div>

	<div class="row">
		<div class="col-md-8">
			<div class="box box-primary">
				<div class="box-header">
                    <h3 class="box-title"></h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                            <th>{{__(Lang::get('admin.delete'))}}</th>
                        </tr>
                        {{$menuHelper->echoMenu($menu->items)}}
                    </table>
                </div><!-- /.box-body -->
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
                    <a href="{{URL::action('MenuController@getItemCreate')}}/{{$menu->id}}" class="btn btn-primary">{{__(Lang::get('admin.createMenuItem'))}}</a>
                </div>
	        </div>
		</div>
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
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
	</script>
@stop