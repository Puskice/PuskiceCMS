<?php

class ApiContactController extends BaseController {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * GET /api\apicontact
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /api\apicontact/create
	 *
	 * @return Response
	 */
	public function getSingle($id)
	{
		try {
			$contact = Contact::where('published', 1)->where('id', $id)->firstOrFail();
			$this->googleAnalytics('/contacts/single/'.$id);
			return Response::json($contact);
			
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

	public function getMarks($contactId){
		try {
			$marks = Mark::where('people_id', $contactId)->where('published', 1)->paginate(20);
			$this->googleAnalytics('/contacts/marks/'.$contactId);
			return Response::json($marks);
			
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /api\apicontact
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /api\apicontact/{id}
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
	 * GET /api\apicontact/{id}/edit
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
	 * PUT /api\apicontact/{id}
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
	 * DELETE /api\apicontact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}