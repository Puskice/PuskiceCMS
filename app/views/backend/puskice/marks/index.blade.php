@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.allMarks'))}}</h3>
                    <div class="box-tools">
                        
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('login.firstName'))}}</th>
                            <th>{{__(Lang::get('login.lastName'))}}</th>
                            <th>{{__(Lang::get('admin.comment'))}}</th>
                            <th>{{__(Lang::get('admin.published'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                            <th>{{__(Lang::get('admin.delete'))}}</th>
                        </tr>
                        @foreach($marks as $mark)
	                        <tr>
                                <td>{{$mark->id}}</td>
                                @if(isset($mark->contact->id))
                                <td><a href="{{_l(URL::action('ContactController@getEdit')."/".$mark->contact->id)}}">{{$mark->contact->first_name}}</a></td>
                                <td><a href="{{_l(URL::action('ContactController@getEdit')."/".$mark->contact->id)}}">{{$mark->contact->last_name}}</a></td>
                                @else
                                    <td colspan="2">{{__(Lang::get('admin.markContactDeleted'))}}</td>
                                @endif
	                            <td>{{__(dots($mark->note, 70))}}</td>
	                            @if($mark->published == 0)
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('MarkController@getPublish').'/'.$mark->id)}}">{{__(Lang::get('admin.publish'))}}</a></td>
                                @else
                                    <td><a class="btn btn-warning" href="{{_l(URL::action('MarkController@getUnpublish').'/'.$mark->id)}}">{{__(Lang::get('admin.unpublish'))}}</a></td>
                                @endif
	                            @if($mark->deleted_at != null)
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('MarkController@getRestore').'/'.$mark->id)}}">{{__(Lang::get('admin.restore'))}}</a></td>
                                @else
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('MarkController@getEdit').'/'.$mark->id)}}">{{__(Lang::get('admin.edit'))}}</a></td>
                                @endif
                                @if($mark->deleted_at != null)
                                    <td><a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" data-href="{{URL::action('MarkController@getDestroy')}}/{{$mark->id}}">{{__(Lang::get('admin.delete'))}}</a></td>
                                @else
                                   <td><a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" data-href="{{URL::action('MarkController@getDelete')}}/{{$mark->id}}">{{__(Lang::get('admin.delete'))}}</a></td>
                                @endif
	                        </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            {{$marks->appends(array('q' => Input::get('q')))->links()}}
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