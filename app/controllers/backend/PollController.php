<?php 

class PollController extends BaseController {

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
		if(Session::get('user_level') < Config::get('cms.viewPolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$polls = Poll::where('title', 'LIKE', '%'.Input::get('q').'%')->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$polls = Poll::orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.polls'));
		View::share('polls', $polls);
		$this->layout->content = View::make('backend.polls.index');
	}

	public function getTrashed()
	{
		if(Session::get('user_level') < Config::get('cms.viewPolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$polls = Poll::onlyTrashed()->where('title', 'LIKE', '%'.Input::get('q').'%')->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$polls = Poll::onlyTrashed()->orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.trashedPolls'));
		View::share('polls', $polls);
		$this->layout->content = View::make('backend.polls.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if(Session::get('user_level') < Config::get('cms.editPolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['subfolder'] = 'images/';
			$this->setLayout();
			View::share('title', Lang::get('admin.newPoll'));
			$this->layout->content = View::make('backend.polls.create');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if(Session::get('user_level') < Config::get('cms.editPolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'question'		=> 'Required',
			'options'		=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('PollController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$poll = new Poll;
	    		if(Input::get('createdAt')){
	    			$poll->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$poll->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$poll->title				= Input::get('question');
	    		if(Input::get('endDate')){
	    			$poll->end_date	= date("Y-m-d H:i:s", strtotime(Input::get('endDate')));
	    		}
	    		else{
	    			$poll->end_date	= date("Y-m-d H:i:s", strtotime('1.1.1970'));	
	    		}
	    		$poll->published		= Input::get('published');;
	    		$poll->save();
	    		$votes = Input::get('voteCount');
	    		foreach(Input::get('options') as $key => $option){
	    			$pollOption = new PollOption;
	    			$pollOption->poll_id 	= $poll->id;
	    			$pollOption->title 		= $option;
	    			if(isset($votes[$key]) && $votes[$key] != 0){
	    				$pollOption->vote_count = $votes[$key];
	    			}
	    			else $pollOption->vote_count = 0;
	    			$pollOption->save();
	    		}
	    		return Redirect::to(_l(URL::action('PollController@getEdit')."/".$poll->id))->with('message', Lang::get('admin.pollSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.noSuchPoll'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editPolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['subfolder'] = 'images/';
			$this->setLayout();
			View::share('title', Lang::get('admin.editPoll'));
			$poll = Poll::findOrFail($id);
			View::share('poll', $poll);
			$this->layout->content = View::make('backend.polls.editPoll');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editPolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'question'		=> 'Required',
			'options'		=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('PollController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$poll = Poll::findOrFail($id);
	    		if(Input::get('createdAt')){
	    			$poll->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$poll->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$poll->title				= Input::get('question');
	    		if(Input::get('endDate')){
	    			$poll->end_date	= date("Y-m-d H:i:s", strtotime(Input::get('endDate')));
	    		}
	    		else{
	    			$poll->end_date	= date("Y-m-d H:i:s", strtotime('1.1.1970'));	
	    		}
	    		$poll->published		= Input::get('published');
	    		$poll->save();
	    		$votes = Input::get('voteCount');
	    		$options = $poll->pollOptions;

	    		$poll->pollOptions()->delete();
	    		foreach(Input::get('options') as $key => $option){
	    			$done = false;
	    			foreach($options as $key2 => $option2){
	    				if($key == $option2->id){
	    					$poption = new PollOption;
	    					$poption->title = $option;
	    					$poption->poll_id = $poll->id;
	    					$poption->id = $option2->id;
	    					if(isset($votes[$key]) && $votes[$key] != 0){
			    				$poption->vote_count = $votes[$key];
			    			}
			    			$poption->save();
			    			$done = true;
			    			continue;
	    				}
	    			}
	    			if(!$done){
	    				$pollOption = new PollOption;
		    			$pollOption->poll_id 	= $poll->id;
		    			$pollOption->title 		= $option;
		    			if(isset($votes[$key]) && $votes[$key] != 0){
		    				$pollOption->vote_count = $votes[$key];
		    			}
		    			else $pollOption->vote_count = 0;
		    			$pollOption->save();
	    			}
	    			
	    		}
	    		//return;
	    		return Redirect::to(_l(URL::action('PollController@getEdit')."/".$poll->id))->with('message', Lang::get('admin.pollSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.noSuchPoll'))->with('notif', 'danger');
	    	}
	    }	
	}


	public function getPublish($id)
	{
		if(Session::get('user_level') < Config::get('cms.editPolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$poll = Poll::findOrFail($id);
			$poll->published = 1;
			$poll->save();
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.pollUpdated'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.noSuchPoll'))->with('notif', 'danger');
		}
	}

	public function getUnpublish($id)
	{
		if(Session::get('user_level') < Config::get('cms.editPolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$poll = Poll::findOrFail($id);
			$poll->published = 0;
			$poll->save();
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.pollUpdated'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.noSuchPoll'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.deletePolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$poll = Poll::findOrFail($id);
			$poll->delete();
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.PollDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.noSuchPoll'))->with('notif', 'danger');
		}
	}

	public function getRestore($id)
	{
		if(Session::get('user_level') < Config::get('cms.deletePolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$poll = Poll::onlyTrashed()->findOrFail($id);
			$poll->restore();
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.PollRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PollController@getIndex')))->with('message', Lang::get('admin.noSuchPoll'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deletePolls')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$poll = Poll::onlyTrashed()->findOrFail($id);
			$poll->pollOptions()->forceDelete();
			$poll->votes()->forceDelete();
			$poll->forceDelete();
			return Redirect::to(_l(URL::action('PollController@getTrashed')))->with('message', Lang::get('admin.commentDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('PollController@getTrashed')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
		}
	}


}
