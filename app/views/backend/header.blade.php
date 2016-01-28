@section('header')
    <header class="header">
        <a target="_blank" href="{{Request::root()}}" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            {{Trans::_t(Config::get('settings.site_title'))}}
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-right">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope"></i>
                            <span class="label label-success"> @if($commentCount < 100){{$commentCount}} 
                                @else 99+ @endif</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">{{$commentCount}} {{__(Lang::get('admin.commentCount'))}}</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @foreach($unpublishedComments as $comment) 
                                    <li><!-- start message -->
                                        <a href="{{URL::action('CommentController@getEdit')}}/{{$comment->id}}">
                                            <h4>
                                                {{__(dots($comment->comment_content, 30))}}
                                                <small><i class="fa fa-clock-o"></i> 
                                                    {{__(date("H:i", strtotime($comment->created_at)))}}
                                                </small>
                                            </h4>
                                            <p>{{__(dots($comment->news->title, 70))}}</p>
                                        </a>
                                    </li><!-- end message -->
                                    @endforeach
                                </ul>
                            </li>
                            <li class="footer"><a href="{{URL::action('CommentController@getUnpublished')}}">{{__(Lang::get('admin.unpublishedComments'))}}</a></li>
                        </ul>
                    </li>
                    @if(isset($article))
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">{{$article->comments()->count()}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">{{__(Lang::get('admin.newsInfo'))}}</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> {{$article->view_count}} {{__(Lang::get('admin.viewCount'))}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-thumbs-up success"></i> {{$article->thumbs_up}} {{__(Lang::get('admin.thumbsUp'))}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-thumbs-down danger"></i> {{$article->thumbs_down}} {{__(Lang::get('admin.thumbsDown'))}}
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{URL::action('CommentController@getArticleComments')}}/{{$article->id}}">
                                                <i class="fa fa-edit info"></i> {{$article->comments()->count()}} {{__(Lang::get('admin.comments'))}}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i>
                            <span>{{Session::get('username')}} <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <p>
                                    {{$admin->first_name." ".$admin->last_name}} - {{Config::get('cms.'.Session::get('user_level'))}}
                                    <small>{{__(Lang::get('admin.memberSince')." ".date(Config::get('cms.dateFormat'), strtotime($admin->created_at)))}}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{_l(URL::action('UserController@getEdit').'/'.$admin->id)}}" class="btn btn-default btn-flat">{{__(Lang::get('admin.myInfo'))}}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{URL::action('LoginController@getSignout')}}" class="btn btn-default btn-flat">{{__(Lang::get('login.signout'))}}</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
@stop