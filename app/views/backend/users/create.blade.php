@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('UserController@postStore')}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.username'))}}</label>
		                    <input type="text" name="user_name" class="form-control" value="{{Input::old('user_name')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.firstName'))}}</label>
		                    <input type="text" name="firstName" class="form-control" value="{{Input::old('firstName')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.lastName'))}}</label>
		                    <input type="text" name="lastName" class="form-control" value="{{Input::old('lastName')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.email'))}}</label>
		                    <input type="text" name="email" class="form-control" value="{{Input::old('email')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.password'))}}</label>
		                    <input type="password" name="password" class="form-control" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.repeatPassword'))}}</label>
		                    <input type="password" name="repeatPassword" class="form-control" />
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
			                    <input type='text' name="createdAt" class="form-control" value="{{Input::old('createdAt')}}" />
			                </div>
			            </div>
						<div class="form-group">
							<select name="published" class="form-control chosen-select2">
								<option value="0">{{__(Lang::get('admin.unpublished'))}}</option>
								<option value="1">{{__(Lang::get('admin.published'))}}</option>
							</select>
						</div>
						<div class="form-group">
							<select name="userLevel" class="form-control chosen-select">
								<option value="1" selected="selected">{{__(Config::get('cms.1'))}}</option>
								<option value="6">{{__(Config::get('cms.6'))}}</option>
								<option value="7">{{__(Config::get('cms.7'))}}</option>
								<option value="8">{{__(Config::get('cms.8'))}}</option>
								<option value="9">{{__(Config::get('cms.9'))}}</option>
								<option value="10">{{__(Config::get('cms.10'))}}</option>
							</select>
						</div>
		            </div>
		            <div class="box-footer">
		            	<input type="hidden" value="{{Session::get('_token')}}" name="_token"/>
                        <input type="submit" class="btn btn-primary" value="{{__(Lang::get('admin.save'))}}"/>
                    </div>
		        </div>
			</div>
		</form>
	</div>
	<!-- Modal -->
	<script type="text/javascript">
		$(".chosen-select2").chosen({no_results_text: "Oops, nothing found!"}); 
		$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
		$(function () {
            $('#datetimepicker1').datetimepicker();
        });
	</script>
@stop