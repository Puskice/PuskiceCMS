<?php

class MenuController extends BaseController {

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
		if(Session::get('user_level') < Config::get('cms.viewMenu')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		$menus = Menu::paginate(20);
		View::share('title', Lang::get('admin.allMenus'));
		View::share('menus', $menus);
		$this->layout->content = View::make('backend.menus.index');
	}

	public function getTrashed()
	{
		if(Session::get('user_level') < Config::get('cms.viewMenu')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		$menus = Menu::onlyTrashed()->paginate(20);
		View::share('title', Lang::get('admin.allMenus'));
		View::share('menus', $menus);
		$this->layout->content = View::make('backend.menus.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		if(Session::get('user_level') < Config::get('cms.viewMenu')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		View::share('title', Lang::get('admin.createMenu'));
		$this->layout->content = View::make('backend.menus.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		if(Session::get('user_level') < Config::get('cms.viewMenu')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title'	=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('MenuController@getCreate')))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$menu = new Menu;
	    		$menu->menu_title	= Input::get('title');
	    		$menu->menu_class	= Input::get('class');
	    		$menu->menu_id		= Input::get('cssid');
	    		$menu->save();
	    		return Redirect::to(_l(URL::action('MenuController@getEdit')."/".$menu->id))->with('message', Lang::get('admin.menuSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('MenuController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
	    	}
	    }
	}

	public function getItemCreate($menu_id)
	{
		if(Session::get('user_level') < Config::get('cms.addMenuItem')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		try {
			$menu = Menu::findOrFail($menu_id);
			View::share('title', Lang::get('admin.createMenuItem'));
			View::share('menu', $menu);
			$this->layout->content = View::make('backend.menus.itemCreate');

		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MenuController@getIndex')))->with('message', Lang::get('admin.noSuchMenu'))->with('notif', 'danger');
		}
		
	}

	public function postItemStore($id)
	{
		if(Session::get('user_level') < Config::get('cms.addMenuItem')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title'	=> 'Required',
			'url'	=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('MenuController@getItemCreate')."/".$id))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$menu = Menu::findOrFail($id);
	    		$item = new MenuItem;
	    		$item->title		= Input::get('title');
	    		$item->url 			= Input::get('url');
	    		$item->item_class	= Input::get('class');
	    		$item->item_id		= Input::get('cssid');
	    		$item->ordering 	= Input::get('ordering');
	    		$item->parent_id	= Input::get('parent');
	    		$item->target 		= Input::get('target');
	    		$item->menu_id		= $menu->id;
	    		$item->save();
	    		return Redirect::to(_l(URL::action('MenuController@getItemEdit')."/".$item->id))->with('message', Lang::get('admin.menuItemSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('MenuController@getEdit')."/".$id))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.addMenuItem')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		try {
			$menu = Menu::findOrFail($id);
			$menuHelper = new MenuHelper;
			View::share('title', Lang::get('admin.editMenu').": ".$menu->menu_title);
			View::share('menu', $menu);
			View::share('menuHelper', $menuHelper);
			$this->layout->content = View::make('backend.menus.edit');

		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MenuController@getIndex')))->with('message', Lang::get('admin.noSuchMenu'))->with('notif', 'danger');
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
		if(Session::get('user_level') < Config::get('cms.addMenuItem')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title'	=> 'Required'
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('MenuController@getEdit')."/".$id))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$menu = Menu::findOrFail($id);
	    		$menu->menu_title	= Input::get('title');
	    		$menu->menu_class	= Input::get('class');
	    		$menu->menu_id		= Input::get('cssid');
	    		$menu->save();
	    		return Redirect::to(_l(URL::action('MenuController@getEdit')."/".$menu->id))->with('message', Lang::get('admin.menuSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('MenuController@getIndex')))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
	    	}
	    }
	}

	public function getItemEdit($id){
		if(Session::get('user_level') < Config::get('cms.addMenuItem')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		try {
			$item = MenuItem::findOrFail($id);
			View::share('title', Lang::get('admin.editMenuItem').": ".$item->title);
			View::share('item', $item);
			$this->layout->content = View::make('backend.menus.itemEdit');

		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MenuController@getIndex')))->with('message', Lang::get('admin.noSuchMenu'))->with('notif', 'danger');
		}
	}

	public function postItemUpdate($id){
		if(Session::get('user_level') < Config::get('cms.addMenuItem')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$rules = array(
			'title'	=> 'Required',
			'url'	=> 'Required',
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::action('MenuController@getItemEdit')."/".$id))->withErrors($validator)->withInput();
	    }
	    else{
	    	try {
	    		$item = MenuItem::findOrFail($id);
	    		$item->title		= Input::get('title');
	    		$item->url 			= Input::get('url');
	    		$item->item_class	= Input::get('class');
	    		$item->item_id		= Input::get('cssid');
	    		$item->ordering 	= Input::get('ordering');
	    		$item->parent_id	= Input::get('parent');
	    		$item->target 		= Input::get('target');
	    		$item->save();
	    		return Redirect::to(_l(URL::action('MenuController@getItemEdit')."/".$item->id))->with('message', Lang::get('admin.menuItemSaved'))->with('notif', 'success');
	    	} catch (Exception $e) {
	    		return Redirect::to(_l(URL::action('MenuController@getEdit')."/".$item->menu->id))->with('message', Lang::get('admin.error'))->with('notif', 'danger');
	    	}
	    }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id)
	{
		try {
			$menu = Menu::findOrFail($id);
			$menu->items()->delete();
			$menu->delete();
			return Redirect::to(_l(URL::action('MenuController@getIndex')))->with('message', Lang::get('admin.menuDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MenuController@getIndex')))->with('message', Lang::get('admin.noSuchMenu'))->with('notif', 'danger');
		}
	}

	public function getItemDestroy($id){
		try {
			$item = MenuItem::findOrFail($id);
			$menu_id = $item->menu_id;
			foreach($item->children as $child){
				$child->parent_id = $item->parent_id;
				$child->save();
			}
			$item->delete();
			return Redirect::to(_l(URL::action('MenuController@getEdit')."/".$menu_id))->with('message', Lang::get('admin.menuItemDeleted'))->with('notif', 'success');
		} catch (Exception $e) {
			return Redirect::to(_l(URL::action('MenuController@getIndex')))->with('message', Lang::get('admin.noSuchMenuItem'))->with('notif', 'danger');
		}
	}


}
