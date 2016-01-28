<?php

class MemeCommentController extends BaseController {

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
		if(Session::get('user_level') < Config::get('cms.viewComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$comments = MemeComment::where('comment_content', 'LIKE', '%'.Input::get('q').'%')->orderBy('created_at', 'desc')->paginate(20);
		}
		else $comments = MemeComment::orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.comments')));
		View::share('comments', $comments);
		$this->layout->content = View::make('backend.puskice.memeComments.index');
	}

	public function getTrashed()
	{
		if(Session::get('user_level') < Config::get('cms.viewComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$comments = MemeComment::onlyTrashed()->where('comment_content', 'LIKE', '%'.Input::get('q').'%')->orderBy('created_at', 'desc')->paginate(20);
		}
		else $comments = MemeComment::onlyTrashed()->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.trashedComments')));
		View::share('comments', $comments);
		$this->layout->content = View::make('backend.puskice.memeComments.index');
	}

	public function getArticleComments($id){
		if(Session::get('user_level') < Config::get('cms.viewComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$comments = MemeComment::where('news_id', '=', $id)->where('comment_content', 'LIKE', '%'.Input::get('q').'%')->orderBy('created_at', 'desc')->paginate(20);
		}
		else $comments = MemeComment::where('news_id', '=', $id)->orderBy('created_at', 'desc')->paginate(20);
		View::share('title', __(Lang::get('admin.comments')));
		View::share('comments', $comments);
		$this->layout->content = View::make('backend.puskice.memeComments.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($id)
	{
		if(Session::get('user_level') < Config::get('cms.editComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['subfolder'] = 'images/';
			$meme = MemeInstance::findOrFail($id);
			$this->setLayout();
			View::share('title', Lang::get('admin.newComment').": ".dots($meme->first_line, 60));
			View::share('meme', $meme);
			View::share('id', $id);
			$this->layout->content = View::make('backend.puskice.memeComments.create');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('CommentController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if(Session::get('user_level') < Config::get('cms.editComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'commentContent'	=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);
 
	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('MemeCommentController@getCreate').'/'.Input::get('newsId')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$comment = new MemeComment;
	    		if(Input::get('createdAt')){
	    			$comment->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$comment->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$comment->comment_content	= Input::get('commentContent');
	    		$comment->published 		= Input::get('published');
	    		$comment->username 			= Config::get('settings.commentSignature');
	    		$comment->email 			= Config::get('settings.generalEmail');
	    		$comment->user_id			= 1;
	    		$comment->news_id 			= Input::get('newsId');
	    		$comment->save();
	    		return Redirect::to(_l(URL::action('MemeCommentController@getEdit')."/".$comment->id))->with('message', Lang::get('admin.commentSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['subfolder'] = 'images/';
			$comment = MemeComment::findOrFail($id);
			$this->setLayout();
			View::share('title', Lang::get('admin.editComment').": ".dots($comment->meme->first_line, 60));
			View::share('comment', $comment);
			$this->layout->content = View::make('backend.puskice.memeComments.editComment');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'commentContent'	=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);
 
	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('MemeCommentController@getCreate').'/'.Input::get('newsId')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$comment = MemeComment::findOrFail($id);
	    		if(Input::get('createdAt')){
	    			$comment->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$comment->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$comment->comment_content	= Input::get('commentContent');
	    		$comment->published 		= Input::get('published');
	    		$comment->username 			= Config::get('settings.commentSignature');
	    		$comment->email 			= Config::get('settings.generalEmail');
	    		$comment->save();
	    		return Redirect::to(_l(URL::action('MemeCommentController@getEdit')."/".$comment->id))->with('message', Lang::get('admin.commentSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
	    	}
	    }	
	}


	public function getPublish($id)
	{
		if(Session::get('user_level') < Config::get('cms.editComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$comment = MemeComment::findOrFail($id);
			$comment->published = 1;
			$comment->save();
			return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.commentUpdated'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
		}
	}

	public function getUnpublish($id)
	{
		if(Session::get('user_level') < Config::get('cms.editComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$comment = MemeComment::findOrFail($id);
			$comment->published = 0;
			$comment->save();
			return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.commentUpdated'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.deleteComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$comment = MemeComment::findOrFail($id);
			$comment->delete();
			return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.commentDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
		}
	}

	public function getRestore($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$comment = MemeComment::onlyTrashed()->findOrFail($id);
			$comment->restore();
			return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.commentRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeCommentController@getIndex')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$comment = MemeComment::onlyTrashed()->findOrFail($id);
			$comment->forceDelete();
			return Redirect::to(_l(URL::action('MemeCommentController@getTrashed')))->with('message', Lang::get('admin.commentDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MemeCommentController@getTrashed')))->with('message', Lang::get('admin.noSuchComment'))->with('notif', 'danger');
		}
	}


}
