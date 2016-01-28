<?php

class ApiSubjectController extends BaseController {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * GET /api\apisubject
	 *
	 * @return Response
	 */
	public function getSpecific($semester = null, $department = null)
	{	
		$this->googleAnalytics('/subjects/specific/'.$semester.'/'.$department);
		$news = News::where('published', '=', 2)->where('post_type', '=', 3)->orderBy('created_at', 'desc')->paginate(20);
		if($semester != null && $department != null){
			$news = News::where('published', '=', 2)->where('post_type', '=', 3)->whereHas('subjects', function($q) use($semester, $department)
			{
			    $q->where('semester', '=', $semester)->where('department', $department);

			})->paginate(20);
		}
		foreach ($news as $key => $article) {
			$news[$key]->subjects;
		}

		return Response::json($news);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /api\apisubject/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /api\apisubject
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /api\apisubject/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getSingle($id)
	{
		try {
			$article = News::where('published', '=', 2)->where('post_type', '=', 3)->where('id', '=', $id)->firstOrFail();
			$article->subjects;
			$article->newsContacts;
			$article->files;
			$this->googleAnalytics('/subjects/single/'.$id);
			return Response::json($article);
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

	public function getThumbsUp($id){
		try {
			$valid_ip = Thumb::where('ip', '=', Puskice::getIP())->where('object_type', '=', 6)->where('object_id', '=', $id)->first();
			if($valid_ip != null){
				throw new Exception("Error valid IP", 1);
			}
			$news = News::findOrFail($id);
			$news->thumbs_up ++;
			$news->save();
			$thumb = new Thumb;
			$thumb->ip = Puskice::getIP();
			$thumb->object_id = $news->id;
			$thumb->object_type = 6;
			$thumb->save();
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['subject'][$news->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили ову вест")));
				}
			}
			$thumbs['subject'][$news->id] = 'up';

			Cookie::queue('ps_thumbs', serialize($thumbs), 2628000);
			return Response::json(array('status' => 'success', 'message' => _("Ваш глас је забележен. Хвала на труду"), 'thumbsUp' => $news->thumbs_up, 'thumbsDown' => $news->thumbs_down));

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail', 'message' => _("Већ сте оценили ову страницу")));
		}
	}

	public function getThumbsDown($id){
		try {
			$valid_ip = Thumb::where('ip', '=', Puskice::getIP())->where('object_type', '=', 6)->where('object_id', '=', $id)->first();
			if($valid_ip != null){
				throw new Exception("Error valid IP", 1);
			}
			$news = News::findOrFail($id);
			$news->thumbs_down ++;
			$news->save();
			$thumb = new Thumb;
			$thumb->ip = Puskice::getIP();
			$thumb->object_id = $news->id;
			$thumb->object_type = 6;
			$thumb->save();
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['subject'][$news->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили ову вест")));
				}
			}
			$thumbs['subject'][$news->id] = 'down';

			Cookie::queue('ps_thumbs', serialize($thumbs), 2628000);
			return Response::json(array('status' => 'success', 'message' => _("Ваш глас је забележен. Хвала на труду"), 'thumbsUp' => $news->thumbs_up, 'thumbsDown' => $news->thumbs_down));

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail', 'message' => _("Већ сте оценили ову страницу")));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /api\apisubject/{id}/edit
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
	 * PUT /api\apisubject/{id}
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
	 * DELETE /api\apisubject/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}