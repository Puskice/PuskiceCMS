<?php

class PublicContactController extends BaseController {

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
		$this->layout->banner300 		= View::make('frontend.sidebar.banner300');
		$this->layout->facebook 		= View::make('frontend.sidebar.facebook');
		$this->layout->search 			= View::make('frontend.sidebar.search');
		$this->layout->error 			= View::make('frontend.errorReporting', $data);
		/*$this->layout->newsTicker 		= View::make('frontend.newsTicker', $data);*/
	}

	/**
	 * Display a listing of the resource.
	 * GET /frontend/publiccontact
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /frontend/publiccontact/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /frontend/publiccontact
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /frontend/publiccontact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try{
			$contact = Contact::findOrFail($id);

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

			View::share('title', $contact->title." ".$contact->first_name." ".$contact->last_name." | Пушкице | Тачка спајања студената ФОН-а");

			$ogimage = Puskice::firstContactImage($contact);

			$meta = "	<meta property='og:image' content='".$ogimage."'/>
						<meta property='og:title' content='".__($contact->title." ".$contact->first_name." ".$contact->last_name." | Пушкице | Тачка спајања студената ФОН-а")."'/>
						<meta property='fb:app_id' content='355697367892039'/>
						<meta property='og:site_name' content='".__("Пушкице - ФОН Андерграунд")."'/>
						<meta property='og:type' content='article'/>
						<meta property='og:url' content='"._l(Request::root()."/ljudi/".$contact->id)."'/>
						<meta property='og:description' content='".__($contact->description)."' />
						<meta name='twitter:card' content='summary_large_image'>
						<meta name='twitter:site' content='".__("Пушкице - ФОН Андерграунд")."'>
						<meta name='twitter:creator' content='@puskice'>
						<meta name='twitter:domain' content='puskice.org'>
						<meta name='twitter:app:name:iphone' content='".__("Пушкице")."'>
						<meta name='twitter:app:name:ipad' content='".__("Пушкице")."'>
						<meta name='twitter:title' content='".__($contact->title." ".$contact->first_name." ".$contact->last_name." | Пушкице")."'>
						<meta name='twitter:description' content='".__($contact->description)."'>
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
							'contact'		=> $contact);

			$this->setLayout($data);
			$this->layout->center 			= View::make('frontend.content.contact', $data);
		}
		catch(Exception $e){
			App::abort(404);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /frontend/publiccontact/{id}/edit
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
	 * PUT /frontend/publiccontact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function oceni($id)
	{
		try {
			if(!Session::get('id')){
				return Redirect::to(Request::root().'/login?ref='.rawurlencode("ljudi/".$id));
			}
			else{
				$contact = Contact::findOrFail($id);
				$update = false;
				try {
					$mark = Mark::where('people_id', '=', $id)->where('user_id', '=', Session::get('id'))->firstOrFail();
					$update = true;
				} catch (Exception $e) {
					$mark = new Mark();	
				}
				$mark->user_id = Session::get('id');
				$mark->people_id = $id;
				$mark->uskladjenost 		= Input::get('uskladjenost');
				$mark->jasnost				= Input::get('jasnost');
				$mark->interakcija 			= Input::get('interakcija');
				$mark->komunikacija 		= Input::get('komunikacija');
				$mark->konflikt 			= Input::get('konflikt');
				$mark->inspiracija 			= Input::get('inspiracija');
				$mark->aktivnost 			= Input::get('aktivnost');
				$mark->kvalitet_literature 	= Input::get('literatura');
				$mark->student_relations 	= Input::get('odnos');
				$avg = ($mark->uskladjenost + $mark->jasnost + $mark->interakcija + $mark->komunikacija +
						(11 - $mark->konflikt) + $mark->inspiracija + $mark->aktivnost + $mark->kvalitet_literature +
						$mark->student_relations)/9;
				$mark->total_impression 	= $avg;
				$mark->note 				= Input::get('komentar');
				$mark->save();

				$mark_count = Mark::where('people_id', '=', $id)->count();
				$contact->mark_count ++;

				$contact->uskladjenost = ($contact->uskladjenost * ($mark_count-1) + $mark->uskladjenost) / $mark_count;
				$contact->jasnost = ($contact->jasnost * ($mark_count-1) + $mark->jasnost) / $mark_count;
				$contact->interakcija = ($contact->interakcija * ($mark_count-1) + $mark->interakcija) / $mark_count;
				$contact->komunikacija = ($contact->komunikacija * ($mark_count-1) + $mark->komunikacija) / $mark_count;
				$contact->konflikt = ($contact->konflikt * ($mark_count-1) + $mark->konflikt) / $mark_count;
				$contact->inspiracija = ($contact->inspiracija * ($mark_count-1) + $mark->inspiracija) / $mark_count;
				$contact->aktivnost = ($contact->aktivnost * ($mark_count-1) + $mark->aktivnost) / $mark_count;
				$contact->kvalitet_literature = ($contact->kvalitet_literature * ($mark_count-1) + $mark->kvalitet_literature) / $mark_count;
				$contact->student_relations = ($contact->student_relations * ($mark_count-1) + $mark->student_relations) / $mark_count;
				$contact->total_impression = ($contact->total_impression * ($mark_count-1) + $mark->total_impression) / $mark_count;
				$contact->save();
				if($update){
					return Redirect::to(Request::root().'/ljudi/'.$id)->with('notif', 'success')->with('message', __("Оцена предавача ажурирана"));	
				}
				return Redirect::to(Request::root().'/ljudi/'.$id)->with('notif', 'success')->with('message', __("Успешно сте оценили предавача"));
			}
		} catch (Exception $e) {
			return Redirect::to(Request::root().'/ljudi/'.$id)->with('notif', 'danger')->with('message', __("Одабрани предавач не постоји"));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /frontend/publiccontact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}