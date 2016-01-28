<?php

class ApiNewsController extends BaseController {

	public function __construct(){

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$this->googleAnalytics('/news');
		$news = News::inCategories(Config::get('settings.homepage'))->where('post_type', '=', 1)->where('published', '=', 2)->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('created_at', 'desc')->paginate(20);
		foreach($news as $key => $article){
			$news[$key]->long_content = __($article->long_content);
			$news[$key]->short_content = __($article->short_content);
		}
		return Response::json($news);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCategories()
	{
		$id = Input::get('a');

		$news = News::whereHas('newsCategories', function($q) use($id)
		{
		    $q->whereIn('category_id', $id);

		})->where('post_type', 1)->orderBy('created_at', 'desc')->paginate(20);

		return Response::json($news);
	}

	public function getCategory($id)
	{
		$this->googleAnalytics('/news/category/'.$id);
		$news = News::inCategories(array($id))->where('post_type', '=', 1)->where('published', '=', 2)->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->distinct('permalink')->groupBy('news.id')->orderBy('created_at', 'desc')->paginate(20);
		/*$news = News::whereHas('newsCategories', function($q) use($id)
		{
		    $q->where('category_id', $id);

		})->where('post_type', 1)->orderBy('created_at', 'desc')->paginate(20);*/
		foreach($news as $key => $article){
			$news[$key]->long_content = __($article->long_content);
			$news[$key]->short_content = __($article->short_content);
		}
		return Response::json($news);
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
	public function getSingle($id)
	{
		try {
			$news = News::where('id', '=', $id)->where('post_type', '=', 1)->where('published', '=', 2)->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))->firstOrFail();
			$news->view_count ++;
			$news->save();
			$news->short_content = __($news->short_content);
			$news->long_content = __($news->long_content);
			$this->googleAnalytics('/news/single/'.$id);
			return Response::json($news);
			
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

	public function getThumbsUp($id){
		try {
			$this->googleAnalytics('/news/thumbs-up/'.$id);
			$valid_ip = Thumb::where('ip', '=', Puskice::getIP())->where('object_type', '=', 1)->where('object_id', '=', $id)->first();
			if($valid_ip != null){
				throw new Exception("Error valid IP", 1);
			}
			$news = News::findOrFail($id);
			$news->thumbs_up ++;
			$news->save();
			$thumb = new Thumb;
			$thumb->ip = Puskice::getIP();
			$thumb->object_id = $news->id;
			$thumb->object_type = 1;
			$thumb->save();
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['news'][$news->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили ову вест")));
				}
			}
			$thumbs['news'][$news->id] = 'up';

			Cookie::queue('ps_thumbs', serialize($thumbs), 2628000);
			return Response::json(array('status' => 'success', 'message' => _("Ваш глас је забележен. Хвала на труду"), 'thumbsUp' => $news->thumbs_up, 'thumbsDown' => $news->thumbs_down));

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail', 'message' => _("Већ сте оценили ову вест")));
		}
	}

	public function getThumbsDown($id){
		try {
			$this->googleAnalytics('/news/thumbs-down/'.$id);
			$valid_ip = Thumb::where('ip', '=', Puskice::getIP())->where('object_type', '=', 1)->where('object_id', '=', $id)->first();
			if($valid_ip != null){
				throw new Exception("Error valid IP", 1);
			}
			$news = News::findOrFail($id);
			$news->thumbs_down ++;
			$news->save();
			$thumb = new Thumb;
			$thumb->ip = Puskice::getIP();
			$thumb->object_id = $news->id;
			$thumb->object_type = 1;
			$thumb->save();
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['news'][$news->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили ову вест")));
				}
			}
			$thumbs['news'][$news->id] = 'down';

			Cookie::queue('ps_thumbs', serialize($thumbs), 2628000);
			return Response::json(array('status' => 'success', 'message' => _("Ваш глас је забележен. Хвала на труду"), 'thumbsUp' => $news->thumbs_up, 'thumbsDown' => $news->thumbs_down));

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail', 'message' => _("Већ сте оценили ову вест")));
		}
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

	public function postToLatin(){
		return Response::json(array('status' => 'success', 'response' => html_entity_decode(Trans::cir2lat(htmlspecialchars_decode(Trans::stripuj(Input::get('text')))),ENT_QUOTES, "UTF-8")));
	}

	public function postToCyrilic(){
		return Response::json(array('status' => 'success', 'response' => html_entity_decode(Trans::lat2cir(htmlspecialchars_decode(Trans::stripuj(Input::get('text')))),ENT_QUOTES, "UTF-8")));
	}

	public function homePage(){
		$this->layout = View::make('frontend.content.apiHome');
	}

}
