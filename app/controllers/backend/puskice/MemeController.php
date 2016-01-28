<?php

class MemeController extends BaseController {

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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		if(Session::get('user_level') < Config::get('cms.viewMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$memes = Meme::where('name', 'LIKE', '%'.Input::get('q').'%')->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$memes = Meme::orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.memeGenerator'));
		View::share('memes', $memes);
		$this->layout->content = View::make('backend.puskice.memes.index');
	}


	public function getTrashed()
	{
		if(Session::get('user_level') < Config::get('cms.viewMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$memes = Meme::onlyTrashed()->where('name', 'LIKE', '%'.Input::get('q').'%')->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$memes = Meme::onlyTrashed()->orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.trashedMemes'));
		View::share('memes', $memes);
		$this->layout->content = View::make('backend.puskice.memes.index');
	}

	public function getInstances()
	{
		if(Session::get('user_level') < Config::get('cms.viewMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$memes = MemeInstance::where('first_line', 'LIKE', '%'.Input::get('q').'%')->orWhere('second_line', 'LIKE', '%'.Input::get('q').'%')->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$memes = MemeInstance::orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.memeGenerator'));
		View::share('memeInstances', $memes);
		$this->layout->content = View::make('backend.puskice.memes.instances');
	}

	public function getTrashedInstances()
	{
		if(Session::get('user_level') < Config::get('cms.viewMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$memes = MemeInstance::onlyTrashed()->where('first_line', 'LIKE', '%'.Input::get('q').'%')->orWhere('second_line', 'LIKE', '%'.Input::get('q').'%')->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$memes = MemeInstance::onlyTrashed()->orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.memeGenerator'));
		View::share('memeInstances', $memes);
		$this->layout->content = View::make('backend.puskice.memes.instances');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if(Session::get('user_level') < Config::get('cms.createMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		$_SESSION['RF']['subfolder'] = 'memes/';
		View::share('title', Lang::get('admin.memeGenerator'));
		$this->layout->content = View::make('backend.puskice.memes.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if(Session::get('user_level') < Config::get('cms.createMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'url'			=> 'Required',
			'title'			=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('MemeController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$meme 	= new Meme;
	    		if(Input::get('createdAt')){
	    			$meme->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$meme->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$meme->img 				= Input::get('url');
	    		$meme->name 			= Input::get('title');
	    		$meme->save();
	    		return Redirect::to(_l(URL::action('MemeController@getEdit')."/".$meme->id))->with('message', Lang::get('admin.memeSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('MemeController@getIndex')))->with('message', Lang::get('admin.noSuchMeme'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$this->setLayout();
			$_SESSION['RF']['subfolder'] = 'memes/';
			$meme = Meme::findOrFail($id);
			View::share('meme', $meme);
			View::share('title', Lang::get('admin.memeGenerator'));
			$this->layout->content = View::make('backend.puskice.memes.editMemes');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeController@getIndex')))->with('message', Lang::get('admin.noSuchMeme'))->with('notif', 'danger');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getInstanceEdit($id)
	{
		if(Session::get('user_level') < Config::get('cms.editMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$this->setLayout();
			$_SESSION['RF']['subfolder'] = 'memes/';
			$meme = MemeInstance::findOrFail($id);
			$memes = Meme::all();
			View::share('meme', $meme);
			View::share('memes', $memes);
			View::share('title', Lang::get('admin.memeGenerator'));
			$this->layout->content = View::make('backend.puskice.memes.editMemeInstances');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeController@getInstances')))->with('message', Lang::get('admin.noSuchMeme'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'url'			=> 'Required',
			'title'			=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('MemeController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$meme 	= Meme::findOrFail($id);
	    		if(Input::get('createdAt')){
	    			$meme->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$meme->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$meme->img 				= Input::get('url');
	    		$meme->name 			= Input::get('title');
	    		$meme->save();
	    		return Redirect::to(_l(URL::action('MemeController@getEdit')."/".$meme->id))->with('message', Lang::get('admin.memeUpdated'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('MemeController@getIndex')))->with('message', Lang::get('admin.noSuchMeme'))->with('notif', 'danger');
	    	}
	    }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postInstanceUpdate($id)
	{
		if(Session::get('user_level') < Config::get('cms.editMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'meme'			=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('MemeController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$meme 	= MemeInstance::findOrFail($id);
	    		if(Input::get('createdAt')){
	    			$meme->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$meme->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$meme->meme_id 			= Input::get('meme');
	    		$meme->first_line 		= Input::get('first_line');
	    		$meme->second_line 		= Input::get('second_line');
	    		$meme->save();
	    		return Redirect::to(_l(URL::action('MemeController@getInstanceEdit')."/".$meme->id))->with('message', Lang::get('admin.memeUpdated'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('MemeController@getInstances')))->with('message', Lang::get('admin.noSuchMeme'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.deleteMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$meme = Meme::findOrFail($id);
			$meme->instances()->delete();
			$meme->delete();
			return Redirect::to(_l(URL::action('MemeController@getIndex')))->with('message', Lang::get('admin.memeDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeController@getIndex')))->with('message', Lang::get('admin.noSuchMeme'))->with('notif', 'danger');
		}
	}

	public function getRestore($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$meme = Meme::onlyTrashed()->findOrFail($id);
			$meme->restore();
			$meme->instances()->onlyTrashed()->restore();
			return Redirect::to(_l(URL::action('MemeController@getIndex')))->with('message', Lang::get('admin.memeRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeController@getIndex')))->with('message', Lang::get('admin.noSuchMeme'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$meme = Meme::onlyTrashed()->findOrFail($id);
			$meme->instances()->withTrashed()->forceDelete();
			$meme->forceDelete();
			return Redirect::to(_l(URL::action('MemeController@getTrashed')))->with('message', Lang::get('admin.memeDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeController@getTrashed')))->with('message', Lang::get('admin.noSuchMeme'))->with('notif', 'danger');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getInstanceDelete($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$meme = MemeInstance::findOrFail($id);
			$meme->delete();
			return Redirect::to(_l(URL::action('MemeController@getInstances')))->with('message', Lang::get('admin.memeInstanceDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeController@getInstances')))->with('message', Lang::get('admin.noSuchMemeInstance'))->with('notif', 'danger');
		}
	}

	public function getInstanceRestore($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$meme = MemeInstance::onlyTrashed()->findOrFail($id);
			$meme->restore();
			return Redirect::to(_l(URL::action('MemeController@getInstances')))->with('message', Lang::get('admin.memeInstanceRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeController@getInstances')))->with('message', Lang::get('admin.noSuchMemeInstance'))->with('notif', 'danger');
		}
	}

	public function getInstanceDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$meme = MemeInstance::onlyTrashed()->findOrFail($id);
			$meme->forceDelete();
			return Redirect::to(_l(URL::action('MemeController@getTrashedInstances')))->with('message', Lang::get('admin.memeInstanceDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeController@getTrashedInstances')))->with('message', Lang::get('admin.noSuchMemeInstance'))->with('notif', 'danger');
		}
	}

}
