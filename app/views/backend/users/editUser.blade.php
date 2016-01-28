@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('UserController@postUpdate').'/'.$user->id}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.username'))}}</label>
		                    <input type="text" name="user_name" class="form-control" value="{{Input::old('user_name', $user->username)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.firstName'))}}</label>
		                    <input type="text" name="firstName" class="form-control" value="{{Input::old('firstName', $user->first_name)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.lastName'))}}</label>
		                    <input type="text" name="lastName" class="form-control" value="{{Input::old('lastName', $user->last_name)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.email'))}}</label>
		                    <input type="text" name="email" class="form-control" value="{{Input::old('email', $user->email)}}" />
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
			                    <input type='text' name="createdAt" class="form-control" value="{{Input::old('createdAt', date('d.m.Y H:i:s', strtotime($user->created_at)))}}" />
			                </div>
			            </div>
						<div class="form-group">
							<select name="published" class="form-control chosen-select2">
								<option value="0" @if($user->published == 0) selected="selected" @endif>
									{{__(Lang::get('admin.unpublished'))}}</option>
								<option value="1" @if($user->published == 1) selected="selected" @endif >
									{{__(Lang::get('admin.published'))}}</option>
							</select>
						</div>
						<div class="form-group">
							<select name="userLevel" class="form-control chosen-select">
								<option value="1" selected="selected"
								@if($user->user_level == 1) selected="selected" @endif>
								{{__(Config::get('cms.1'))}}</option>
								<option value="2" @if($user->user_level == 2) selected="selected" @endif>
									{{__(Config::get('cms.2'))}}</option>
								<option value="3" @if($user->user_level == 3) selected="selected" @endif>
									{{__(Config::get('cms.3'))}}</option>
								<option value="4" @if($user->user_level == 4) selected="selected" @endif>
									{{__(Config::get('cms.4'))}}</option>
								<option value="6" @if($user->user_level == 6) selected="selected" @endif>
									{{__(Config::get('cms.6'))}}</option>
								<option value="7" @if($user->user_level == 7) selected="selected" @endif>
									{{__(Config::get('cms.7'))}}</option>
								<option value="8" @if($user->user_level == 8) selected="selected" @endif>
									{{__(Config::get('cms.8'))}}</option>
								<option value="9" @if($user->user_level == 9) selected="selected" @endif>
									{{__(Config::get('cms.9'))}}</option>
								<option value="10" @if($user->user_level == 10) selected="selected" @endif>
									{{__(Config::get('cms.10'))}}</option>
							</select>
						</div>
		            </div>
		            <div class="box-footer">
		            	<input type="hidden" value="{{Session::get('_token')}}" name="_token"/>
                        <input type="submit" class="btn btn-primary" value="{{__(Lang::get('admin.save'))}}"/>
                        <a href="#" data-href="{{URL::action('UserController@getDelete')}}/{{$user->id}}" class="btn btn-danger pull-right" data-toggle="modal" data-target="#confirm-delete">{{__(Lang::get('admin.delete'))}}</a>
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
		$(".chosen-select2").chosen({no_results_text: "Oops, nothing found!"}); 
		$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
		$(function () {
            $('#datetimepicker1').datetimepicker();
        });
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
	</script>
@stop