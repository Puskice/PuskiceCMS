@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('ContactController@postUpdate')}}/{{$contact->id}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.contactTitle'))}}</label>
		                    <input type="text" name="title" class="form-control" value="{{Input::old('title', $contact->title)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.firstName'))}}</label>
		                    <input type="text" name="firstName" class="form-control" value="{{Input::old('firstName', $contact->first_name)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.lastName'))}}</label>
		                    <input type="text" name="lastName" class="form-control" value="{{Input::old('lastName', $contact->last_name)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('login.email'))}}</label>
		                    <input type="text" name="email" class="form-control" value="{{Input::old('email', $contact->email)}}" />
		                </div>
		                
	                    <div class="form-group">
		                    <label>{{__(Lang::get('admin.description'))}}</label>
		                    <textarea name="description" class="form-control">{{Input::old('description', $contact->description)}}</textarea>
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.webpage'))}}</label>
		                    <input type="text" name="webpage" class="form-control" value="{{Input::old('webpage', $contact->webpage)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.phone'))}}</label>
		                    <input type="text" name="phone" class="form-control" value="{{Input::old('phone', $contact->phone)}}" />
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.address'))}}</label>
		                    <input type="text" name="address" class="form-control" value="{{Input::old('address', $contact->address)}}" />
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
	                            <input type="text" class="form-control" id="imgField" name="featuredImage" value="{{Input::old('featuredImage', $contact->image)}}" />
	                        </div>
	                    </div>
						<div class="form-group">
			                <div class='input-group date' id='datetimepicker1' data-date-format="DD.MM.YYYY HH:mm">
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                    <input type='text' name="createdAt" class="form-control" value="{{Input::old('createdAt', $contact->created_at)}}" />
			                </div>
			            </div>
						<div class="form-group">
							<select name="published" class="form-control chosen-select2">
								<option value="0" @if($contact->published == 0) selected="selected" @endif>{{__(Lang::get('admin.unpublished'))}}</option>
								<option value="1" @if($contact->published == 1) selected="selected" @endif>{{__(Lang::get('admin.published'))}}</option>
							</select>
						</div>
						<div class="form-group">
							<label>{{__(Lang::get('admin.priority'))}}</label>
							<input type="text" name="priority" class="form-control" value="{{Input::old('priority')}}" />
						</div>
						<div class="form-group">
							<select name="news[]" class="form-control chosen-select2" multiple>
								@foreach ($subjects as $key => $subject) 
									<option value="{{$subject->id}}"
										@foreach($contact->newsContacts as $nc)
											@if($nc->news_id == $subject->id)
												selected="selected"
											@endif
										@endforeach
									>{{$subject->title}}</option>
								@endforeach
							</select>
						</div>
		            </div>
		            <div class="box-footer">
		            	<input type="hidden" value="{{Session::get('_token')}}" name="_token"/>
                        <input type="submit" class="btn btn-primary" value="{{__(Lang::get('admin.save'))}}"/>
                        <a href="#" data-href="{{URL::action('ContactController@getDelete')}}/{{$contact->id}}" class="btn btn-danger pull-right" data-toggle="modal" data-target="#confirm-delete">{{__(Lang::get('admin.delete'))}}</a>
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
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
	</script>
@stop