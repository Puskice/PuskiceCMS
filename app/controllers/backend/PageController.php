<?php

class PageController extends BaseController {

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
		$this->layout = View::make('backend.master');
		$this->layout->head = View::make('backend.head');
		$this->layout->header = View::make('backend.header');
		$this->layout->sidebar = View::make('backend.sidebar');
		$this->layout->footer = View::make('backend.footer');
		$this->layout->errorReporting 	= View::make('backend.errorReporting');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		if(Session::get('user_level') < Config::get('cms.viewPages')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$news = News::where('post_type', '=', 2)->where(
				function($query)
	            {
	                $query->where('title', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('long_content', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else $news = News::where('post_type', '=', 2)->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.pages')));
		View::share('news', $news);
		$this->layout->content = View::make('backend.pages.index');
	}

	public function getTrashed(){
		if(Session::get('user_level') < Config::get('cms.viewPages')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')));
		}
		$this->setLayout();
		if(Input::get('q')){
			$news = News::onlyTrashed()->where('post_type', '=', 2)->where(
				function($query)
	            {
	                $query->where('title', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('long_content', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else $news = News::onlyTrashed()->where('post_type', '=', 2)->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.pages')));
		View::share('news', $news);
		$this->layout->content = View::make('backend.pages.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if(Session::get('user_level') < Config::get('cms.createPage')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['subfolder'] = 'images/';
			$categories = Category::all();
			$users = User::where('user_level', '>=', Config::get('cms.createPage'))->where('published', '=', 1)->orderBy('username')->get();
			$this->setLayout();
			View::share('title', Lang::get('admin.createPage'));
			View::share('categories', $categories);
			View::share('users', $users);
			$this->layout->content = View::make('backend.pages.create');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if(Session::get('user_level') < Config::get('cms.createPage')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title' 		=> 'Required', 
			'shortContent'	=> 'Required',
			'publishedBy'	=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('PageController@getCreate')))->withErrors($validator)->withInput();
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
	    		$news->short_content	= Input::get('shortContent');
	    		if(!Input::get('longContent'))
	    			$news->long_content = Input::get('shortContent');
	    		else $news->long_content= Input::get('longContent');
	    		$news->featured			= 0;
	    		$news->last_modified_by = Session::get('id');
	    		$news->published_by		= Input::get('publishedBy');
	    		$news->featured_image	= Input::get('featuredImage');
	    		$news->image_caption	= Input::get('imageCaption');
	    		$news->post_type		= 2;
	    		$news->published 		= Input::get('published');
	    		$news->save();
	    		return Redirect::to(_l(URL::action('PageController@getEdit')."/".$news->id))->with('message', Lang::get('admin.newsCreated'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editPage')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['subfolder'] = 'images/';
			$article = News::findOrFail($id);
			if($article->post_type != 2) return Redirect::to(_l(URL::action('AdminHomeController@getIndex')));
			$categories = Category::all();
			$users = User::where('user_level', '>=', Config::get('cms.editPage'))->where('published', '=', 1)->orderBy('username')->get();
			$this->setLayout();
			View::share('title', Lang::get('admin.editPage').": ".$article->title);
			View::share('article', $article);
			View::share('categories', $categories);
			View::share('users', $users);
			$this->layout->content = View::make('backend.pages.editPage');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.noSuchPage'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editPage')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title' 		=> 'Required', 
			'shortContent'	=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('PageController@getEdit')."/".$id))->withErrors($validator)->withInput();
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
	    		$news->short_content	= Input::get('shortContent');
	    		if(!Input::get('longContent'))
	    			$news->long_content = Input::get('shortContent');
	    		else $news->long_content= Input::get('longContent');
	    		$news->featured			= Input::get('featured');
	    		$news->last_modified_by = Session::get('id');
	    		$news->published_by		= Input::get('publishedBy');
	    		$news->featured_image	= Input::get('featuredImage');
	    		$news->image_caption	= Input::get('imageCaption');
	    		$news->post_type		= 2;
	    		$news->published 		= Input::get('published');
	    		$news->save();
	    		return Redirect::to(_l(URL::action('PageController@getEdit')."/".$id))->with('message', Lang::get('admin.pageUpdated'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.noSuchPage'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.deletePage')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$news = News::findOrFail($id);
			$news->comments()->delete();
			$news->subjects()->delete();
			$news->files()->delete();
			$news->delete();
			return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.pageDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.noSuchPage'))->with('notif', 'danger');
		}
	}


	public function getRestore($id){
		if(Session::get('user_level') < Config::get('cms.deletePage')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$news = News::onlyTrashed()->findOrFail($id);
			$news->comments()->withTrashed()->restore();
			$news->subjects()->withTrashed()->restore();
			$news->files()->withTrashed()->restore();
			$news->restore();
			return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.pageRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.noSuchPage'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deletePage')){
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
			return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.pageDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PageController@getIndex')))->with('message', Lang::get('admin.noSuchPage'))->with('notif', 'danger');
		}
	}


}
