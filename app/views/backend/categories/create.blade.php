@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('CategoryController@postStore')}}">
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
		                    <label>{{__(Lang::get('admin.permalink'))}}</label>
		                    <input type="text" name="permalink" class="form-control" value="{{Input::old('permalink')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.isTag'))}}
		                    <input type="checkbox" name="is_tag" class="form-control" value="1" /></label>
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
@stop