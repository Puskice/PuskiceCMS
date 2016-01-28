@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('FileController@postStore')}}">
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
							<label>{{__(Lang::get('admin.fileURL'))}}</label><br/>
							<div class="input-group">
	                            <div class="input-group-btn">
	                                <a type="button" href="{{Request::root()}}/assets/admin/filemanager/dialog.php?field_id=fileFld&akey=<?php echo md5(date('m.Y', strtotime('now'))) ?>" class="btn btn-default featured_img">{{__(Lang::get('admin.pick'))}}</a>
	                            </div><!-- /btn-group -->
	                            <input type="text" class="form-control" id="fileFld" name="url" value="{{Input::old('url')}}" />
	                        </div>
	                    </div>
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.description'))}}</label>
		                    <textarea name="description" class="form-control">{{Input::old('description')}}</textarea>
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
								<option value="0">
									{{__(Lang::get('admin.unpublished'))}}</option>
								<option value="1">
									{{__(Lang::get('admin.published'))}}</option>
							</select>
						</div>
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.author'))}}</label>
		                    <p>{{Session::get('username')}}</p>
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.news'))}}</label>
		                    @if($news->postType == 1)
		                    	<p><strong><a href="{{_l(URL::action('NewsController@getEdit').'/'.$news->id)}}">{{__($news->title)}}</a></strong></p>
		                    @else
		                    	<p><strong><a href="{{_l(URL::action('PageController@getEdit').'/'.$news->id)}}">{{__($news->title)}}</a></strong></p>
		                    @endif
		                </div>
		            </div>
		            <div class="box-footer">
		            	<input type="hidden" value="{{Session::get('_token')}}" name="_token"/>
		            	<input type="hidden" value="{{$id}}" name="newsId"/>
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