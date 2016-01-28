<?php

class PublicPollController extends BaseController {

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
	 * GET /frontend/publicpoll
	 *
	 * @return Response
	 */
	public function index()
	{
		try {
			$polls = Poll::orderBy('id', 'desc')->paginate(5);
			foreach($polls as $key => $poll){
				$polls[$key]->vote_count = 1;
				foreach($poll->pollOptions as $option){
					$polls[$key]->vote_count += $option->vote_count;
				}
				if($polls[$key]->vote_count > 1){
					$polls[$key]->vote_count --;
				}
			}
			//$categoryNews = News::inCategory($category->id)->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->paginate(5);
			$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
			$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
			$results = News::inCategories(Config::get('settings.results'))->distinct('permalink')->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->groupBy('permalink')->orderBy('news.created_at', 'desc')->take(10)->get();
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

			View::share('title', "Анкете | Пушкице");

			$ogimage = Config::get('settings.defaultImage');

			$meta = "	<meta property='og:image' content='".$ogimage."'/>
						<meta property='og:title' content='".__("Анкете | Пушкице | Тачка спајања студената ФОН-а")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/ankete")."'/>
						<meta property='og:description' content='".__("Анкете - Пушкице")."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__("Анкете | Пушкице")."'>
						<meta name='twitter:description' content='".__("Анкете - Пушкице")."'>
						<meta name='twitter:image' content='".$ogimage."'>";

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
							'polls'			=> $polls);

			$this->setLayout($data);
			$this->layout->center			= View::make('frontend.content.polls', $data);
			
		} catch (Exception $e) {
			return App::abort(404);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /frontend/publicpoll/create
	 *
	 * @return Response
	 */
	public function singlePoll($id)
	{
		//try {
			
			$displayPoll = Poll::where('id', '=', $id)->firstOrFail();
			foreach($displayPoll->pollOptions as $option){
				$displayPoll->vote_count += $option->vote_count;
			}
			if($displayPoll->vote_count > 1){
				$displayPoll->vote_count --;
			}
			$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
			$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
			$results = News::inCategories(Config::get('settings.results'))->distinct('permalink')->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->groupBy('permalink')->orderBy('news.created_at', 'desc')->take(10)->get();
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
			$ogimage = Config::get('settings.defaultImg');
			View::share('title', $displayPoll->title." | Пушкице");

			$meta = "	<meta property='og:image' content='".$ogimage."'/>
						<meta property='og:title' content='".__($displayPoll->title." | Пушкице | Тачка спајања студената ФОН-а")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/ankete/".$displayPoll->id)."'/>
						<meta property='og:description' content='".__(strip_tags($displayPoll->title))."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__($displayPoll->title." | Пушкице")."'>
						<meta name='twitter:description' content='".__(strip_tags($displayPoll->title))."'>
						<meta name='twitter:image' content='".$ogimage."'>";

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
							'displayPoll'	=> $displayPoll);

			$this->setLayout($data);
			$this->layout->center 			= View::make('frontend.content.poll', $data);
			
		//} catch (Exception $e) {
		//	return App::abort(404);
		//}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /frontend/publicpoll
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /frontend/publicpoll/{id}
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
	 * GET /frontend/publicpoll/{id}/edit
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
	 * PUT /frontend/publicpoll/{id}
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
	 * DELETE /frontend/publicpoll/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}