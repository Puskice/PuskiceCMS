@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('ContactController@postStore')}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.contactTitle'))}}</label>
		                    <input type="text" name="title" class="form-control" value="{{Input::old('title')}}" />
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
		                    <label>{{__(Lang::get('admin.description'))}}</label>
		                    <textarea name="description" class="form-control">{{Input::old('description')}}</textarea>
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.webpage'))}}</label>
		                    <input type="text" name="webpage" class="form-control" value="{{Input::old('webpage')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.phone'))}}</label>
		                    <input type="text" name="phone" class="form-control" value="{{Input::old('phone')}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.address'))}}</label>
		                    <input type="text" name="address" class="form-control" value="{{Input::old('address')}}" />
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
							<label>{{__(Lang::get('admin.featuredImage'))}}</label><br/>
							<div class="input-group">
	                            <div class="input-group-btn">
	                                <a type="button" href="{{Request::root()}}/assets/admin/filemanager/dialog.php?field_id=imgField&type=1&akey=<?php echo md5(date('m.Y', strtotime('now'))) ?>" class="btn btn-default featured_img">{{__(Lang::get('admin.pick'))}}</a>
	                            </div><!-- /btn-group -->
	                            <input type="text" class="form-control" id="imgField" name="featuredImage" value="{{Input::old('featuredImage')}}" />
	                        </div>
	                    </div>
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
							<label>{{__(Lang::get('admin.priority'))}}</label>
							<input type="text" name="priority" class="form-control" value="{{Input::old('priority')}}" />
						</div>
						<div class="form-group">
							<select name="news[]" class="form-control chosen-select2" multiple>
								@foreach ($subjects as $key => $subject) 
									<option value="{{$subject->id}}">{{$subject->title}}</option>
								@endforeach
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
	<script type="text/javascript" src="{{URL::asset('assets/admin/tinymce/tinymce.min.js')}}"></script>
	<script type="text/javascript">
		tinymce.init({
		    selector: "textarea",
		    theme: "modern",
		    plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor colorpicker textpattern responsivefilemanager"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		    toolbar2: "print preview media | forecolor backcolor emoticons | responsivefilemanager ",
		    image_advtab: true,
		    external_filemanager_path:"/assets/admin/filemanager/",
		    filemanager_title:"Responsive Filemanager" ,
   			external_plugins: { "filemanager" : "/assets/admin/filemanager/plugin.min.js"},
   			filemanager_access_key:"<?php echo md5(date('m.Y', strtotime('now'))) ?>" ,
		});

		$('.featured_img').fancybox({	
			'width'		: '100%',
			'type'		: 'iframe',
		    'height'    : 500,
			'fitToView' : false,
			'autoSize'  : false
		});
		$(".chosen-select2").chosen({no_results_text: "Oops, nothing found!"}); 
		$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
		$(function () {
            $('#datetimepicker1').datetimepicker();
        });
	</script>
@stop