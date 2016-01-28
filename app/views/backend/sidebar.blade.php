@section('sidebar')
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left info">
                <p>{{__(Lang::get('admin.hello'))}}, {{Session::get('username')}}</p>
            </div>
        </div>
        <!-- search form -->
        <form action="" method="get" class="sidebar-form">
            @if(isset($selectCategories))
                <select class="chosen-select" name="cat">
                    @foreach($selectCategories as $category)
                        <option
                        @if(Input::get('cat') == $category->id)
                            selected="selected"
                        @endif
                         value="{{$category->id}}">{{$category->title}}</option>
                    @endforeach
                </select>
            @endif
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="{{_l(URL::action('AdminHomeController@getIndex'))}}">
                    <i class="fa fa-dashboard"></i> <span>{{__(Lang::get('admin.dashboard'))}}</span>
                </a>
            </li>
            @if(Session::get('user_level') >= Config::get('cms.viewNews'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>{{__(Lang::get('admin.news'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('NewsController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allNews'))}}</a></li>
                    <li><a href="{{_l(URL::action('NewsController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.createNews'))}}</a></li>
                    <li><a href="{{_l(URL::action('NewsController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedNews'))}}</a></li>
                    <li><a href="{{_l(URL::action('NewsController@getAdminOnly'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.adminOnlyView'))}}</a></li>
                    <li><a href="{{_l(URL::action('NewsController@getUnpublished'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.unpublishedNews'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewCategories'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th-list"></i>
                    <span>{{__(Lang::get('admin.categories'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('CategoryController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allCategories'))}}</a></li>
                    <li><a href="{{_l(URL::action('CategoryController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.newCategory'))}}</a></li>
                    <li><a href="{{_l(URL::action('CategoryController@getTags'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.tags'))}}</a></li>
                    <li><a href="{{_l(URL::action('CategoryController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedCategories'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewPages'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span>{{__(Lang::get('admin.pages'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('PageController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allPages'))}}</a></li>
                    <li><a href="{{_l(URL::action('PageController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.createPage'))}}</a></li>
                    <li><a href="{{_l(URL::action('PageController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedPages'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewPages'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span>{{__(Lang::get('admin.subjects'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('SubjectController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allSubjects'))}}</a></li>
                    <li><a href="{{_l(URL::action('SubjectController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.createSubject'))}}</a></li>
                    <li><a href="{{_l(URL::action('SubjectController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedSubjects'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewUsers'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-university"></i>
                    <span>{{__(Lang::get('admin.contacts'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('ContactController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allContacts'))}}</a></li>
                    <li><a href="{{_l(URL::action('ContactController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.createContact'))}}</a></li>
                    <li><a href="{{_l(URL::action('ContactController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedContacts'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewComments'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-comments"></i>
                    <span>{{__(Lang::get('admin.comments'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    @if($commentCount > 0)
                        <small class="badge pull-right bg-red">{{$commentCount}}</small>
                    @endif
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('CommentController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allComments'))}}</a></li>
                    <li><a href="{{_l(URL::action('CommentController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedComments'))}}</a></li>
                    <li><a href="{{_l(URL::action('CommentController@getUnpublished'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.unpublishedComments'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewUsers'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>{{__(Lang::get('admin.users'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('UserController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allUsers'))}}</a></li>
                    <li><a href="{{_l(URL::action('UserController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.newUser'))}}</a></li>
                    <li><a href="{{_l(URL::action('UserController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedUsers'))}}</a></li>
                    <li><a href="{{_l(URL::action('UserController@getAdmins'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.adminUsers'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewFiles'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text"></i>
                    <span>{{__(Lang::get('admin.files'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('FileController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allFiles'))}}</a></li>
                    <li><a href="{{_l(URL::action('FileController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedFiles'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewPolls'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>{{__(Lang::get('admin.polls'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('PollController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allPolls'))}}</a></li>
                    <li><a href="{{_l(URL::action('PollController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.createPoll'))}}</a></li>
                    <li><a href="{{_l(URL::action('PollController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedPolls'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewMenus'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>{{__(Lang::get('admin.menus'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('MenuController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allMenus'))}}</a></li>
                    <li><a href="{{_l(URL::action('MenuController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.createMenu'))}}</a></li>
                    <li><a href="{{_l(URL::action('MenuController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedMenu'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.viewMemes'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-picture-o"></i>
                    <span>{{__(Lang::get('admin.memeGenerator'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('MemeController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.allMemes'))}}</a></li>
                    <li><a href="{{_l(URL::action('MemeController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.createMeme'))}}</a></li>
                    <li><a href="{{_l(URL::action('MemeController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.trashedMemes'))}}</a></li>
                    <li><a href="{{_l(URL::action('MemeController@getInstances'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.memeInstances'))}}</a></li>
                    <li><a href="{{_l(URL::action('MemeController@getTrashedInstances'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.memeTrashedInstances'))}}</a></li>
                    <li><a href="{{_l(URL::action('MemeCommentController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.memeComments'))}}</a></li>
                    <li><a href="{{_l(URL::action('MemeCommentController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('admin.memeTrashedComments'))}}</a></li>
                </ul>
            </li>
            @endif
            @if(Session::get('user_level') >= Config::get('cms.shopManager'))
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i>
                    <span>{{__(Lang::get('shop.shop'))}}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{_l(URL::action('ProductController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('shop.allProducts'))}}</a></li>
                    <li><a href="{{_l(URL::action('ProductController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('shop.createProduct'))}}</a></li>
                    <li><a href="{{_l(URL::action('ProductController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('shop.trashedProducts'))}}</a></li>
                    <li><a href="{{_l(URL::action('ProductCategoryController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('shop.productCategories'))}}</a></li>
                    <li><a href="{{_l(URL::action('ProductCategoryController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('shop.createCategory'))}}</a></li>

                    <li><a href="{{_l(URL::action('EventController@getIndex'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('shop.allEvents'))}}</a></li>
                    <li><a href="{{_l(URL::action('EventController@getCreate'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('shop.createEvent'))}}</a></li>
                    <li><a href="{{_l(URL::action('EventController@getTrashed'))}}"><i class="fa fa-angle-double-right"></i> {{__(Lang::get('shop.trashedEvents'))}}</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
@stop