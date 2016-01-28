<?php

class ContactController extends BaseController {

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
			$contacts = Contact::where('first_name', 'LIKE', '%'.Input::get('q').'%')->orWhere(
				function($query)
	            {
	                $query->where('last_name', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.allContacts'));
		View::share('contacts', $contacts);
		$this->layout->content = View::make('backend.puskice.contacts.index');
	}

	public function getTrashed()
	{
		if(Session::get('user_level') < Config::get('cms.viewContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$contacts = Contact::onlyTrashed()->where('first_name', 'LIKE', '%'.Input::get('q').'%')->orWhere(
				function($query)
	            {
	                $query->where('last_name', 'LIKE', '%'.Input::get('q').'%');
	            })->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$contacts = Contact::onlyTrashed()->orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.allContacts'));
		View::share('contacts', $contacts);
		$this->layout->content = View::make('backend.puskice.contacts.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if(Session::get('user_level') < Config::get('cms.createContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$this->setLayout();
			$subjects = News::where('post_type', '=', 3)->get();
			View::share('subjects', $subjects);
			View::share('title', Lang::get('admin.newContact'));
			$this->layout->content = View::make('backend.puskice.contacts.create');
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
		if(Session::get('user_level') < Config::get('cms.createContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'firstName'	=> 'Required',
			'lastName'	=> 'Required',
			'title'		=> 'Required',
			'email'		=> 'email'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('ContactController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$contact = new Contact;
	    		if(Input::get('createdAt')){
	    			$contact->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$contact->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$contact->first_name		= Input::get('firstName');
	    		$contact->last_name			= Input::get('lastName');
	    		$contact->published 		= Input::get('published');
	    		$contact->title 			= Input::get('title');
	    		$contact->email 			= Input::get('email');
	    		$contact->priority			= Input::get('priority');
	    		$contact->webpage			= Input::get('webpage');
	    		$contact->phone 			= Input::get('phone');
	    		$contact->description 		= Input::get('description');
	    		$contact->image 			= Input::get('featuredImage');
	    		$contact->address 			= Input::get('address');
	    		$contact->save();
	    		if(Input::get('news')){
		    		foreach(Input::get('news') as $news){
		    			$newsContact = new NewsContact;
		    			$newsContact->news_id = $news;
		    			$newsContact->contact_id = $contact->id;
		    			$newsContact->ordering = Input::get('priority');
		    			$newsContact->save();
		    		}
	    		}
	    		return Redirect::to(_l(URL::action('ContactController@getEdit')."/".$contact->id))->with('message', Lang::get('admin.contactSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.noSuchContact'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$this->setLayout();
			$subjects = News::where('post_type', '=', 3)->get();
			$contact = Contact::findOrFail($id);
			View::share('contact', $contact);
			View::share('subjects', $subjects);
			View::share('title', Lang::get('admin.editContact').": ".$contact->title." ".$contact->first_name." ".$contact->last_name);
			$this->layout->content = View::make('backend.puskice.contacts.editContact');
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
		if(Session::get('user_level') < Config::get('cms.createContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'firstName'	=> 'Required',
			'lastName'	=> 'Required',
			'title'		=> 'Required',
			'email'		=> 'email'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('ContactController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$contact = Contact::findOrFail($id);
	    		if(Input::get('createdAt')){
	    			$contact->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$contact->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$contact->first_name		= Input::get('firstName');
	    		$contact->last_name			= Input::get('lastName');
	    		$contact->published 		= Input::get('published');
	    		$contact->title 			= Input::get('title');
	    		$contact->email 			= Input::get('email');
	    		$contact->priority			= Input::get('priority');
	    		$contact->webpage			= Input::get('webpage');
	    		$contact->phone 			= Input::get('phone');
	    		$contact->description 		= Input::get('description');
	    		$contact->image 			= Input::get('featuredImage');
	    		$contact->address 			= Input::get('address');
	    		$contact->save();
	    		$contact->newsContacts()->forceDelete();
	    		if(Input::get('news')){
		    		foreach(Input::get('news') as $news){
		    			$newsContact = new NewsContact;
		    			$newsContact->news_id = $news;
		    			$newsContact->contact_id = $contact->id;
		    			$newsContact->ordering = Input::get('priority');
		    			$newsContact->save();
		    		}
	    		}
	    		return Redirect::to(_l(URL::action('ContactController@getEdit')."/".$contact->id))->with('message', Lang::get('admin.contactSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.noSuchContact'))->with('notif', 'danger');
	    	}
	    }	
	}

	public function getPublish($id)
	{
		if(Session::get('user_level') < Config::get('cms.editContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$contact = Contact::findOrFail($id);
			$contact->published = 1;
			$contact->save();
			return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.commentUpdated'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
		}
	}

	public function getUnpublish($id)
	{
		if(Session::get('user_level') < Config::get('cms.editContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$contact = Contact::findOrFail($id);
			$contact->published = 0;
			$contact->save();
			return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.commentUpdated'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
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
			$contact = Contact::findOrFail($id);
			$contact->marks()->delete();
			$contact->newsContacts()->delete();
			$contact->delete();
			return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.contactDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.noSuchContact'))->with('notif', 'danger');
		}
	}

	public function getRestore($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$contact = Contact::onlyTrashed()->findOrFail($id);
			$contact->restore();
			$contact->marks()->onlyTrashed()->restore();
			return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.contactRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('ContactController@getIndex')))->with('message', Lang::get('admin.noSuchContact'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteContacts')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$contact = Contact::onlyTrashed()->findOrFail($id);
			$contact->marks()->withTrashed()->forceDelete();
			$contact->newsContacts()->forceDelete();
			$contact->forceDelete();
			return Redirect::to(_l(URL::action('ContactController@getTrashed')))->with('message', Lang::get('admin.contactDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('ContactController@getTrashed')))->with('message', Lang::get('admin.noSuchContact'))->with('notif', 'danger');
		}
	}


}
