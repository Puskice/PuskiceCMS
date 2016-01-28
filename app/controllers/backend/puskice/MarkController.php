<?php

class MarkController extends BaseController {

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
		if(Session::get('user_level') < Config::get('cms.viewContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$marks = Mark::whereHas('user', function($q)
				{
				    $q->where('first_name', 'like', '%'.Input::get('q').'%')
				    	->orWhere('last_name', 'like', '%'.Input::get('q').'%');

				})->orWhere('note', 'like', '%'.Input::get('q').'%')->paginate(20);
		}
		else $marks = Mark::orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.marks')));
		View::share('marks', $marks);
		$this->layout->content = View::make('backend.puskice.marks.index');
	}

	public function getTrashed(){
		if(Session::get('user_level') < Config::get('cms.viewContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$marks = Mark::onlyTrashed()->whereHas('contact', function($q)
				{
				    $q->where('first_name', 'like', '%'.Input::get('q').'%')
				    	->orWhere('last_name', 'like', '%'.Input::get('q').'%');

				})->orWhere('note', 'like', '%'.Input::get('q').'%')->paginate(20);
		}
		else $marks = Mark::onlyTrashed()->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.marks')));
		View::share('marks', $marks);
		$this->layout->content = View::make('backend.puskice.marks.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		//
	}


	public function getPublish($id)
	{
		if(Session::get('user_level') < Config::get('cms.editContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$mark = Mark::findOrFail($id);
			$mark->published = 1;
			$mark->save();
			return Redirect::to(_l(URL::action('MarkController@getIndex')))->with('message', Lang::get('admin.markUpdated'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MarkController@getIndex')))->with('message', Lang::get('admin.noSuchMark'))->with('notif', 'danger');
		}
	}

	public function getUnpublish($id)
	{
		if(Session::get('user_level') < Config::get('cms.editContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$mark = Mark::findOrFail($id);
			$mark->published = 0;
			$mark->save();
			return Redirect::to(_l(URL::action('MarkController@getIndex')))->with('message', Lang::get('admin.markUpdated'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MarkController@getIndex')))->with('message', Lang::get('admin.noSuchMark'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.deleteContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$mark = Mark::findOrFail($id);
			$mark->delete();
			return Redirect::to(_l(URL::action('MarkController@getIndex')))->with('message', Lang::get('admin.markDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MarkController@getIndex')))->with('message', Lang::get('admin.noSuchMark'))->with('notif', 'danger');
		}
	}

	public function getRestore($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$mark = Mark::onlyTrashed()->findOrFail($id);
			$mark->restore();
			return Redirect::to(_l(URL::action('MarkController@getIndex')))->with('message', Lang::get('admin.markRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MarkController@getIndex')))->with('message', Lang::get('admin.noSuchMark'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$mark = Mark::onlyTrashed()->findOrFail($id);
			$mark->forceDelete();
			return Redirect::to(_l(URL::action('MarkController@getTrashed')))->with('message', Lang::get('admin.markDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MarkController@getTrashed')))->with('message', Lang::get('admin.noSuchMark'))->with('notif', 'danger');
		}
	}


}
