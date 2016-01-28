@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('CommentController@postUpdate')}}/{{$comment->id}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.commentContent'))}}</label>
		                    <textarea name="commentContent" class="form-control">{{Input::old('commentContent', $comment->comment_content)}}</textarea>
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
			                    <input type='text' name="createdAt" class="form-control" value="{{Input::old('createdAt', date('d.m.Y H:i', strtotime($comment->created_at)))}}" />
			                </div>
			            </div>
						<div class="form-group">
							<select name="published" class="form-control chosen-select2">
								<option value="0" @if($comment->published == 0) selected="selected" @endif
								>{{__(Lang::get('admin.unpublished'))}}</option>
								<option value="1" @if($comment->published == 1) selected="selected" @endif>
									{{__(Lang::get('admin.published'))}}</option>
							</select>
						</div>
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.author'))}}</label>
		                    @if($comment->user_id == 0)
		                    	<p><strong><a href="mailto:{{$comment->email}}">{{$comment->username}}</strong></a></p>
		                    @else
		                    	<p><strong><a href="{{_l(URL::action('UserController@getEdit').'/'.$comment->user_id)}}">{{$comment->username}}</a></strong></p>
		                    @endif
		                </div>
		                <div class="form-group">
		                    <label>{{__(Lang::get('admin.news'))}}</label>
		                    @if($comment->news->postType == 1)
		                    	<p><strong><a href="{{_l(URL::action('NewsController@getEdit').'/'.$comment->news_id)}}">{{$comment->news->title}}</a></strong></p>
		                    @else
		                    	<p><strong><a href="{{_l(URL::action('PageController@getEdit').'/'.$comment->news_id)}}">{{$comment->news->title}}</a></strong></p>
		                    @endif
		                </div>
		            </div>
		            <div class="box-footer">
		            	<input type="hidden" value="{{Session::get('_token')}}" name="_token"/>
		            	<input type="hidden" value="{{$comment->news->id}}" name="newsId"/>
                        <input type="submit" class="btn btn-primary" value="{{__(Lang::get('admin.update'))}}"/>
                        <a href="#" data-href="{{URL::action('CommentController@getDelete')}}/{{$comment->id}}" class="btn btn-danger pull-right" data-toggle="modal" data-target="#confirm-delete">{{__(Lang::get('admin.delete'))}}</a>
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
			'width'		: 900,
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