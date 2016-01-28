<?php

class UserController extends BaseController {

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
		if(Session::get('user_level') < Config::get('cms.viewUsers')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$users = User::where('username', 'LIKE', '%'.Input::get('q').'%')->orWhere(
				function($query)
	            {
	                $query->where('first_name', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('last_name', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$users = User::orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.allUsers'));
		View::share('users', $users);
		$this->layout->content = View::make('backend.users.index');
	}

	public function getTrashed()
	{
		if(Session::get('user_level') < Config::get('cms.viewUsers')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$users = User::onlyTrashed()->where('username', 'LIKE', '%'.Input::get('q').'%')->orWhere(
				function($query)
	            {
	                $query->where('first_name', 'LIKE', '%'.Input::get('q').'%')
	                      ->orwhere('last_name', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$users = User::onlyTrashed()->orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.trashedUsers'));
		View::share('users', $users);
		$this->layout->content = View::make('backend.users.index');
	}

	public function getAdmins()
	{
		if(Session::get('user_level') < Config::get('cms.viewUsers')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$users = User::where('user_level', '>=', Config::get('cms.accessAdminPanel'))->where(
				function($query)
	            {
	                $query->where('first_name', 'LIKE', '%'.Input::get('q').'%')
	                	  ->orWhere('username', 'LIKE', '%'.Input::get('q').'%')	
	                      ->orwhere('last_name', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$users = User::where('user_level', '>=', Config::get('cms.accessAdminPanel'))->orderBy('created_at', 'desc')->paginate(20);
		}	
		View::share('title', Lang::get('admin.adminUsers'));
		View::share('users', $users);
		$this->layout->content = View::make('backend.users.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if(Session::get('user_level') < Config::get('cms.createUser')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$this->setLayout();
			View::share('title', Lang::get('admin.newUser'));
			$this->layout->content = View::make('backend.users.create');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('UserController@getIndex')))->with('message', Lang::get('admin.noSuchUser'))->with('notif', 'danger');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if(Session::get('user_level') < Config::get('cms.createUser')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'user_name'	=> 'Required',
			'password'	=> 'Required',
			'repeatPassword'=>'same:password',
			'firstName'	=> 'Required',
			'lastName'	=> 'Required',
			'userLevel'	=> 'Required',
			'email'		=> 'Required|unique:users,email|email'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('UserController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$user = new User;
	    		if(Input::get('createdAt')){
	    			$user->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$user->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$user->first_name		= Input::get('firstName');
	    		$user->last_name		= Input::get('lastName');
	    		$user->published 		= Input::get('published');
	    		$user->username 		= Input::get('user_name');
	    		$user->password 		= sha1(Input::get('password'));
	    		$user->email 			= Input::get('email');
	    		$user->user_level		= Input::get('userLevel');
	    		$user->save();
	    		return Redirect::to(_l(URL::action('UserController@getEdit')."/".$user->id))->with('message', Lang::get('admin.userSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('UserController@getIndex')))->with('message', Lang::get('admin.noSuchUser'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editUser')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$user = User::findOrFail($id);
			$this->setLayout();
			View::share('title', Lang::get('admin.editUser'));
			View::share('user', $user);
			$this->layout->content = View::make('backend.users.editUser');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('UserController@getIndex')))->with('message', Lang::get('admin.noSuchUser'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editUser')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'user_name'	=> 'Required|unique:users,username,'.$id,
			'firstName'	=> 'Required',
			'lastName'	=> 'Required',
			'userLevel'	=> 'Required',
			'email'		=> 'Required|unique:users,email,'.$id.'|email'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('UserController@getEdit', $id)))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$user = User::findOrFail($id);
	    		if(Input::get('createdAt')){
	    			$user->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$user->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$user->first_name		= Input::get('firstName');
	    		$user->last_name		= Input::get('lastName');
	    		$user->published 		= Input::get('published');
	    		$user->username 		= Input::get('user_name');
	    		$user->email 			= Input::get('email');
	    		$user->user_level		= Input::get('userLevel');
	    		$passChanged = false;
	    		if(Input::get('password') && Input::get('repeatPassword') == Input::get('password')){
	    			$user->password = sha1(Input::get('password'));
	    			$passChanged = true;
	    		}
	    		elseif(Input::get('password') && Input::get('password') != Input::get('repeatPassword')){
	    			return Redirect::to(_l(URL::action('UserController@getEdit')."/".$user->id))->with('message', Lang::get('admin.passdontMatch'))->with('notif', 'warning');		
	    		}
	    		$user->save();
	    		if($passChanged){
	    			return Redirect::to(_l(URL::action('UserController@getEdit')."/".$user->id))->with('message', Lang::get('admin.userSaved')." <br/>".Lang::get('admin.passChanged'))->with('notif', 'success');	
	    		}
	    		return Redirect::to(_l(URL::action('UserController@getEdit')."/".$user->id))->with('message', Lang::get('admin.userSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		var_dump($passChanged);
	    		//var_dump($е->getMessage()); return; 
	    		return Redirect::to(_l(URL::action('UserController@getIndex')))->with('message', Lang::get('admin.noSuchUser'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.deleteUser')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$user = User::findOrFail($id);
			$user->delete();
			return Redirect::to(_l(URL::action('UserController@getIndex')))->with('message', Lang::get('admin.userDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('UserController@getIndex')))->with('message', Lang::get('admin.noSuchUser'))->with('notif', 'danger');
		}
	}

	public function getRestore($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteUser')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$user = User::onlyTrashed()->findOrFail($id);
			$user->restore();
			return Redirect::to(_l(URL::action('UserController@getIndex')))->with('message', Lang::get('admin.userRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('UserController@getIndex')))->with('message', Lang::get('admin.noSuchUser'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteUser')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$user = User::onlyTrashed()->findOrFail($id);
			if(sizeof($user->news) > 0){
				foreach($user->news as $news){
					$news->published_by = Session::get('id');
					$news->last_modified_by = Session::get('id');
					$news->save();
				}
			}
			$user->forceDelete();
			return Redirect::to(_l(URL::action('UserController@getTrashed')))->with('message', Lang::get('admin.userDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('UserController@getTrashed')))->with('message', Lang::get('admin.noSuchUser'))->with('notif', 'danger');
		}
	}


}
