@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('PageController@postUpdate')}}/{{$article->id}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.title'))}}</label>
		                    <input type="text" class="form-control" name="title" value="{{Input::old('title', $article->title)}}" />
		                </div>

		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.permalink'))}}</label>
		                    <input type="text" class="form-control" name="permalink" value="{{Input::old('permalink', $article->permalink)}}" />
		                </div>

						<div class="form-group">
		                    <label>{{__(Lang::get('admin.shortContent'))}}</label>
		                    <textarea name="shortContent" class="form-control">{{Input::old('shortContent', $article->short_content)}}</textarea>
		                </div>

						<div class="form-group">
		                    <label>{{__(Lang::get('admin.longContent'))}}</label>
		                    <textarea rows="20" name="longContent" class="form-control">{{Input::old('longContent', $article->long_content)}}</textarea>
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
						@if($article->published == 1)
							<p><strong>{{__(Lang::get('admin.viewNews'))}}: </strong><a target="_blank" href="{{_l(Request::root()."/stranica/".$article->permalink)}}">{{$article->title}}</a> - {{__(Lang::get('admin.adminOnly'))}}</p> 
						@elseif($article->published == 2)
							<p><strong>{{__(Lang::get('admin.viewNews'))}}: </strong><a target="_blank" href="{{_l(Request::root()."/stranica/".$article->permalink)}}">{{$article->title}}</a></p> 
						@endif
						<div class="form-group">
			                <div class='input-group date' id='datetimepicker1' data-date-format="DD.MM.YYYY HH:mm">
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                    <input type='text' name="createdAt" class="form-control" value="{{Input::old('createdAt', date('d.m.Y H:i', strtotime($article->created_at)))}}" />
			                </div>
			            </div>
						<div class="form-group">
							<label>{{__(Lang::get('admin.featuredImage'))}}</label><br/>
							<div class="input-group">
	                            <div class="input-group-btn">
	                                <a type="button" href="{{Request::root()}}/assets/admin/filemanager/dialog.php?field_id=imgField&type=1&akey=<?php echo md5(date('m.Y', strtotime('now'))) ?>" class="btn btn-default featured_img">{{__(Lang::get('admin.pick'))}}</a>
	                            </div><!-- /btn-group -->
	                            <input type="text" class="form-control" id="imgField" name="featuredImage" value="{{Input::old('featuredImage', $article->featured_image)}}" />
	                        </div>
	                    </div>
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.imageCaption'))}}</label>
		                    <input type="text" class="form-control" name="imageCaption" value="{{Input::old('imageCaption', $article->image_caption)}}" />
		                </div>
						<div class="form-group">
							<select name="published" class="form-control chosen-select2">
								<option value="0" @if($article->published == 0) selected="selected" @endif
								>{{__(Lang::get('admin.unpublished'))}}</option>
								<option value="1" @if($article->published == 1) selected="selected" @endif>
									{{__(Lang::get('admin.adminOnly'))}}</option>
								<option value="2" @if($article->published == 2) selected="selected" @endif>
									{{__(Lang::get('admin.published'))}}</option>
							</select>
						</div>
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.author'))}}</label>
		                    <select class="form-control chosen-select3" name="publishedBy">
		                    	@foreach($users as $user)
		                    		@if($user->id == $article->published_by)
		                    			<option value="{{$user->id}}" selected="selected">{{$user->username}}</option>
		                    		@else
		                    			<option value="{{$user->id}}">{{$user->username}}</option>
		                    		@endif
		                    	@endforeach
		                    </select>
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.editor'))}}</label>
		                    <select class="form-control chosen-select4" name="lastModofiedBy">
		                    	@foreach($users as $user)
		                    		@if($user->id == $article->last_modified_by)
		                    			<option value="{{$user->id}}" selected="selected">{{$user->username}}</option>
		                    		@else
		                    			<option value="{{$user->id}}">{{$user->username}}</option>
		                    		@endif
		                    	@endforeach
		                    </select>
		                </div>
		            </div>
		            <div class="box-footer">
		            	<input type="hidden" value="{{Session::get('_token')}}" name="_token"/>
                        <input type="submit" class="btn btn-primary" value="{{__(Lang::get('admin.update'))}}"/>
                        <a href="#" data-href="{{URL::action('PageController@getDelete')}}/{{$article->id}}" class="btn btn-danger pull-right" data-toggle="modal" data-target="#confirm-delete">{{__(Lang::get('admin.delete'))}}</a>
                    </div>
                    <div class="box-footer">
		            	<a class="btn btn-default" href="{{_l(URL::action('CommentController@getArticleComments').'/'.$article->id)}}">{{__(Lang::get('admin.newsComments'))}}</a>
                        <a href="{{_l(URL::action('CommentController@getCreate').'/'.$article->id)}}" class="btn pull-right btn-default">{{__(Lang::get('admin.newComment'))}}</a>
                    </div>
                    <div class="box-footer">
		            	<a class="btn btn-default" href="{{_l(URL::action('FileController@getNewsFiles').'/'.$article->id)}}">{{__(Lang::get('admin.filesHere'))}}</a>
		            	<a class="btn btn-default pull-right" href="{{_l(URL::action('FileController@getCreate').'/'.$article->id)}}">{{__(Lang::get('admin.newFile'))}}</a>
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
			'width'		: '90%',
			'type'		: 'iframe',
		    'height'    : 500,
			'fitToView' : false,
			'autoSize'  : false
		});
		$(".chosen-select2").chosen({no_results_text: "Oops, nothing found!"}); 
		$(".chosen-select3").chosen({no_results_text: "Oops, nothing found!"}); 
		$(".chosen-select4").chosen({no_results_text: "Oops, nothing found!"}); 
		$(function () {
            $('#datetimepicker1').datetimepicker();
        });
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
        });
	</script>
@stop