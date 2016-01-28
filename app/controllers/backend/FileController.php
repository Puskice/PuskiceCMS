<?php

class FileController extends BaseController {

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
		if(Session::get('user_level') < Config::get('cms.viewFiles')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$files = Fils::where('title', 'LIKE', '%'.Input::get('q').'%')
			->orWhere('description', 'LIKE', '%'.Input::get('q').'%')
			->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$files = Files::orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.allFiles'));
		View::share('files', $files);
		$this->layout->content = View::make('backend.files.index');
	}

	public function getTrashed()
	{
		if(Session::get('user_level') < Config::get('cms.viewFiles')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$files = Fils::onlyTrashed()->where('title', 'LIKE', '%'.Input::get('q').'%')
			->orWhere('description', 'LIKE', '%'.Input::get('q').'%')
			->orderBy('created_at', 'desc')->paginate(20);
		}
		else{
			$files = Files::onlyTrashed()->orderBy('created_at', 'desc')->paginate(20);
		}
		View::share('title', Lang::get('admin.trashedFiles'));
		View::share('files', $files);
		$this->layout->content = View::make('backend.files.index');
	}

	public function getNewsFiles($news_id)
	{
		if(Session::get('user_level') < Config::get('cms.viewFiles')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$this->setLayout();
			$news = News::findOrFail($news_id);
			if(Input::get('q')){
				$files = Fils::where('title', 'LIKE', '%'.Input::get('q').'%')
				->where('news_id', '=', $news_id)
				->orderBy('created_at', 'desc')->paginate(20);
			}
			else{
				$files = Files::orderBy('created_at', 'desc')->where('news_id', '=', $news_id)->paginate(20);
			}
			View::share('title', Lang::get('admin.allFiles').": ".$news->title);
			View::share('files', $files);
			$this->layout->content = View::make('backend.files.index');	
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('FileController@getIndex')))->with('message', Lang::get('admin.noSuchNews'))->with('notif', 'danger');
		}
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate($news_id)
	{
		if(Session::get('user_level') < Config::get('cms.addFile')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['upload_dir'] = '/download/';
			//$_SESSION['RF']['subfolder'] = '../download/';
			$news = News::findOrFail($news_id);
			$this->setLayout();
			View::share('title', Lang::get('admin.newFile').": ".dots($news->title, 60));
			View::share('news', $news);
			View::share('id', $news_id);
			$this->layout->content = View::make('backend.files.create');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('FileController@getIndex')))->with('message', Lang::get('admin.noSuchFile'))->with('notif', 'danger');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if(Session::get('user_level') < Config::get('cms.addFile')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'description'	=> 'Required',
			'url'			=> 'Required',
			'title'			=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('FileController@getCreate').'/'.Input::get('newsId')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$news 	= News::findOrFail(Input::get('newsId'));
	    		$file 	= new Files;
	    		if(Input::get('createdAt')){
	    			$file->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$file->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$file->description		= Input::get('description');
	    		$file->published		= Input::get('published');
	    		$file->user_id			= Session::get('id');
	    		$file->url 				= Input::get('url');
	    		$file->news_id 			= Input::get('newsId');
	    		$file->title 			= Input::get('title');
	    		$file->save();
	    		return Redirect::to(_l(URL::action('FileController@getEdit')."/".$file->id))->with('message', Lang::get('admin.fileSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('FileController@getIndex')))->with('message', Lang::get('admin.noSuchFile'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editFile')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$_SESSION['RF']['upload_dir'] = '/download/';
			$file = Files::findOrFail($id);
			$this->setLayout();
			View::share('title', Lang::get('admin.editFile').": ".dots($file->title, 60));
			View::share('file', $file);
			$this->layout->content = View::make('backend.files.editFile');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('FileController@getIndex')))->with('message', Lang::get('admin.noSuchFile'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editFile')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'description'	=> 'Required',
			'url'			=> 'Required',
			'title'			=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('FileController@getEdit').'/'.$id))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$file 	= Files::findOrFail($id);
	    		if(Input::get('createdAt')){
	    			$file->created_at	= date("Y-m-d H:i:s", strtotime(Input::get('createdAt')));
	    		}
	    		else{
	    			$file->created_at	= date("Y-m-d H:i:s", strtotime('now'));	
	    		}
	    		$file->description		= Input::get('description');
	    		$file->published		= Input::get('published');
	    		$file->user_id			= Session::get('id');
	    		$file->url 				= Input::get('url');
	    		$file->title 			= Input::get('title');
	    		$file->save();
	    		return Redirect::to(_l(URL::action('FileController@getEdit')."/".$file->id))->with('message', Lang::get('admin.fileSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('FileController@getIndex')))->with('message', Lang::get('admin.noSuchFile'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.deleteFile')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$file = Files::findOrFail($id);
			$file->delete();
			return Redirect::to(_l(URL::action('FileController@getIndex')))->with('message', Lang::get('admin.fileDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('FileController@getIndex')))->with('message', Lang::get('admin.noSuchFile'))->with('notif', 'danger');
		}
	}

	public function getRestore($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteFile')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$file = Files::onlyTrashed()->findOrFail($id);
			$file->restore();
			return Redirect::to(_l(URL::action('FileController@getIndex')))->with('message', Lang::get('admin.fileRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('FileController@getIndex')))->with('message', Lang::get('admin.noSuchFile'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteFile')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$file = Files::onlyTrashed()->findOrFail($id);
			$url = parse_url($file->url);
			@unlink(Config::get('cms.public_dir').$url['path']);
			$file->forceDelete();
			return Redirect::to(_l(URL::action('FileController@getTrashed')))->with('message', Lang::get('admin.fileDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('FileController@getTrashed')))->with('message', Lang::get('admin.noSuchFile'))->with('notif', 'danger');
		}
	}
}
