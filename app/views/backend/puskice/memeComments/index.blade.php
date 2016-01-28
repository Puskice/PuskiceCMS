@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.allComments'))}}</h3>
                    <div class="box-tools">
                        
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.date'))}}</th>
                            <th>{{__(Lang::get('admin.status'))}}</th>
                            <th>{{__(Lang::get('admin.article'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                            <th>{{__(Lang::get('admin.delete'))}}</th>
                        </tr>
                        @foreach($comments as $comment)
	                        <tr>
	                            <td>{{$comment->id}}<br/>
                                    <small @if(amres($comment->ip_address)) style='color:#f00' @endif)>{{$comment->ip_address}}</small>
                                </td>
	                            <td>{{__(dots($comment->comment_content, 70))}}</td>
	                            <td>{{date('d.m.Y H:i', strtotime($comment->created_at))}}</td>
	                            @if($comment->published == 0)
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('MemeCommentController@getPublish').'/'.$comment->id)}}">{{__(Lang::get('admin.publish'))}}</a></td>
                                @else
                                    <td><a class="btn btn-warning" href="{{_l(URL::action('MemeCommentController@getUnpublish').'/'.$comment->id)}}">{{__(Lang::get('admin.unpublish'))}}</a></td>
                                @endif
	                            <td><a href="{{_l(URL::action('MemeController@getInstanceEdit').'/'.$comment->meme->id)}}" class="btn bg-navy">{{__(dots($comment->meme->first_line, 80))}}</a></td>
	                            @if($comment->deleted_at != null)
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('MemeCommentController@getRestore').'/'.$comment->id)}}">{{__(Lang::get('admin.restore'))}}</a></td>
                                @else
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('MemeCommentController@getEdit').'/'.$comment->id)}}">{{__(Lang::get('admin.edit'))}}</a></td>
                                @endif
                                @if($comment->deleted_at != null)
                                    <td><a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" data-href="{{URL::action('MemeCommentController@getDestroy')}}/{{$comment->id}}">{{__(Lang::get('admin.delete'))}}</a></td>
                                @else
                                   <td><a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" data-href="{{URL::action('MemeCommentController@getDelete')}}/{{$comment->id}}">{{__(Lang::get('admin.delete'))}}</a></td>
                                @endif
	                        </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            {{$comments->appends(array('q' => Input::get('q')))->links()}}
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
            <script>
                $('#confirm-delete').on('show.bs.modal', function(e) {
                    $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
                });
            </script>
        </div>
    </div>
@stop