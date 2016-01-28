<?php

class ApiFileController extends BaseController {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * GET /api\apifile
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /api\apifile/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /api\apifile
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /api\apifile/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		try {
			$file = Files::findOrFail($id);
			$this->googleAnalytics('/files/show/'.$id);
			$file->download_count = $file->download_count + 1; 
			$file->save();
			return Redirect::to('http://www.puskice.org/'.str_replace('//www.puskice.org/', '', $file->url));
		} catch (Exception $e) {
			return App::abort(404);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /api\apifile/{id}/edit
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
	 * PUT /api\apifile/{id}
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
	 * DELETE /api\apifile/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getThumbsUp($id){
		try {
			$file = Files::where('id', $id)->firstOrFail();
			$file->thumbs_up ++;
			$file->save();
			$this->googleAnalytics('/files/thumbs-up/'.$id);
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['files'][$file->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили овај материјал")));
				}
			}
			$thumbs['files'][$file->id] = 'up';

			Cookie::queue('ps_thumbs', serialize($thumbs), '86400');
			$response = array(	'status' 		=> 'success', 
								'message' 		=> __("Хвала на труду. Ваш глас је забележен"),
								'thumbsUp' 		=> $file->thumbs_up,
								'thumbsDown'	=> $file->thumbs_down);
			return Response::json($response);

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

	public function getThumbsDown($id){
		try {
			$file = Files::where('id', $id)->firstOrFail();
			$this->googleAnalytics('/files/thumbs-down/'.$id);
			$file->thumbs_down ++;
			$file->save();
			$thumbs = array();
			if(Cookie::get('ps_thumbs')){
				$cookie = Cookie::get('ps_thumbs');
				$thumbs = unserialize($cookie);
				if(isset($thumbs['files'][$file->id])){
					return Response::json(array('status' => 'fail', 'message' => __("Већ сте оценили овај материјал")));
				}
			}
			$thumbs['files'][$file->id] = 'down';

			Cookie::queue('ps_thumbs', serialize($thumbs), '86400');
			$response = array(	'status' 		=> 'success', 
								'message' 		=> __("Хвала на труду. Ваш глас је забележен"),
								'thumbsUp' 		=> $file->thumbs_up,
								'thumbsDown'	=> $file->thumbs_down);
			return Response::json($response);

		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

}