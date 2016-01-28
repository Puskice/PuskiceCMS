<?php

class PublicNewsController extends BaseController {

	public function __construct(){
		parent::__construct();
		Session::put('ref', $_SERVER['REQUEST_URI']);
	}

	private function setLayout($data){
		$this->layout 					= View::make('frontend.master', $data);
		$this->layout->head 			= View::make('frontend.head', $data);
		$this->layout->topMenu			= View::make('frontend.topMenu', $data);
		$this->layout->header 			= View::make('frontend.header', $data);
		$this->layout->megaMenu			= View::make('frontend.megaMenu', $data);
		$this->layout->banners 			= View::make('frontend.banners');
		$this->layout->footer 			= View::make('frontend.footer', $data);
		$this->layout->footerScript		= View::make('frontend.footerScript', $data);
		//$this->layout->carousel 		= View::make('frontend.carousel', $data);
		$this->layout->boxes 			= View::make('frontend.boxes', $data);
		$this->layout->bottomBoxes		= View::make('frontend.bottomBoxes', $data);
		$this->layout->imageOfTheWeek	= View::make('frontend.sidebar.imageOfTheWeek', $data);
		$this->layout->didYouKnow 		= View::make('frontend.sidebar.didYouKnow', $data);
		$this->layout->twitter 			= View::make('frontend.sidebar.twitter');
		$this->layout->facebook 		= View::make('frontend.sidebar.facebook');
		$this->layout->banner300 		= View::make('frontend.sidebar.banner300');
		$this->layout->search 			= View::make('frontend.sidebar.search');
		$this->layout->error 			= View::make('frontend.errorReporting', $data);
		/*$this->layout->newsTicker 		= View::make('frontend.newsTicker', $data);*/
	}

	/**
	 * Display a listing of the resource.
	 * GET /frontend/publicnews
	 *
	 * @return Response
	 */
	public function singlePage($permalink)
	{
		try {
			if(Session::get('user_level') >= Config::get('cms.viewAdminNews')){
				$page = News::where('post_type', '=', 2)->where('published', '>=', 1)->where('permalink', '=', $permalink)->firstOrFail();
			}
			else{
				$page = News::where('post_type', '=', 2)->where('published', '=', 2)->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('permalink', '=', $permalink)->firstOrFail();	
			}
			$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
			$results = News::inCategories(Config::get('settings.results'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
			$featuredImage = News::inCategories(array(25))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(3)->get();
			$didYouKnow = News::inCategories(array(30))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(3)->get();
			$magazine = News::inCategories(Config::get('settings.magazine'))->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$ourComment = News::inCategories(array(17))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$feed = getFeed('http://bazaznanja.puskice.org/feed/qa.rss', 4);
			$poll = null;
			$poll = Poll::where('published', '=', '1')
				->where('end_date', '>', date("Y-m-d H:i:s", strtotime('now')))
				->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))
				->first();
			if(isset($poll->id)){
				$poll->pollOptions;
			}

			View::share('title', strip_tags($page->title)." | Пушкице");

			$ogimage = firstImage($page);

			$meta = "	<meta property='og:image' content='".str_replace(" ", "%20", $ogimage)."'/>
						<meta property='og:title' content='".__($page->title." | Пушкице")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/stranica/".$page->permalink)."'/>
						<meta property='og:description' content='".__(strip_tags($page->short_content))."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__($page->title." | Пушкице")."'>
						<meta name='twitter:description' content='".__(strip_tags($page->short_content))."'>
						<meta name='twitter:image' content='".str_replace(" ", "%20", $ogimage)."'>";

			$page->view_count ++;
			$page->save();

			$data = array(	'articles' 		=> $articles,
							'featured' 		=> $featured,
							'results' 		=> $results,
							'ourComment'	=> $ourComment,
							'magazine' 		=> $magazine,
							'featuredImage'	=> $featuredImage,
							'didYouKnow'	=> $didYouKnow,
							'feed' 			=> $feed,
							'poll'			=> $poll,
							'meta'			=> $meta,
							'page'			=> $page);

			$this->setLayout($data);
			$this->layout->center 			= View::make('frontend.content.page', $data);
			
		} catch (Exception $e) {
			return App::abort(404);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /frontend/publicnews/create
	 *
	 * @return Response
	 */
	public function singleNews($date, $permalink)
	{
		try {
			if(Session::get('user_level') >= Config::get('cms.viewAdminNews')){
				$page = News::where('post_type', '=', 1)->where('published', '>=', 1)->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('permalink', '=', $permalink)->where('created_at', 'LIKE', urlToDate($date)."%")->firstOrFail();
			}
			else{
				$page = News::where('post_type', '=', 1)->where('published', '=', 2)->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('permalink', '=', $permalink)->where('created_at', 'LIKE', urlToDate($date)."%")->firstOrFail();
			}
			$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
			$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
			$results = News::inCategories(Config::get('settings.results'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$featuredImage = News::inCategories(array(25))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(3)->get();
			$didYouKnow = News::inCategories(array(30))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(3)->get();
			$magazine = News::inCategories(Config::get('settings.magazine'))->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$ourComment = News::inCategories(array(17))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$feed = getFeed('http://bazaznanja.puskice.org/feed/qa.rss', 4);
			$poll = null;
			$poll = Poll::where('published', '=', '1')
				->where('end_date', '>', date("Y-m-d H:i:s", strtotime('now')))
				->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))
				->first();
			if(isset($poll->id)){
				$poll->pollOptions;
			}
			$comments = Comment::where('news_id', '=', $page->id)->orderBy('created_at', 'desc')->paginate(10);

			View::share('title', strip_tags($page->title)." | Пушкице");

			$ogimage = firstImage($page);

			$meta = "	<link rel='canonical' href='".Request::root()."/vest/".dateToUrl($page->created_at)."/".$page->permalink."' />
						<meta name='description' content='".__(dots(strip_tags($page->long_content), 150))."' />
						<meta property='og:image' content='".str_replace(" ", "%20", $ogimage)."'/>
						<meta property='og:title' content='".__($page->title." | Пушкице")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/vest/".dateToUrl($page->created_at)."/".$page->permalink)."'/>
						<meta property='og:description' content='".__(strip_tags($page->short_content))."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__($page->title." | Пушкице")."'>
						<meta name='twitter:description' content='".__(strip_tags($page->short_content))."'>
						<meta name='twitter:image' content='".str_replace(" ", "%20", $ogimage)."'>";

			$page->view_count ++;
			$page->save();

			$data = array(	'articles' 		=> $articles,
							'featured' 		=> $featured,
							'results' 		=> $results,
							'ourComment'	=> $ourComment,
							'magazine' 		=> $magazine,
							'featuredImage'	=> $featuredImage,
							'didYouKnow'	=> $didYouKnow,
							'feed' 			=> $feed,
							'poll'			=> $poll,
							'meta'			=> $meta,
							'page'			=> $page,
							'comments'		=> $comments);

			$this->setLayout($data);
			$this->layout->center 			= View::make('frontend.content.news', $data);
			
		} catch (Exception $e) {
			return App::abort(404);
		}
	}

	public function singleSubject($year, $department, $permalink){
		try {
			$permalink = str_replace("_", "-", $permalink);
			if(Session::get('user_level') >= Config::get('cms.viewAdminNews')){
				$page = News::where('post_type', '=', 3)->where('published', '>=', 1)->where('permalink', '=', $permalink)->firstOrFail();
			}
			else{
				$page = News::where('post_type', '=', 3)->where('published', '=', 2)->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('permalink', '=', $permalink)->firstOrFail();	
			}
			$subjects = Subject::where('news_id', '=', $page->id)->get();
			$sub = Subject::where('news_id', '=', $page->id)->first();
			$allow = false;
			foreach($subjects as $key => $subject){
				if($year == Puskice::getYear($subject->semester) && Puskice::getDepartment($subject->department) == $department){
					$allow = true;	
				}	
			}
			if(!$allow) App::abort(404);

			$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
			$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
			$results = News::inCategories(Config::get('settings.results'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$featuredImage = News::inCategories(array(25))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(3)->get();
			$didYouKnow = News::inCategories(array(30))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(3)->get();
			$magazine = News::inCategories(Config::get('settings.magazine'))->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$ourComment = News::inCategories(array(17))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$feed = getFeed('http://bazaznanja.puskice.org/feed/qa.rss', 4);
			$poll = null;
			$poll = Poll::where('published', '=', '1')
				->where('end_date', '>', date("Y-m-d H:i:s", strtotime('now')))
				->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))
				->first();
			if(isset($poll->id)){
				$poll->pollOptions;
			}

			View::share('title', strip_tags($page->title)." | Пушкице");

			$ogimage = firstImage($page);

			$meta = "	<meta property='og:image' content='".str_replace(" ", "%20", $ogimage)."'/>
						<meta property='og:title' content='".__($page->title." | Пушкице")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/".Puskice::getYear($sub->semester)."/".Puskice::getDepartment($sub->department)."/".$page->permalink)."'/>
						<meta property='og:description' content='".__(dots(strip_tags($page->short_content), 500))."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__($page->title." | Пушкице")."'>
						<meta name='twitter:description' content='".__(dots(strip_tags($page->short_content), 500))."'>
						<meta name='twitter:image' content='".str_replace(" ", "%20", $ogimage)."'>";

			$page->view_count ++;
			$page->save();

			$data = array(	'articles' 		=> $articles,
							'featured' 		=> $featured,
							'results' 		=> $results,
							'ourComment'	=> $ourComment,
							'magazine' 		=> $magazine,
							'featuredImage'	=> $featuredImage,
							'didYouKnow'	=> $didYouKnow,
							'feed' 			=> $feed,
							'poll'			=> $poll,
							'meta'			=> $meta,
							'sub'			=> $sub,
							'page'			=> $page);

			$this->setLayout($data);
			$this->layout->center 			= View::make('frontend.content.subject', $data);
			
		} catch (Exception $e) {
			return App::abort(404);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /frontend/publicnews
	 *
	 * @return Response
	 */
	public function singleCategory($permalink)
	{
		try {
			$category = Category::where('permalink', '=', $permalink)->firstOrFail();
			$categoryNews = News::inCategory($category->id)->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->paginate(5);
			$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
			$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
			$results = News::inCategories(Config::get('settings.results'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$featuredImage = News::inCategories(array(25))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(3)->get();
			$didYouKnow = News::inCategories(array(30))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(3)->get();
			$magazine = News::inCategories(Config::get('settings.magazine'))->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$ourComment = News::inCategories(array(17))->where('published', '=', 2)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(4)->get();
			$feed = getFeed('http://bazaznanja.puskice.org/feed/qa.rss', 4);
			$poll = null;
			$poll = Poll::where('published', '=', '1')
				->where('end_date', '>', date("Y-m-d H:i:s", strtotime('now')))
				->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))
				->first();
			if(isset($poll->id)){
				$poll->pollOptions;
			}

			View::share('title', $category->title." | Пушкице");

			$ogimage = Config::get('settings.defaultImage');

			$meta = "	<meta property='og:image' content='".str_replace(" ", "%20", $ogimage)."'/>
						<meta property='og:title' content='".__($category->title." | Пушкице")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/".$category->permalink)."'/>
						<meta property='og:description' content='".__($category->title)."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__($category->title." | Пушкице")."'>
						<meta name='twitter:description' content='".__($category->title)."'>
						<meta name='twitter:image' content='".str_replace(" ", "%20", $ogimage)."'>";

			$data = array(	'articles' 		=> $articles,
							'featured' 		=> $featured,
							'results' 		=> $results,
							'ourComment'	=> $ourComment,
							'magazine' 		=> $magazine,
							'featuredImage'	=> $featuredImage,
							'didYouKnow'	=> $didYouKnow,
							'feed' 			=> $feed,
							'poll'			=> $poll,
							'meta'			=> $meta,
							'category'		=> $category,
							'categoryNews'	=> $categoryNews);

			$this->setLayout($data);
			$this->layout->center			= View::make('frontend.content.category', $data);
			
		} catch (Exception $e) {
			return App::abort(404);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /frontend/publicnews/{id}
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
	 * GET /frontend/publicnews/{id}/edit
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
	 * PUT /frontend/publicnews/{id}
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
	 * DELETE /frontend/publicnews/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}