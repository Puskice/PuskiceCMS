@section('content')
	<div class="row">
		<form method="post" action="{{URL::action('PollController@postUpdate')}}/{{$poll->id}}">
			<div class="col-md-8">
				<div class="box box-primary">
					<div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
						<div class="form-group">
		                    <label>{{__(Lang::get('admin.question'))}}</label>
		                    <input type='text' name="question" class="form-control" value="{{Input::old('question', $poll->title)}}" />
		                </div>
		                <div class="form-group poll-options">
		                    <label>{{__(Lang::get('admin.pollOptions'))}}</label>
		                    @foreach($poll->pollOptions as $option)
		                    <div class="row poll-option">
		                    	<div class="col-md-2">
		                    		<div class="input-group">
		                                <input type="text" class="form-control" name="voteCount[{{$option->id}}]" value="{{{$option->vote_count}}}">
		                            </div>
	                            </div>
	                            <div class="col-md-10">
	                            	<div class="input-group">
		                                <input type="text" class="form-control" name="options[{{$option->id}}]" value="{{{$option->title}}}">
		                                <span class="input-group-btn">
		                                    <button class="btn btn-danger btn-flat btn-remove" type="button">{{__(Lang::get('admin.removeOption'))}}</button>
		                                </span>
	                                </div>
	                            </div>
	                        </div>
	                        <br/>
	                        @endforeach
		                </div>
		                <button onclick="addOption('{{__(Lang::get('admin.removeOption'))}}')" class="btn btn-primary" type="button">{{__(Lang::get('admin.addOption'))}}</button>
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
							<label>{{__(Lang::get('admin.startDate'))}}</label>
			                <div class='input-group date' id='datetimepicker1' data-date-format="DD.MM.YYYY HH:mm">
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                    <input type='text' name="createdAt" class="form-control" value="{{Input::old('createdAt', $poll->created_at)}}" />
			                </div>
			            </div>
			            <div class="form-group">
			            	<label>{{__(Lang::get('admin.endDate'))}}</label>
			                <div class='input-group date' id='datetimepicker1' data-date-format="DD.MM.YYYY HH:mm">
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
			                    </span>
			                    <input type='text' name="endDate" class="form-control" value="{{Input::old('endDate', $poll->end_date)}}" />
			                </div>
			            </div>
						<div class="form-group">
							<select name="published" class="form-control chosen-select2">
								<option @if($poll->published == 0) selected="selected" @endif value="0">{{__(Lang::get('admin.unpublished'))}}</option>
								<option @if($poll->published == 1) selected="selected" @endif value="1">{{__(Lang::get('admin.published'))}}</option>
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