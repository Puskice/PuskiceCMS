<?php 

class CategoryController extends BaseController {

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
			$categories = Category::where('title', 'LIKE', '%'.Input::get('q').'%')->where('tag', '<>', 1)->orderBy('title')->paginate(20);
		}
		else $categories = Category::where('tag', '<>', 1)->orderBy('title')->paginate(20);
		View::share('title', __(Lang::get('admin.categories')));
		View::share('categories', $categories);
		$this->layout->content = View::make('backend.categories.index');
	}

	public function getTags()
	{
		if(Session::get('user_level') < Config::get('cms.viewComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$categories = Category::where('title', 'LIKE', '%'.Input::get('q').'%')->where('tag', '=', 1)->orderBy('title')->paginate(20);
		}
		else $categories = Category::orderBy('title')->where('tag', '=', 1)->paginate(20);
		View::share('title', __(Lang::get('admin.tags')));
		View::share('categories', $categories);
		$this->layout->content = View::make('backend.categories.index');
	}

	public function getTrashed()
	{
		if(Session::get('user_level') < Config::get('cms.viewComments')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		if(Input::get('q')){
			$categories = Category::onlyTrashed()->where('title', 'LIKE', '%'.Input::get('q').'%')->orderBy('title')->paginate(20);
		}
		else $categories = Category::onlyTrashed()->orderBy('title')->paginate(20);
		View::share('title', __(Lang::get('admin.categories')));
		View::share('categories', $categories);
		$this->layout->content = View::make('backend.categories.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if(Session::get('user_level') < Config::get('cms.addCategory')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$this->setLayout();
			View::share('title', Lang::get('admin.newCategory'));
			$this->layout->content = View::make('backend.categories.create');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('CategoryController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if(Session::get('user_level') < Config::get('cms.addCategory')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title'	=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('CategoryController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$category = new Category;
	    		if(!Input::get('permalink')){
	    			$category->permalink	= slugify(Input::get('title'));
	    		}
	    		else $category->permalink	= slugify(Input::get('permalink'));
	    		$category->title			= Input::get('title');
	    		if(Input::get('is_tag') == 1)	$category->tag 	= Input::get('is_tag');
	    		else $category->tag = 0;
	    		$category->save();
	    		return Redirect::to(_l(URL::action('CategoryController@getEdit')."/".$category->id))->with('message', Lang::get('admin.categorySaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('CategoryController@getIndex')))->with('message', Lang::get('admin.noSuchCategory'))->with('notif', 'danger');
	    	}
	    }
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
		if(Session::get('user_level') < Config::get('cms.editCategory')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$this->setLayout();
			$category = Category::findOrFail($id);
			View::share('title', Lang::get('admin.newCategory'));
			View::share('category', $category);
			$this->layout->content = View::make('backend.categories.editCategory');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('CategoryController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.editCategory')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title'	=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('CategoryController@getEdit').'/'.$id))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$category = Category::findOrFail($id);
	    		if(!Input::get('permalink')){
	    			$category->permalink	= slugify(Input::get('title'));
	    		}
	    		else $category->permalink	= slugify(Input::get('permalink'));
	    		$category->title			= Input::get('title');
	    		if(Input::get('is_tag') == 1)	$category->tag 	= Input::get('is_tag');
	    		else $category->tag = 0;
	    		$category->save();
	    		return Redirect::to(_l(URL::action('CategoryController@getEdit')."/".$category->id))->with('message', Lang::get('admin.categorySaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('CategoryController@getIndex')))->with('message', Lang::get('admin.noSuchCategory'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.deleteCategory')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$category = Category::findOrFail($id);
			$category->delete();
			$category->newsCategories()->delete();
			return Redirect::to(_l(URL::action('CategoryController@getIndex')))->with('message', Lang::get('admin.categoryDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('CategoryController@getIndex')))->with('message', Lang::get('admin.noSuchCategory'))->with('notif', 'danger');
		}
	}

	public function getRestore($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteCategory')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$category = Category::onlyTrashed()->findOrFail($id);
			$category->restore();
			$category->newsCategories()->restore();
			return Redirect::to(_l(URL::action('CategoryController@getIndex')))->with('message', Lang::get('admin.categoryRestored'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('CategoryController@getIndex')))->with('message', Lang::get('admin.noSuchCategory'))->with('notif', 'danger');
		}
	}

	public function getDestroy($id)
	{
		if(Session::get('user_level') < Config::get('cms.deleteCategory')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		try {
			$category = Category::onlyTrashed()->findOrFail($id);
			$category->newsCategories()->forceDelete();
			$category->forceDelete();
			return Redirect::to(_l(URL::action('CategoryController@getTrashed')))->with('message', Lang::get('admin.categoryDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('CategoryController@getTrashed')))->with('message', Lang::get('admin.noSuchCategory'))->with('notif', 'danger');
		}
	}


}
