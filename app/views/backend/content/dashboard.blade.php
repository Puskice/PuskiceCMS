@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.news'))}}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-default btn-xs" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                        </tr>
                        @foreach ($news as $key => $news)
                        <tr>
                            <td>{{$news->id}}</td>
                            <td>{{__(dots($news->title, 70))}}</td>
                            <td><a href="{{_l(URL::action('NewsController@getEdit').'/'.$news->id)}}" class="btn btn-default">{{__(Lang::get('admin.edit'))}}</span></td>
                        </tr>
                        @endforeach
                    </tbody></table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.comments'))}}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-primary btn-xs" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                        </tr>
                        @foreach ($comments as $key => $comment)
                        <tr>
                            <td>{{$comment->id}}</td>
                            <td>{{__(dots($comment->comment_content, Config::get('cms.3dots')))}}</td>
                            <td><a href="{{_l(URL::action('CommentController@getEdit').'/'.$comment->id)}}" class="btn btn-primary">{{__(Lang::get('admin.edit'))}}</span></td>
                        </tr>
                        @endforeach
                    </tbody></table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <!-- Primary box -->
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.users'))}}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-info btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-info btn-xs" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                        </tr>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{__(dots($user->username, Config::get('cms.3dots')))}}</td>
                            <td><a href="{{_l(URL::action('UserController@getEdit').'/'.$user->id)}}" class="btn btn-info">{{__(Lang::get('admin.edit'))}}</span></td>
                        </tr>
                        @endforeach
                    </tbody></table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-4">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.pages'))}}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-default btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-default btn-xs" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                        </tr>
                        @foreach ($pages as $key => $news)
                        <tr>
                            <td>{{$news->id}}</td>
                            <td>{{__(dots($news->title, 70))}}</td>
                            <td><a href="{{_l(URL::action('PageController@getEdit').'/'.$news->id)}}" class="btn btn-default">{{__(Lang::get('admin.edit'))}}</span></td>
                        </tr>
                        @endforeach
                    </tbody></table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <!-- Default box -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.categories'))}}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-primary btn-xs" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                        </tr>
                        @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{__(dots($category->title))}}</td>
                            <td><a href="{{_l(URL::action('CategoryController@getEdit').'/'.$category->id)}}" class="btn btn-primary">{{__(Lang::get('admin.edit'))}}</span></td>
                        </tr>
                        @endforeach
                    </tbody></table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->

        <div class="col-md-4">
            <!-- Primary box -->
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">{{__(Lang::get('admin.files'))}}</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-info btn-xs" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-info btn-xs" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-hover">
                        <tbody><tr>
                            <th>{{__(Lang::get('admin.id'))}}</th>
                            <th>{{__(Lang::get('admin.title'))}}</th>
                            <th>{{__(Lang::get('admin.edit'))}}</th>
                        </tr>
                        @foreach ($files as $key => $file)
                        <tr>
                            <td>{{$file->id}}</td>
                            <td>{{__(dots($file->title))}}</td>
                            <td><a href="{{_l(URL::action('FileController@getEdit').'/'.$file->id)}}" class="btn btn-info">{{__(Lang::get('admin.edit'))}}</span></td>
                        </tr>
                        @endforeach
                    </tbody></table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>
@stop