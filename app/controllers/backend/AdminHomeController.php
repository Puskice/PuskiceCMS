<?php 

class AdminHomeController extends BaseController {

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
		View::share('admin', $admin);
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
		View::share('title', __(Lang::get('admin.dashboard')));
		$news = News::where('post_type', '=', 1)->orderBy('created_at', 'desc')->take(5)->get();
		$comments = Comment::orderBy('created_at', 'desc')->take(5)->get();
		$users = User::orderBy('created_at', 'desc')->take(5)->get();
		$files = Files::orderBy('created_at', 'desc')->take(5)->get();
		$categories = Category::orderBy('created_at', 'desc')->take(5)->get();
		$pages = News::where('post_type', '=', 2)->orderBy('created_at', 'desc')->take(5)->get();
		View::share('news', $news);
		View::share('comments', $comments);
		View::share('users', $users);
		View::share('files', $files);
		View::share('pages', $pages);
		View::share('categories', $categories);
		$this->setLayout();
		$this->layout->content = View::make('backend.content.dashboard');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
