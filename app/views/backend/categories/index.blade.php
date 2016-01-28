@section('content')
	<div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.categories'))}}</h3>
                    <div class="box-tools">
                        
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.permalink'))}}</th>
                            <th>{{__(Lang::get('admin.newsCount'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                            <th>{{__(Lang::get('admin.delete'))}}</th>
                        </tr>
                        @foreach($categories as $category)
	                        <tr>
	                            <td>{{$category->id}}<br/>
                                </td>
	                            <td>{{__(dots($category->title, 70))}}</td>
	                            <td>{{__(dots($category->permalink, 70))}}</td>
                                <td>{{__(dots($category->newsCategories()->count()))}}</td>
	                            @if($category->deleted_at != null)
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('CategoryController@getRestore').'/'.$category->id)}}">{{__(Lang::get('admin.restore'))}}</a></td>
                                @else
                                    <td><a class="btn btn-primary" href="{{_l(URL::action('CategoryController@getEdit').'/'.$category->id)}}">{{__(Lang::get('admin.edit'))}}</a></td>
                                @endif
                                @if($category->deleted_at != null)
                                    <td><a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" data-href="{{URL::action('CategoryController@getDestroy')}}/{{$category->id}}">{{__(Lang::get('admin.delete'))}}</a></td>
                                @else
                                   <td><a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger" data-href="{{URL::action('CategoryController@getDelete')}}/{{$category->id}}">{{__(Lang::get('admin.delete'))}}</a></td>
                                @endif
	                        </tr>
                        @endforeach
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            {{$categories->appends(array('q' => Input::get('q')))->links()}}
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