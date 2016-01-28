<?php

class NewsController extends BaseController {

	public function __construct(){
		parent::__construct();
		$commentCount = Comment::where('published', '=', 0)->where('created_at', '>', date('Y-m-d H:i:s', strtotime('-30 days')))->count();
		$unpublishedComments = Comment::where('published', '=', 0)->where('created_at', '>', date('Y-m-d H:i:s', strtotime('-30 days')))->orderBy('created_at', 'desc')->take(10)->get();
		try {
			$admin = User::findOrFail(Session::get('id'));
			View::share('admin', $admin);
		} catch (Exception $e) {
			return Redirect::to('login')->with('message', Lang::get('login.error'))->with('notif', 'danger');
		}
		View::share('commentCount', $commentCount);
		View::share('unpublishedComments', $unpublishedComments);
		unset($_SESSION['RF']['subfolder']);
	}


	public function setLayout(){
		$this->layout 					= View::make('backend.master');
		$this->layout->head 			= View::make('backend.head');
		$this->layout->header 			= View::make('backend.header');
		$this->layout->sidebar 			= View::make('backend.sidebar');
		$this->layout->footer 			= View::make('backend.footer');
		$this->layout->errorReporting 	= View::make('backend.errorReporting');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		if(Session::get('user_level') < Config::get('cms.viewNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')));
		}
		$selectCategories = Category::all();
		View::share('selectCategories', $selectCategories);
		$this->setLayout();
		if(Input::get('cat')){
			$news = News::inCategories(array(Input::get('cat')))->where('post_type', '=', 1);
		}
		else{
			$news = News::where('post_type', '=', 1);
		}
		if(Input::get('q')){
			$news = $news->where(
				function($query)
	            {
	                $query->where('title', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('long_content', 'LIKE', '%'.Input::get('q').'%');
	            });
		}
		$news = $news->distinct('permalink')->groupBy('id')->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.news')));
		View::share('news', $news);
		$this->layout->content = View::make('backend.news.index');
	}

	public function getTrashed(){
		if(Session::get('user_level') < Config::get('cms.viewNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')));
		}
		$selectCategories = Category::where('tag', '=', 0)->get();
		View::share('selectCategories', $selectCategories);
		$this->setLayout();
		if(Input::get('cat')){
			$news = News::inCategories(array(Input::get('cat')))->where('post_type', '=', 1);
		}
		else{
			$news = News::where('post_type', '=', 1);
		}
		if(Input::get('q')){
			$news = $news->onlyTrashed()->where('post_type', '=', 1)->where(
				function($query)
	            {
	                $query->where('title', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('long_content', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		$news = $news->onlyTrashed()->where('post_type', '=', 1)->distinct('permalink')->groupBy('id')->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.news')));
		View::share('news', $news);
		$this->layout->content = View::make('backend.news.index');
	}

	public function getUnpublished(){
		if(Session::get('user_level') < Config::get('cms.viewNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')));
		}
		$selectCategories = Category::where('tag', '=', 0)->get();
		View::share('selectCategories', $selectCategories);
		$this->setLayout();
		if(Input::get('cat')){
			$news = News::inCategories(array(Input::get('cat')))->where('post_type', '=', 1);
		}
		else{
			$news = News::where('post_type', '=', 1);
		}
		if(Input::get('q')){
			$news = $news->where('published', '=', '0')->where('post_type', '=', 1)->where(
				function($query)
	            {
	                $query->where('title', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('long_content', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else $news = News::where('published', '=', '0')->where('post_type', '=', 1)->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.news')));
		View::share('news', $news);
		$this->layout->content = View::make('backend.news.index');
	}

	public function getAdminOnly(){
		if(Session::get('user_level') < Config::get('cms.viewNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')));
		}
		$selectCategories = Category::where('tag', '=', 0)->get();
		View::share('selectCategories', $selectCategories);
		$this->setLayout();
		if(Input::get('cat')){
			$news = News::inCategories(array(Input::get('cat')))->where('post_type', '=', 1);
		}
		else{
			$news = News::where('post_type', '=', 1);
		}
		if(Input::get('q')){
			$news = $news->where('published', '=', '1')->where('post_type', '=', 1)->where(
				function($query)
	            {
	                $query->where('title', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('long_content', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		$news = $news->where('published', '=', '1')->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.news')));
		View::share('news', $news);
		$this->layout->content = View::make('backend.news.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if(Session::get('user_level') < Config::get('cms.createNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')));
		}
		try {
			$_SESSION['RF']['subfolder'] = 'images/';
			$categories = Category::where('tag', '=', 0)->get();
			$users = User::where('user_level', '>=', Config::get('cms.createNews'))->where('published', '=', 1)->orderBy('username')->get();
			$this->setLayout();
			View::share('title', Lang::get('admin.createNews'));
			View::share('categories', $categories);
			View::share('users', $users);
			$this->layout->content = View::make('backend.news.create');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('NewsController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if(Session::get('user_level') < Config::get('cms.createNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')));
		}
		$rules = array(
			'title' 		=> 'Required', 
			'shortContent'	=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('NewsController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$news = new News;
	    		$news->title 			= Input::get('title');
	    		if(!Input::get('permalink')){
	    			$news->permalink	= slugify(Input::get('title'));
	    		}
	    		else $news->permalink	= slugify(Input::get('permalink'));
	    		if(Input::get('createdAt')){
	    			$news->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else $news->created_at 	= date("Y-m-d H:i:s", strtotime('now'));
	    		$news->short_content	= Input::get('shortContent', null, false);
	    		if(!Input::get('longContent'))
	    			$news->long_content = Input::get('shortContent', null, false);
	    		else $news->long_content= Input::get('longContent', null, false);
	    		$news->featured			= Input::get('featured');
	    		$news->last_modified_by = Session::get('id');
	    		$news->published_by		= Input::get('publishedBy');
	    		$news->featured_image	= Input::get('featuredImage');
	    		$news->image_caption	= Input::get('imageCaption');
	    		$news->post_type		= 1;
	    		$news->published 		= Input::get('published');
	    		$news->save();
	    		$news->newsCategories()->delete();
	    		if(Input::get('categories')){
		    		foreach(Input::get('categories') as $catid){
		    			$newsCategory = new NewsCategory;
		    			$newsCategory->news_id = $news->id;
		    			$newsCategory->category_id = $catid;
		    			$newsCategory->save();
		    		}
	    		}
	    		return Redirect::to(_l(URL::action('NewsController@getEdit')."/".$news->id))->with('message', Lang::get('admin.newsCreated'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('NewsController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
	    	}
	    }	
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		if(Session::get('user_level') < Config::get('cms.editNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['subfolder'] = 'images/';
			$article = News::findOrFail($id);
			if($article->post_type != 1) return Redirect::to(_l(URL::action('AdminHomeController@getIndex')));
			$categories = Category::where('tag', '=', 0)->get();
			$users = User::where('user_level', '>=', Config::get('cms.editNews'))->where('published', '=', 1)->orderBy('username')->get();
			View::share('title', Lang::get('admin.editNews').": ".$article->title);
			View::share('article', $article);
			View::share('categories', $categories);
			View::share('users', $users);
			$this->setLayout();
			$this->layout->content = View::make('backend.news.editNews');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.noSuchNews'))->with('notif', 'danger');
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		if(Session::get('user_level') < Config::get('cms.editNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title' 		=> 'Required', 
			'shortContent'	=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('NewsController@getEdit')."/".$id))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$news = News::findOrFail($id);
	    		$news->title 			= Input::get('title');
	    		if(!Input::get('permalink')){
	    			$news->permalink	= slugify(Input::get('title'));
	    		}
	    		else $news->permalink	= slugify(Input::get('permalink'));
	    		if(Input::get('createdAt')){
	    			$news->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else $news->created_at 	= date("Y-m-d H:i:s", strtotime('now'));
	    		$news->short_content	= Input::get('shortContent', null, false);
	    		if(!Input::get('longContent'))
	    			$news->long_content = Input::get('shortContent', null, false);
	    		else $news->long_content= Input::get('longContent', null, false);
	    		$news->featured			= Input::get('featured');
	    		$news->last_modified_by = Session::get('id');
	    		$news->published_by		= Input::get('publishedBy');
	    		$news->featured_image	= Input::get('featuredImage');
	    		$news->image_caption	= Input::get('imageCaption');
	    		$news->post_type		= 1;
	    		$news->published 		= Input::get('published');
	    		$news->save();
	    		$news->newsCategories()->delete();
	    		if(Input::get('categories')){
		    		foreach(Input::get('categories') as $catid){
		    			$newsCategory = new NewsCategory;
		    			$newsCategory->news_id = $news->id;
		    			$newsCategory->category_id = $catid;
		    			$newsCategory->save();
		    		}
	    		}
	    		return Redirect::to(_l(URL::action('NewsController@getEdit')."/".$id))->with('message', Lang::get('admin.newsUpdated'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('NewsController@getIndex')))->with('message', Lang::get('admin.noSuchNews'))->with('notif', 'danger');
	    	}
	    }	
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$news = News::findOrFail($id);
			$news->comments()->delete();
			$news->subjects()->delete();
			$news->files()->delete();
			$news->delete();
			return Redirect::to(_l(URL::action('NewsController@getIndex')))->with('message', Lang::get('admin.newsDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('NewsController@getIndex')))->with('message', Lang::get('admin.noSuchNews'))->with('notif', 'danger');
		}
	}

	public function getRestore($id){
		if(Session::get('user_level') < Config::get('cms.deleteNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$news = News::onlyTrashed()->findOrFail($id);
			$news->comments()->withTrashed()->restore();
			$news->subjects()->withTrashed()->restore();
			$news->files()->withTrashed()->restore();
			$news->restore();
			return Redirect::to(_l(URL::action('NewsController@getIndex')))->with('message', Lang::get('admin.newsRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('NewsController@getIndex')))->with('message', Lang::get('admin.noSuchNews'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id){
		if(Session::get('user_level') < Config::get('cms.deleteNews')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$news = News::onlyTrashed()->findOrFail($id);
			$news->comments()->withTrashed()->forceDelete();
			$news->subjects()->withTrashed()->forceDelete();
			$news->files()->withTrashed()->forceDelete();
			$news->newsContacts()->delete();
			$news->newsCategories()->delete();
			$news->forceDelete();
			return Redirect::to(_l(URL::action('NewsController@getIndex')))->with('message', Lang::get('admin.newsDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('NewsController@getIndex')))->with('message', Lang::get('admin.noSuchNews'))->with('notif', 'danger');
		}
	}


}
