<?php

class ApiPageController extends BaseController {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$this->googleAnalytics('/pages');
		$news = News::where('published', '=', 2)->where('post_type', 2)->orderBy('created_at', 'desc')->paginate(20);

		return Response::json($news);
	}

	public function getSingle($id)
	{
		try {
			$news = News::where('post_type', 2)->where(function($query) use($id) {
                return $query->where('id', '=', $id)
                    ->orWhere('permalink', '=', $id);
            })->firstOrFail();
			$news->view_count ++;
			$news->save();
			$this->googleAnalytics('/pages/single/'.$id);
			return Response::json($news);
			
		} catch (Exception $e) {
			var_dump($e->getMessage());
			return Response::json(array('status' => 'fail'));
		}
	}

	public function getThumbsUp($id){
		try {
			$valid_ip = Thumb::where('ip', '=', Puskice::getIP())->where('object_type', '=', 5)->where('object_id', '=', $id)->first();
			if($valid_ip != null){
				throw new Exception("Error valid IP", 1);
			}
			$news = News::findOrFail($id);
			$news->thumbs_up ++;
			$news->save();
			$thumb = new Thumb;
			$thumb->ip = Puskice::getIP();
			$thumb->object_id = $news->id;
			$thumb->object_type = 5;
			$thumb->save();
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['page'][$news->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили ову вест")));
				}
			}
			$thumbs['page'][$news->id] = 'up';

			Cookie::queue('ps_thumbs', serialize($thumbs), 2628000);
			return Response::json(array('status' => 'success', 'message' => _("Ваш глас је забележен. Хвала на труду"), 'thumbsUp' => $news->thumbs_up, 'thumbsDown' => $news->thumbs_down));

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail', 'message' => _("Већ сте оценили ову страницу")));
		}
	}

	public function getThumbsDown($id){
		try {
			$valid_ip = Thumb::where('ip', '=', Puskice::getIP())->where('object_type', '=', 5)->where('object_id', '=', $id)->first();
			if($valid_ip != null){
				throw new Exception("Error valid IP", 1);
			}
			$news = News::findOrFail($id);
			$news->thumbs_down ++;
			$news->save();
			$thumb = new Thumb;
			$thumb->ip = Puskice::getIP();
			$thumb->object_id = $news->id;
			$thumb->object_type = 5;
			$thumb->save();
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['page'][$news->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили ову вест")));
				}
			}
			$thumbs['page'][$news->id] = 'down';

			Cookie::queue('ps_thumbs', serialize($thumbs), 2628000);
			return Response::json(array('status' => 'success', 'message' => _("Ваш глас је забележен. Хвала на труду"), 'thumbsUp' => $news->thumbs_up, 'thumbsDown' => $news->thumbs_down));

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail', 'message' => _("Већ сте оценили ову страницу")));
		}
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
