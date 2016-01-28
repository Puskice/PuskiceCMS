<?php 

class HomeController extends BaseController {

	public function __construct(){
		parent::__construct();
	}

	private function setLayout($data){
		$this->layout 					= View::make('frontend.home', $data);
		$this->layout->head 			= View::make('frontend.head', $data);
		$this->layout->topMenu			= View::make('frontend.topMenu', $data);
		$this->layout->header 			= View::make('frontend.header', $data);
		$this->layout->megaMenu			= View::make('frontend.megaMenu', $data);
		$this->layout->banners 			= View::make('frontend.banners');
		$this->layout->footer 			= View::make('frontend.footer', $data);
		$this->layout->footerScript		= View::make('frontend.footerScript', $data);
		$this->layout->banner300 		= View::make('frontend.sidebar.banner300');
		$this->layout->facebook 		= View::make('frontend.sidebar.facebook');
		$this->layout->search 			= View::make('frontend.sidebar.search');
		$this->layout->error 			= View::make('frontend.errorReporting', $data);
		/*$this->layout->newsTicker 		= View::make('frontend.newsTicker', $data);*/
	}

	private function setLayout2($data){
		$this->layout 					= View::make('frontend.master', $data);
		$this->layout->head 			= View::make('frontend.head', $data);
		$this->layout->topMenu			= View::make('frontend.topMenu', $data);
		$this->layout->header 			= View::make('frontend.header', $data);
		$this->layout->megaMenu			= View::make('frontend.megaMenu', $data);
		$this->layout->banners 			= View::make('frontend.banners');
		$this->layout->footer 			= View::make('frontend.footer', $data);
		$this->layout->footerScript		= View::make('frontend.footerScript', $data);
		$this->layout->bottomBoxes		= View::make('frontend.bottomBoxes', $data);
		$this->layout->facebook 		= View::make('frontend.sidebar.facebook');
		$this->layout->banner300 		= View::make('frontend.sidebar.banner300');
		$this->layout->search 			= View::make('frontend.sidebar.search');
		$this->layout->error 			= View::make('frontend.errorReporting', $data);
		/*$this->layout->newsTicker 		= View::make('frontend.newsTicker', $data);*/
	}

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		View::share('title', "Пушкице | ФОН Андерграунд - Факултет организационих наука");
		$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
		$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
		$results = News::inCategories(Config::get('settings.results'))->distinct('permalink')->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->groupBy('permalink')->orderBy('news.created_at', 'desc')->take(4)->get();
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
		$allNews = News::inCategories(Config::get('settings.homepage'))->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->paginate(5);

		$ogimage = Config::get('settings.defaultImage');

		$meta = "	<meta name='description' content='".__("Пушкице - независни студентски портал студената Факултета организационих наука основан 2001. године - Тачка спајања студената ФОН-а")."'>
					<meta name='keywords' content='".__("Пушкице, Факултет организационих наука, ФОН")."'/>
					<meta property='og:image' content='".$ogimage."'/>
					<meta property='og:title' content='".__("Пушкице | Факултет организационих наука - ФОН Андерграунд")."'/>
					<meta property='fb:app_id' content='355697367892039'/>
					<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
					<meta property='og:type' content='article'/>
					<meta property='og:url' content='".Request::root()."'/>
					<meta property='og:description' content='".__("Пушкице - независни студентски портал студената Факултета организационих наука - Тачка спајања студената ФОН-а")."' />
					<meta name='twitter:card' content='summary_large_image'>
					<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
					<meta name='twitter:creator' content='@puskice'>
					<meta name='twitter:domain' content='puskice.org'>
					<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
					<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
					<meta name='twitter:title' content='".__("Пушкице | Факултет организационих наука - ФОН Андерграунд")."'>
					<meta name='twitter:description' content='".__("Пушкице - независни студентски портал студената Факултета организационих наука - Тачка спајања студената ФОН-а")."'>
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
						'allNews'		=> $allNews,
						'meta'			=> $meta);

		$this->setLayout($data);
		//$this->layout->carousel 		= View::make('frontend.carousel', $data);
		$this->layout->slider 			= View::make('frontend.slider', $data);
		$this->layout->boxes 			= View::make('frontend.boxes', $data);
		$this->layout->imageOfTheWeek	= View::make('frontend.sidebar.imageOfTheWeek', $data);
		$this->layout->didYouKnow 		= View::make('frontend.sidebar.didYouKnow', $data);
		$this->layout->twitter 			= View::make('frontend.sidebar.twitter');
		$this->layout->poll 			= View::make('frontend.sidebar.poll', $data);
		$this->layout->allNews 			= View::make('frontend.allNews', $data);

	}

	public function conversion(){
		View::share('title', "Конверзија | Пушкице | Тачка спајања студената ФОН-а");
		
		$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
		$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
		$results = News::inCategories(Config::get('settings.results'))->distinct('permalink')->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->groupBy('permalink')->orderBy('news.created_at', 'desc')->take(4)->get();
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
		$ogimage = Config::get('settings.defaultImage');

		$meta = "	<meta property='og:image' content='".$ogimage."'/>
					<meta property='og:title' content='".__("Конверзија | Пушкице | Тачка спајања студената ФОН-а")."'/>
					<meta property='fb:app_id' content='355697367892039'/>
					<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
					<meta property='og:type' content='article'/>
					<meta property='og:url' content='".Request::root()."/konverzija/'/>
					<meta property='og:description' content='".__("Пресловљавање из ћирилице у латиницу помоћу речника")."' />
					<meta name='twitter:card' content='summary_large_image'>
					<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
					<meta name='twitter:creator' content='@puskice'>
					<meta name='twitter:domain' content='puskice.org'>
					<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
					<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
					<meta name='twitter:title' content='".__("Конверзија | Пушкице | Тачка спајања студената ФОН-а")."'>
					<meta name='twitter:description' content='".__("Пресловљавање из ћирилице у латиницу помоћу речника")."'>
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
						'meta'			=> $meta);

		$this->setLayout2($data);
		$this->layout->center 			= View::make('frontend.conversion', $data);
		//$this->layout->carousel 		= View::make('frontend.carousel', $data);
		$this->layout->boxes 			= View::make('frontend.boxes', $data);
		$this->layout->imageOfTheWeek	= View::make('frontend.sidebar.imageOfTheWeek', $data);
		$this->layout->didYouKnow 		= View::make('frontend.sidebar.didYouKnow', $data);
		$this->layout->twitter 			= View::make('frontend.sidebar.twitter');
		$this->layout->poll 			= View::make('frontend.sidebar.poll', $data);
		
	}

	public function newMembers(){
		View::share('title', "Нови чланови | Пушкице | Тачка спајања студената ФОН-а");
		
		$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
		$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
		$results = News::inCategories(Config::get('settings.results'))->distinct('permalink')->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->groupBy('permalink')->orderBy('news.created_at', 'desc')->take(4)->get();
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

		$meta = "	<meta property='og:image' content='http:".$ogimage."'/>
					<meta property='og:title' content='".__("Нови чланови | Пушкице | Тачка спајања студената ФОН-а")."'/>
					<meta property='fb:app_id' content='355697367892039'/>
					<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
					<meta property='og:type' content='article'/>
					<meta property='og:url' content='".Request::root()."/novi-clanovi/'/>
					<meta property='og:description' content='".__("Пријава за нове чланове Екипе Пушкица")."' />
					<meta name='twitter:card' content='summary_large_image'>
					<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
					<meta name='twitter:creator' content='@puskice'>
					<meta name='twitter:domain' content='puskice.org'>
					<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
					<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
					<meta name='twitter:title' content='".__("Нови чланови | Пушкице | Тачка спајања студената ФОН-а")."'>
					<meta name='twitter:description' content='".__("Пријава за нове чланове Екипе Пушкица")."'>
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
						'meta'			=> $meta);
		$this->setLayout2($data);
		$this->layout->center 			= View::make('frontend.content.noviClanovi', $data);
		//$this->layout->carousel 		= View::make('frontend.carousel', $data);
		$this->layout->boxes 			= View::make('frontend.boxes', $data);
		$this->layout->imageOfTheWeek	= View::make('frontend.sidebar.imageOfTheWeek', $data);
		$this->layout->didYouKnow 		= View::make('frontend.sidebar.didYouKnow', $data);
		$this->layout->twitter 			= View::make('frontend.sidebar.twitter');
		$this->layout->poll 			= View::make('frontend.sidebar.poll', $data);
	}

	public function apply(){
		$rules = array(
		        'name'     => 'required',
		        'email'		=>'required|email',
		        'fb'		=> 'required',
		        'interesovanje' => 'required',
		        'motivacija'	=> 'required',
		);
		$v = Validator::make(Input::all(), $rules);
		if($v->passes()){
			$user = array(
			    'email'=>'info@puskice.org',
			    'name'=>'Info tim'
			);
			// the data that will be passed into the mail view blade template
			$data = array(
			    'fb' => Input::get('fb'),
			    'tw' => Input::get('tw'),
			    'in' => Input::get('in'),
			    'email' => Input::get('email'),
			    'name'   => Input::get('name'),
			    'godina' => Input::get('godina'),
			    'motivacija' => Input::get('motivacija'),
			    'interesovanje' => Input::get('interesovanje')
			);
			 
			// use Mail::send function to send email passing the data and using the $user variable in the closure
			Mail::send('emails.members', $data, function($message) use ($user)
			{
			  $message->from('info@puskice.org', Input::get('name'));
			  $message->to('info@puskice.org', 'Info tim Puškice')->subject('Novi članovi');
			});
			return Redirect::to(Request::root())->with('notif','success')->with('message', _("Успешно сте се пријавили за чланство у Екипи Пушкица. Бићете контактирани у наредном периоду. Хвала на интересовању :)"));	
		}
		else{
			return Redirect::to(Request::root()."/novi-clanovi/")->withInput()->withErrors($v->getMessageBag());	
		}
	}

	public function function2048(){
		View::share('title', "2048 | Пушкице | Тачка спајања студената ФОН-а");
		
		$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
		$featured = News::where('published', '=', 2)->where('featured', '=', 1)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->orderBy('created_at', 'desc')->take(3)->get();
		$results = News::inCategories(Config::get('settings.results'))->distinct('permalink')->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->where('published', '=', 2)->where('post_type', '=', 1)->groupBy('permalink')->orderBy('news.created_at', 'desc')->take(4)->get();
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
		$ogimage = Config::get('settings.defaultImage');

		$meta = '<title>2048: #fonbg izdanje</title>
				  <base >
				  <meta name="description" content="#fonbg 2048."> 
				  <link href="//www.puskice.org/usvsth3m.co.uk/2048/style/main.css" rel="stylesheet" type="text/css">

				  <meta name="apple-mobile-web-app-capable" content="yes">

				  <link href="//fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext" rel="stylesheet" type="text/css">
				  <meta name="HandheldFriendly" content="True">
				  <meta name="MobileOptimized" content="320">
				  <!-- <link rel="icon" href="//usvsth3m.co.uk/favicon.ico">  -->
				  <!-- <link rel="image_src" href="../intro.jpg"> -->
				  <!-- <meta property="og:image" content="//community.usvsth3m.com/2048/intro.jpg" /> -->
				  <meta name="viewport" content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0, maximum-scale=1, user-scalable=no, minimal-ui">
				  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
				  <link href="//fonts.googleapis.com/css?family=Open+Sans&subset=latin,latin-ext" rel="stylesheet" type="text/css">
				  
				  <script src="//www.puskice.org/static.usvsth3m.com/js/wrapper.html"></script>
				  <link rel="stylesheet" href="//www.puskice.org/static.usvsth3m.com/css/wrapper.html">

				<style>
				  
				  .tile-text {
				    display:inline-block;
				    vertical-align: middle;
				  }

				  #uvt_box {
				    margin-top: -80px;
				  }
				  
				  
				  .tile-inner { background-position: center center !important; background-size: cover !important; background-repeat: no-repeat !important; }


				    
				    .tile-2 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/mDPgBQT.gif") !important; 
				    }
				  
				    
				    .tile-4 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/AJCewo6.gif") !important; 
				    }
				  
				    
				    .tile-8 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/uYuZILz.gif") !important; 
				    }
				  
				    
				    .tile-16 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/rb9cBw7.gif") !important; 
				    }
				  
				    
				    .tile-32 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/a6OHkjt.gif") !important; 
				    }
				  
				    
				    .tile-64 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/StPZKlu.gif") !important; 
				    }
				  
				    
				    .tile-128 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/vjWJLmd.gif") !important; 
				    }
				  
				    
				    .tile-256 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/RThRV8V.gif") !important; 
				    }
				  
				    
				    .tile-512 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/tmQQswo.gif") !important; 
				    }
				  
				    
				    .tile-1024 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/QsE9h31.gif") !important; 
				    }
				  
				    
				    .tile-2048 .tile-inner {
				      background-image: url("https://www.puskice.org/i.imgur.com/SfGbUDU.gif") !important; 
				    }
				  
				    
				  
				  .game-container { background-color: #565656 }
				  
				  
				  .preload, .preload img { position: absolute; top: -100px; -left: 100px; width: 1px; height: 1px; overflow: hidden; }
				  
				  #fix { 
				    position: absolute; top: 0; left: 0; width: 100%; height: 100%; position: fixed; z-index: -1000; 
				        }

				</style>

				  
				<script>
				var external_score; 
				var tile_contents = ["","","","","","","","","","","",""];

				var external_score;

				function tweet() {

				}

				function facebook() {

				}

				var sizes = [];
				function resizeTextOn(whichelement) {

				  if (typeof sizes[whichelement] == "undefined") {

				    $(whichelement + " .tile-inner").css("display", "block");
				    $(whichelement + " .tile-text").css("display", "inline-block");

				    $(whichelement + " .tile-text").css("fontSize", "60px");

				    while ($(whichelement + " .tile-text").width()+30 > $(whichelement + " .tile-inner").width()) {
				      var newSize = (parseInt($(whichelement + " .tile-text").css("fontSize")) - 1) + "px";
				      $(whichelement + " .tile-text").css("fontSize", newSize);
				    }

				    if (typeof newSize == "undefined") { var newSize = "60px"; }

				    $(whichelement + " .tile-text").css("lineHeight", newSize);

				    if (parseInt(newSize) > 50) {
				      $(whichelement + " .tile-text").css("position", "relative");
				      $(whichelement + " .tile-text").css("top", "5px");
				    } else {
				      $(whichelement + " .tile-text").css("position", "relative");
				      $(whichelement + " .tile-text").css("top", "0px");
				    }

				    $(whichelement + " .tile-inner").css("display", "table");
				    $(whichelement + " .tile-text").css("display", "table-cell");

				    sizes[whichelement] = newSize;

				  } else {

				    newSize = sizes[whichelement];

				    $(whichelement + " .tile-text").css("fontSize", newSize);
				    $(whichelement + " .tile-text").css("lineHeight", newSize);

				    if (parseInt(newSize) > 50) {
				      $(whichelement + " .tile-text").css("position", "relative");
				      $(whichelement + " .tile-text").css("top", "5px");
				    } else {
				      $(whichelement + " .tile-text").css("position", "relative");
				      $(whichelement + " .tile-text").css("top", "0px");
				    }

				    $(whichelement + " .tile-inner").css("display", "table");
				    $(whichelement + " .tile-text").css("display", "table-cell");

				  }

				}

				$(document).keypress(function(event) {
				  if ( event.which == 61 ) {
				    $(".tile-container").empty();
				    var tile = new Tile({x:0,y:0},2);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:1,y:0},4);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:2,y:0},8);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:3,y:0},16);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:0,y:1},32);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:1,y:1},64);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:2,y:1},128);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:3,y:1},256);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:0,y:2},512);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:1,y:2},1024);
				    HTMLActuator.prototype.addTile(tile);
				    var tile = new Tile({x:2,y:2},2048);
				    HTMLActuator.prototype.addTile(tile);
				  }
				});

				</script>

				<style>
				@media (min-width: 800px) {
				  .sharer {
				         -moz-column-count: 2;
				         -moz-column-gap: 20px;
				         -webkit-column-count: 2;
				         -webkit-column-gap: 20px;
				         
				  }
				  .sharer a { color: #0000cc; }
				}
				@media (max-width: 800px) {
				  .sharer {
				    padding: 0 10px;
				  }
				  .sharer a { color: #0000cc; }
				}

				</style>
				<meta property="og:image" content="'.$ogimage.'"/>
				<meta property="og:title" content="'.Trans::_t("2048 | Пушкице").'"/>
				<meta property="fb:app_id" content="355697367892039"/>
				<meta property="og:site_name" content="'.Trans::_t("Пушкице - ФОН Андерграунд").'"/>
				<meta property="og:type" content="article"/>
				<meta property="og:url" content="'.Request::root().'/2048"/>
				<meta property="og:description" content="'.Trans::_t("Драге колеге, представљамо вам ФОН верзију популарне игрице 2048 у којој уместо бројева можете пронаћи карикатуре професора са нашег факултета.").'" />
				<meta name="twitter:card" content="summary_large_image">
				<meta name="twitter:site" content="'.Trans::_t("Пушкице - ФОН Андерграунд").'">
				<meta name="twitter:creator" content="@puskice">
				<meta name="twitter:domain" content="puskice.org">
				<meta name="twitter:app:name:iphone" content="'.Trans::_t("Пушкице").'">
				<meta name="twitter:app:name:ipad" content="'.Trans::_t("Пушкице").'">
				<meta name="twitter:title" content="'.Trans::_t("2048 | Пушкице").'">
				<meta name="twitter:description" content="'.Trans::_t("Драге колеге, представљамо вам ФОН верзију популарне игрице 2048 у којој уместо бројева можете пронаћи карикатуре професора са нашег факултета.").'">
				<meta name="twitter:image" content="'.$ogimage.'">';

		$data = array(	'articles' 		=> $articles,
						'featured' 		=> $featured,
						'results' 		=> $results,
						'ourComment'	=> $ourComment,
						'magazine' 		=> $magazine,
						'featuredImage'	=> $featuredImage,
						'didYouKnow'	=> $didYouKnow,
						'feed' 			=> $feed,
						'poll'			=> $poll,
						'meta'			=> $meta);
		$this->setLayout2($data);
		$this->layout->center 			= View::make('frontend.content.view2048', $data);
		//$this->layout->carousel 		= View::make('frontend.carousel', $data);
		$this->layout->boxes 			= View::make('frontend.boxes', $data);
		$this->layout->imageOfTheWeek	= View::make('frontend.sidebar.imageOfTheWeek', $data);
		$this->layout->didYouKnow 		= View::make('frontend.sidebar.didYouKnow', $data);
		$this->layout->twitter 			= View::make('frontend.sidebar.twitter');
		$this->layout->poll 			= View::make('frontend.sidebar.poll', $data);
	}


	public function pacman(){
		try {
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

			View::share('title', "Пакмен | Пушкице");

			$ogimage = Config::get('settings.defaultImage');

			$meta = "	<meta property='og:image' content='".$ogimage."'/>
						<meta property='og:title' content='".__("Пакмен | Пушкице")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/pacman/")."'/>
						<meta property='og:description' content='".__("Легендарна игрица Пакмен")."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__("Пакмен | Пушкице")."'>
						<meta name='twitter:description' content='".__("Легендарна игрица Пакмен")."'>
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
							'meta'			=> $meta);

			$this->setLayout2($data);
			
			$this->layout->boxes 			= View::make('frontend.boxes', $data);
			$this->layout->imageOfTheWeek	= View::make('frontend.sidebar.imageOfTheWeek', $data);
			$this->layout->didYouKnow 		= View::make('frontend.sidebar.didYouKnow', $data);
			$this->layout->twitter 			= View::make('frontend.sidebar.twitter');
			$this->layout->poll 			= View::make('frontend.sidebar.poll', $data);
			$this->layout->center 			= View::make('frontend.content.pacmanGame', $data);
			
		} catch (Exception $e) {
			return App::abort(404);
		}
	}

	public function kviz(){
		try {
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

			View::share('title', "Квиз | Пушкице");

			$ogimage = Config::get('settings.defaultImage');

			$meta = "	<meta property='og:image' content='".$ogimage."'/>
						<meta property='og:title' content='".__("Квиз | Пушкице")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/kviz/")."'/>
						<meta property='og:description' content='".__("Квиз за ФОН-овце")."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__("Квиз | Пушкице")."'>
						<meta name='twitter:description' content='".__("Квиз за ФОН-овце")."'>
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
							'meta'			=> $meta);

			$this->setLayout2($data);
			
			$this->layout->boxes 			= View::make('frontend.boxes', $data);
			$this->layout->imageOfTheWeek	= View::make('frontend.sidebar.imageOfTheWeek', $data);
			$this->layout->didYouKnow 		= View::make('frontend.sidebar.didYouKnow', $data);
			$this->layout->twitter 			= View::make('frontend.sidebar.twitter');
			$this->layout->poll 			= View::make('frontend.sidebar.poll', $data);
			$this->layout->center 			= View::make('frontend.content.kviz', $data);
			
		} catch (Exception $e) {
			return App::abort(404);
		}
	}

	public function postKviz(){
		$rules = array(
			'kadsuculi' 	=> 'Required', 
			'vladar'		=> 'Required',
			'zgrada'		=> 'Required',
			'konasvoli'		=> 'Required', 
			'nikadniste'	=> 'Required', 
			'promene'		=> 'Required', 
			'stavoli'		=> 'Required', 
			'epsilon'		=> 'Required', 
			'clan'			=> 'Required', 
			'biliclan'		=> 'Required', 
		);

		$validator = Validator::make(Input::all(), $rules);

	    if ($validator->fails())
	    {
	        return Redirect::to(_l(URL::to('/').'/kviz'))->withErrors($validator)->withInput();
	    }
	    else{
	    	$kviz = new Kviz;
	    	$kviz->kadsuculi = Input::get('kadsuculi');
	    	$kviz->vladar = (is_array(Input::get('vladar'))) ? serialize(Input::get('vladar')) : '';
	    	$kviz->zgrada = Input::get('zgrada');
	    	$kviz->konasvoli = (is_array(Input::get('konasvoli'))) ? serialize(Input::get('konasvoli')) : '';
	    	$kviz->nikadniste = (is_array(Input::get('nikadniste'))) ? serialize(Input::get('nikadniste')) : '';
	    	$kviz->promene = Input::get('promene');
	    	$kviz->stavoli = (is_array(Input::get('stavoli'))) ? serialize(Input::get('stavoli')) : '';
	    	$kviz->epsilon = Input::get('epsilon');
	    	$kviz->biliclan = Input::get('biliclan');
	    	$kviz->clan = (is_array(Input::get('clan'))) ? serialize(Input::get('clan')) : '';
	    	$kviz->save();
	    	try {
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

				View::share('title', "Квиз | Пушкице");

				$ogimage = Config::get('settings.defaultImage');

				$meta = "	<meta property='og:image' content='".$ogimage."'/>
							<meta property='og:title' content='".__("Квиз | Пушкице")."'/>
							<meta property='fb:app_id' content='355697367892039'/>
							<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
							<meta property='og:type' content='article'/>
							<meta property='og:url' content='"._l(Request::root()."/kviz/")."'/>
							<meta property='og:description' content='".__("Квиз за ФОН-овце")."' />
							<meta name='twitter:card' content='summary_large_image'>
							<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
							<meta name='twitter:creator' content='@puskice'>
							<meta name='twitter:domain' content='puskice.org'>
							<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
							<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
							<meta name='twitter:title' content='".__("Квиз | Пушкице")."'>
							<meta name='twitter:description' content='".__("Квиз за ФОН-овце")."'>
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
								'kviz'			=> $kviz,
								'meta'			=> $meta);

				$this->setLayout2($data);
				
				$this->layout->boxes 			= View::make('frontend.boxes', $data);
				$this->layout->imageOfTheWeek	= View::make('frontend.sidebar.imageOfTheWeek', $data);
				$this->layout->didYouKnow 		= View::make('frontend.sidebar.didYouKnow', $data);
				$this->layout->twitter 			= View::make('frontend.sidebar.twitter');
				$this->layout->poll 			= View::make('frontend.sidebar.poll', $data);
				$this->layout->center 			= View::make('frontend.content.kvizKraj', $data);
				
			} catch (Exception $e) {
				return App::abort(404);
			}
	    }
	}

}
