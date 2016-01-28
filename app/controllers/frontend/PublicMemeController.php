<?php

class PublicMemeController extends BaseController {

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
	 * GET /frontend/publicmeme
	 *
	 * @return Response
	 */
	public function singleMeme($id)
	{
		try {
			$segments = explode("-", $id, 2);
			$permalink = end($segments);
			$id = (int)$id;
			$meme = MemeInstance::findOrFail($id);
			if($meme->permalink != $permalink)
				//App::abort(404);

			$image = Meme::findOrFail($meme->meme_id);
			$meme->view_count ++;
			$meme->save();

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

			View::share('title', $meme->first_line." | Пушкице");

			$meta = "<meta property='og:image' content='".Request::root()."/meme/decoder/".$meme->id."/".$meme->meme_id."/".urlencode(trim(htmlspecialchars_decode($meme->first_line)))."/".urlencode(trim(htmlspecialchars_decode($meme->second_line)))."' />
					<meta property='og:title' content='".__(mb_strtoupper($meme->first_line)." - Пушкице")."'/>
					<meta property='fb:app_id' content='355697367892039'/>
					<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
					<meta property='og:description' content='".__("Цео постер погледајте на сајту :)")."'/>
					<meta property='og:url' content='".Request::root()."/meme/".$meme->id."/".$meme->permalink."'/>
					<meta property='og:type' content='article'/>
					<meta name='twitter:card' content='photo'/>
					<meta name='twitter:domain' content='puskice.org'/>
					<meta name='twitter:site' content='@puskice'>
					<meta name='twitter:creator' content='@puskice'>
					<meta name='twitter:title' content='".Trans::_t(mb_strtoupper($meme->first_line))."'>
					<meta name='twitter:image' content='".Request::root()."/meme/decoder/".$meme->id."/".$meme->meme_id."/".urlencode(trim(htmlspecialchars_decode($meme->first_line)))."/".urlencode(trim(htmlspecialchars_decode($meme->second_line)))."' />";

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
							'meme'			=> $meme);

			$this->setLayout($data);
			$this->layout->center 			= View::make('frontend.content.meme', $data);
			
		} catch (Exception $e) {
			return App::abort(404);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /frontend/publicmeme/create
	 *
	 * @return Response
	 */
	public function memes($slug=null, $per_page="5")
	{
		if($slug != null){
			try{
				$meme = Meme::where('slug', '=', $slug)->firstOrFail();	
			}
			catch(Exception $e){
				App::abort(404);
			}
			$title = $meme->name." : Пушкице";
			
			$articles = MemeInstance::where('published', '=', 1)->where('meme_id', '=', $meme->id)->orderBy('created_at', 'desc')->paginate($per_page);
		}
		else{
			$title = "Меме генератор : Пушкице";
			$articles = MemeInstance::where('published', '=', 1)->orderBy('created_at', 'desc')->paginate($per_page);	
		}
		View::share('title', strip_tags($title));

		//$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
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

		$meta = "	<meta property='og:image' content='".Config::get('settings.defaultImg')."'/>
						<meta property='og:title' content='".__("Меме генератор | Пушкице | Тачка спајања студената ФОН-а")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/memes/")."'/>
						<meta property='og:description' content='".__("Меме генератор | Пушкице")."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__("Меме генератор | Пушкице")."'>
						<meta name='twitter:description' content='".__(strip_tags("Меме генератор"))."'>
						<meta name='twitter:image' content='".Config::get('settings.defaultImg')."'>";

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

		$this->setLayout($data);
		$this->layout->center			= View::make('frontend.content.memes', $data);


	}

	public function memedecode($id, $meme_id, $first_line, $second_line){

		try{
			$image = Meme::findOrFail($meme_id);
			$meme = MemeInstance::findOrFail($id);
		}
		catch(Exception $e){
			App::abort('404');
		}


		if(file_exists(PUBLIC_DIR.$image->img)){
			$font = PUBLIC_DIR.'assets/font/impact.ttf';
			$img = imagecreatefromjpeg(PUBLIC_DIR.$image->img);
			
			$white = imagecolorallocate($img, 255, 255, 255);
			$black = imagecolorallocate($img, 0, 0, 0);
			MemeGenerator::imagettftextoutline($img, 20, 0, 10, 45, $white, $black, $font, Trans::_t(mb_strtoupper(htmlspecialchars_decode(urldecode($meme->first_line)))), 2, 'up');
			MemeGenerator::imagettftextoutline($img, 20, 0, 10, 95, $white, $black, $font, Trans::_t(mb_strtoupper(htmlspecialchars_decode(urldecode($meme->second_line)))), 2, 'down');
			ob_start();
			imagejpeg($img);
			$data = base64_encode(ob_get_clean());

		}
		header("Content-Type: image/jpeg");
		echo base64_decode($data);
		//return Response::make("data:image/jpg;base64,".$data, 200, array('content-type' => 'image/jpg'));
	}

	public function newMeme()
	{
		$title = "Нови постер | Пушкице";
		View::share('title', strip_tags($title));
		$memes = Meme::all();
		Session::put('antispam1', rand(0, 20));
		Session::put('antispam2', rand(0, 20));

		//$articles = News::inCategories(Config::get('settings.homepage'))->where('published', '=', 2)->where('post_type', '=', 1)->where('news.created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('news.created_at', 'desc')->take(10)->get();
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

		$meta = "	<meta property='og:image' content='".Config::get('settings.defaultImg')."'/>
						<meta property='og:title' content='".__("Меме генератор | Пушкице | Тачка спајања студената ФОН-а")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/memes/new")."'/>
						<meta property='og:description' content='".__("Меме генератор | Пушкице")."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__("Меме генератор | Пушкице")."'>
						<meta name='twitter:description' content='".__(strip_tags("Меме генератор"))."'>
						<meta name='twitter:image' content='".Config::get('settings.defaultImg')."'>";

		$data = array(	
						'featured' 		=> $featured,
						'results' 		=> $results,
						'ourComment'	=> $ourComment,
						'magazine' 		=> $magazine,
						'featuredImage'	=> $featuredImage,
						'didYouKnow'	=> $didYouKnow,
						'feed' 			=> $feed,
						'poll'			=> $poll,
						'meta'			=> $meta,
						'memes'			=> $memes);

		$this->setLayout($data);
		$this->layout->center			= View::make('frontend.content.newMeme', $data);


	}

	/**
	 * Store a newly created resource in storage.
	 * POST /frontend/publicmeme
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
		        'first_line'    => 	'Required',
		        'second_line' 	=>	'Required',
		        'meme_id' 		=>	'Required'
		);
		$v = Validator::make(Input::all(), $rules);
		if($v->passes()){
			if(Input::get('antibot') == Session::get('antispam1') + Session::get('antispam2')){
				$base = Meme::findOrFail(Input::get('meme_id'));
				$meme = new MemeInstance;
				$meme->meme_id = strip_tags(Input::get("meme_id"));
				$meme->first_line = strip_tags(Input::get("first_line"));
				$meme->second_line = strip_tags(Input::get("second_line"));
				$akismet = new Akismet('http://www.puskice.org/', '5fa6e0236f7b');
				if(Session::get("id") != null){
					$meme->user_id = strip_tags(Session::get("id"));
					$user = User::find($meme->user_id);
					$akismet->setCommentAuthor($user->username);
					$akismet->setCommentAuthorEmail($user->email);
				}
				else{
					$meme->user_id = -1;
					$akismet->setCommentAuthor('anonymous');
					$akismet->setCommentAuthorEmail('anonymous@anonmail.com');
				}
				$meme->permalink = Puskice::url_slug(htmlspecialchars_decode($meme->first_line));
				$meme->published = 1;
				$meme->trashed = 0;
				$meme->view_count = 0;
				$meme->thumbs_up = 0;
				$meme->thumbs_down = 0;
				
				$akismet->setCommentAuthorURL("");
				$akismet->setCommentContent($meme->first_line." ".$meme->second_line);
				$akismet->setPermalink('http://www.puskice.org/meme/'.$meme->id.'-'.$meme->permalink);
				if($akismet->isCommentSpam()){
					return Redirect::to(Request::root()."/memes/new")->with('message', __("Систем каже да спамујете"))->with('notif', 'danger')->withInput();
				}
				$meme->save();
				Session::forget('antispam1');
				Session::forget('antispam2');
				return Redirect::to(Request::root()."/meme/".$meme->id."-".$meme->permalink);
			}
			else{
				return Redirect::to(Request::root()."/memes/new")->with('message', __("Нисте добро сабрали бројеве"))->with('notif', 'danger')->withInput();		
			}
			
		}
		else{
			return Redirect::to(Request::root()."/memes/new")->withErrors($v)->with('notif', 'danger');	
		}
	}

	/**
	 * Display the specified resource.
	 * GET /frontend/publicmeme/{id}
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
	 * GET /frontend/publicmeme/{id}/edit
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
	 * PUT /frontend/publicmeme/{id}
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
	 * DELETE /frontend/publicmeme/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}