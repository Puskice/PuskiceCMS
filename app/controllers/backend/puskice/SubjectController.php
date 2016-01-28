<?php

class SubjectController extends BaseController {

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
	 * GET /backend\puskice\subject
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
			$news = News::where('post_type', '=', 3)->where(
				function($query)
	            {
	                $query->where('title', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('long_content', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else $news = News::where('post_type', '=', 3)->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.subjects')));
		View::share('news', $news);
		$this->layout->content = View::make('backend.puskice.subjects.index');
	}

	public function getTrashed()
	{
		if(Session::get('user_level') < Config::get('cms.viewPages')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$news = News::onlyTrashed()->where('post_type', '=', 3)->where(
				function($query)
	            {
	                $query->where('title', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('long_content', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else $news = News::onlyTrashed()->where('post_type', '=', 3)->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.subjects')));
		View::share('news', $news);
		$this->layout->content = View::make('backend.puskice.subjects.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /backend\puskice\subject/create
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
			View::share('title', Lang::get('admin.createSubject'));
			View::share('categories', $categories);
			View::share('users', $users);
			$this->layout->content = View::make('backend.puskice.subjects.create');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /backend\puskice\subject
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
	        return Redirect::to(_l(URL::action('SubjectController@getCreate')))->withErrors($validator)->withInput();
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
	    		$news->post_type		= 3;
	    		$news->published 		= Input::get('published');
	    		$news->save();
	    		$subject1 = new Subject;
	    		$subject1->news_id = $news->id;
	    		$subject1->semester = Input::get('semester1');
	    		$subject1->espb = Input::get('espb1');
	    		$subject1->department = Input::get('department1');
	    		$subject1->save();
	    		if(Input::get('semester2') != 0){
	    			$subject2 = new Subject;
		    		$subject2->news_id = $news->id;
		    		$subject2->semester = Input::get('semester2');
		    		$subject2->espb = Input::get('espb2');
		    		$subject2->department = Input::get('department2');
		    		$subject2->save();
	    		}
	    		if(Input::get('semester3') != 0){
	    			$subject2 = new Subject;
		    		$subject2->news_id = $news->id;
		    		$subject2->semester = Input::get('semester3');
		    		$subject2->espb = Input::get('espb3');
		    		$subject2->department = Input::get('department3');
		    		$subject2->save();
	    		}

	    		return Redirect::to(_l(URL::action('SubjectController@getEdit')."/".$news->id))->with('message', Lang::get('admin.subjectCreated'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
	    	}
	    }
	}

	/**
	 * Display the specified resource.
	 * GET /backend\puskice\subject/{id}
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
	 * GET /backend\puskice\subject/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		if(Session::get('user_level') < Config::get('cms.createPage')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['subfolder'] = 'images/';
			$categories = Category::all();
			$article = News::where('post_type', '=', 3)->where('id', '=', $id)->firstOrFail();
			$users = User::where('user_level', '>=', Config::get('cms.createPage'))->where('published', '=', 1)->orderBy('username')->get();
			$this->setLayout();
			View::share('title', Lang::get('admin.editSubject').": ".$article->title);
			View::share('categories', $categories);
			View::share('users', $users);
			View::share('article', $article);
			$this->layout->content = View::make('backend.puskice.subjects.editSubject');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /backend\puskice\subject/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		if(Session::get('user_level') < Config::get('cms.createPage')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title' 		=> 'Required', 
			'shortContent'	=> 'Required',
			'createdAt'		=> 'Required',
			'publishedBy'	=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('SubjectController@getEdit')."/".$id))->withErrors($validator)->withInput();
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
	    		$news->featured			= 0;
	    		$news->last_modified_by = Session::get('id');
	    		$news->published_by		= Input::get('publishedBy');
	    		$news->featured_image	= Input::get('featuredImage');
	    		$news->image_caption	= Input::get('imageCaption');
	    		$news->post_type		= 3;
	    		$news->published 		= Input::get('published');
	    		$news->save();
	    		$news->subjects()->forceDelete();
	    		$subject1 = new Subject;
	    		$subject1->news_id = $news->id;
	    		$subject1->semester = Input::get('semester1');
	    		$subject1->espb = Input::get('espb1');
	    		$subject1->department = Input::get('department1');
	    		$subject1->save();
	    		if(Input::get('semester2') != 0){
	    			$subject2 = new Subject;
		    		$subject2->news_id = $news->id;
		    		$subject2->semester = Input::get('semester2');
		    		$subject2->espb = Input::get('espb2');
		    		$subject2->department = Input::get('department2');
		    		$subject2->save();
	    		}
	    		if(Input::get('semester3') != 0){
	    			$subject2 = new Subject;
		    		$subject2->news_id = $news->id;
		    		$subject2->semester = Input::get('semester3');
		    		$subject2->espb = Input::get('espb3');
		    		$subject2->department = Input::get('department3');
		    		$subject2->save();
	    		}

	    		return Redirect::to(_l(URL::action('SubjectController@getEdit')."/".$news->id))->with('message', Lang::get('admin.subjectUpdated'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
	    	}
	    }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /backend\puskice\subject/{id}
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
			return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.subjectDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.noSuchSubject'))->with('notif', 'danger');
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
			return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.subjectRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.noSuchSubject'))->with('notif', 'danger');
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
			return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.subjectDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('SubjectController@getIndex')))->with('message', Lang::get('admin.noSuchSubject'))->with('notif', 'danger');
		}
	}

}