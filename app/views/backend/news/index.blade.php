@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.allNews'))}}</h3>
                    <div class="box-tools">
                        <a href="{{URL::action('NewsController@getIndex')}}" class="btn btn-flat btn-primary pull-right">{{__(Lang::get('admin.allNews'))}}</a>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.date'))}}</th>
                            <th>{{__(Lang::get('admin.status'))}}</th>
                            <th>{{__(Lang::get('admin.comments'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                            <th>{{__(Lang::get('admin.delete'))}}</th>
                        </tr>
                        @foreach($news as $n)
	                        <tr>
	                            <td>{{$n->id}}</td>
	                            <td>{{__(dots($n->title, 90))}}</td>
	                            <td>{{date('d.m.Y H:i', strtotime($n->created_at))}}</td>
	                            <td>{{newsStatus($n)}}</td>
	                            <td><a href="{{_l(URL::action('CommentController@getArticleComments').'/'.$n->id)}}" class="btn btn-info">{{commentCount($n)}}</a></td>
	                            @if($n->deleted_at != null)
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('NewsController@getRestore').'/'.$n->id)}}">{{__(Lang::get('admin.restore'))}}</a></td>
                                @else
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('NewsController@getEdit').'/'.$n->id)}}">{{__(Lang::get('admin.edit'))}}</a></td>
                                @endif
                                @if($n->deleted_at != null)
                                    <td><a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" data-href="{{URL::action('NewsController@getDestroy')}}/{{$n->id}}">{{__(Lang::get('admin.delete'))}}</a></td>
                                @else
	                               <td><a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" data-href="{{URL::action('NewsController@getDelete')}}/{{$n->id}}">{{__(Lang::get('admin.delete'))}}</a></td>
                                @endif
	                        </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            {{$news->appends(array('q' => Input::get('q')))->links()}}
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
                $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
            </script>
        </div>
    </div>
@stop