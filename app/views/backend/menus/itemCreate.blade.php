@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('MenuController@postItemStore')."/".$menu->id}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.title'))}}</label>
		                    <input type="text" name="title" class="form-control" value="{{Input::old('title')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.url'))}}</label>
		                    <input type="text" name="url" class="form-control" value="{{Input::old('url')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.order'))}}</label>
		                    <input type="text" name="ordering" class="form-control" value="{{Input::old('ordering')}}" />
		                </div>
		                <div class="form-group">
			                <label>{{__(Lang::get('admin.parent'))}}</label>
			                <select name="parent" class="form-control chosen-select">
			                	<option value="NULL">{{__(Lang::get('admin.noparent'))}}</option>
								@foreach($menu->items as $i)
									<option value="{{$i->id}}">{{$i->title}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
			                <label>{{__(Lang::get('admin.target'))}}</label>
			                <select name="target" class="form-control chosen-select2">
			                	<option value="">{{__(Lang::get('admin.notarget'))}}</option>
			                	<option value="_blank">_blank</option>
			                	<option value="_self">_self</option>
			                	<option value="_parent">_parent</option>
			                	<option value="_top">_top</option>
							</select>
						</div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.cssClass'))}}</label>
		                    <input type="text" name="class" class="form-control" value="{{Input::old('class')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.cssID'))}}</label>
		                    <input type="text" name="cssid" class="form-control" value="{{Input::old('cssid')}}" />
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
                    </div>
		        </div>
			</div>
		</form>
	</div>
	<script type="text/javascript" src="{{URL::asset('assets/admin/tinymce/tinymce.min.js')}}"></script>
	<script type="text/javascript">
		$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
		$(".chosen-select2").chosen({no_results_text: "Oops, nothing found!"}); 
	</script>
@stop