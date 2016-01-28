<?php

class Ps_surveys extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /ps_surveys
	 *
	 * @return Response
	 */
	public function index()
	{
		return "index page surveys";
	}

	public function backendPrepare(){
		$commentCount = Comment::where('published', '=', 0)->where('created_at', '>', date('Y-m-d H:i:s', strtotime('-30 days')))->count();
		$unpublishedComments = Comment::where('published', '=', 0)->where('created_at', '>', date('Y-m-d H:i:s', strtotime('-30 days')))->orderBy('created_at', 'desc')->take(10)->get();
		try {
			$admin = User::findOrFail(Session::get('id'));
			View::share('admin', $admin);
		} catch (Exception $e) {
			return Redirect::to('login')->with('message', Lang::get('login.error'))->with('notif', 'danger');
		}
		View::share('commentCount', $commentCount);
		View::share('unpublishedComments', $unpublishedComments);
	}


	public function setLayout(){
		$this->backendPrepare();


		$this->layout = View::make('backend.master');
		$this->layout->head = View::make('backend.head');
		$this->layout->header = View::make('backend.header');
		$this->layout->sidebar = View::make('backend.sidebar');
		$this->layout->footer = View::make('backend.footer');
		$this->layout->errorReporting = View::make('backend.errorReporting');
	}



	public function startform($id)
	{
		$survey = Ps_survey::where('active',1)->first();
		//check if survey exists
		if(is_null($survey) || $survey->id!=$id){
			$message = "Tražena anketa ne postoji ili nije aktivna.";
			return View::make('surveys.error')->with('message',$message);
		} else {

			return View::make('surveys.startform');
		}
		
	}


	public function preparebig()
	{
		$year = Input::get('godina');
		$department = Input::get('smer');
		$survey = Ps_survey::where('active',1)->first();
		$semester = 2*$year-2+$survey->semester;
		$dep = ($department<3) ? 0 : ($department-2);
		$predmeti = Ps_survey::getSubjects($semester,$dep);
		return View::make('surveys.bigform')->with(array('predmeti'=>$predmeti,'department'=>$dep,'semester'=>$semester));
	}


	public function submited()
	{

		$predmeti = Input::all();
		// var_dump($predmeti);
		// die();
		if(!array_key_exists('ans', $predmeti)){
			return View::make('surveys.error')->with('message',"Greška. Treba da popunite bar jedan predmet.");
		}

		try {
			DB::beginTransaction();

			$newEntry = new Ps_surveyentry;
			$newEntry->survey_id = $survey = Ps_survey::where('active',1)->first()->id;
			$newEntry->department = Input::get('department');
			$newEntry->semester = Input::get('semester');
			$newEntry->ip =Request::getClientIp();
			$newEntry->save();

			$predmeti = $predmeti['ans'];
			foreach ($predmeti as $predmetID => $ocene) {
				$newEval = new Ps_surveyeval;
				$newEval->result=implode(",", $ocene);
				$newEval->subject_id=$predmetID;
				$newEval->surveyentry_id=$newEntry->id;
				$newEval->save();
			}

			DB::commit();
			return View::make('surveys.success')->with(array('data'=>Input::all()['ans'], 'entry'=>$newEntry));

		} catch (\PDOException $e) {
			DB::rollBack();
			return View::make('surveys.error')->with('message',"Došlo je do neočekivane greške. Molimo vas da nam javite detalje na info@puskice.org.");

		}
	}


	public function checkpost(){
		$predmeti = Input::all();

		if(!array_key_exists('ans', $predmeti)){
			$success = false;
			// $err_data["d"] = "nistga";
			$message = array('success' => $success);
			return json_encode($message);
			// return View::make('surveys.error')->with('message',"Greška. Treba da popunite bar jedan predmet.");
		}


// //Check 
		$success = true;
		$err_data = array();
		$popunjeni = explode("x", Input::get('names'));
		$predmeti = $predmeti['ans'];
		foreach ($predmeti as $predmetID => $ocene) {
			if(in_array($predmetID."", $popunjeni)){
				$nepopounjeni = array();
				if (($key = array_search($predmetID, $popunjeni)) !== false) {
					unset($popunjeni[$key]);
				}
				for ($i=1; $i < 11; $i++) {

					if(!array_key_exists($i, $ocene)){
						$success= false;
						array_push($nepopounjeni, $i);
					}
				}
				$err_data[$predmetID] = $nepopounjeni;
			}
		}

		foreach ($popunjeni as $key => $predmetID) {
			if($predmetID!=""){
				$err_data[$predmetID] = array("1","2","3","4","5","6","7","8","9","10");
			}
		}
		
		try {
			DB::beginTransaction();

			$newEntry = new Ps_surveyentry;
			$newEntry->survey_id = $survey = Ps_survey::where('active',1)->first()->id;
			$newEntry->department = Input::get('department');
			$newEntry->semester = Input::get('semester');
			$newEntry->ip =Request::getClientIp();
			$newEntry->save();

			// $predmeti = $predmeti['ans'];
			foreach ($predmeti as $predmetID => $ocene) {
				$newEval = new Ps_surveyeval;
				$newEval->result=implode(",", $ocene);
				$newEval->subject_id=$predmetID;
				$newEval->surveyentry_id=$newEntry->id;
				$newEval->save();
			}

			DB::commit();
			// return View::make('surveys.success')->with(array('data'=>Input::all()['ans'], 'entry'=>$newEntry));

		} catch (\PDOException $e) {
		//	DB::rollBack();
			// return View::make('surveys.error')->with('message',"Došlo je do neočekivane greške. Molimo vas da nam javite detalje na info@puskice.org.");
			$success = false;
		}
		$message = array('success' => $success, 'errors'=>$err_data );
		return json_encode($message);
	}







	public function getReport1($id){
		if(Session::get('user_level') < Config::get('cms.viewMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}

		$this->setLayout();

		$surveyModel= new Ps_survey();
		$data = $surveyModel->prepareOverallResults();
		$questions = $surveyModel->questionSchema();
		// return View::make('surveys.results')->with(array('data'=>$data,'survey_questions'=>$questions));
		
		
		View::share('title', Lang::get('admin.surveyReport1'));
		View::share('data', $data);
		View::share('survey_questions', $questions);
		$this->layout->content = View::make('backend.surveys.report1');

	}


	public function getReport2($id){
		$this->setLayout();
		$surveyModel= new Ps_survey();
		$data = $surveyModel->prepareEntryResults($id);
		$smerovi = array('Prva godina','ISIT','Menadžment','Operacioni menadžment','Upravljanje kvalitetom');
		// return View::make('surveys.results2')->with(array('data'=>$data,'smerovi'=>$smerovi));
		
		View::share('title', Lang::get('admin.surveyReport2'));
		View::share('data', $data);
		View::share('smerovi', $smerovi);
		$this->layout->content = View::make('backend.surveys.report2');
	}

	public function getEntriesByDate($id){
		$surveyModel= new Ps_survey();
		$data = $surveyModel->prepareEntriesByDate($id);

		print json_encode($data);
	}



	public function getIndex()
	{
		if(Session::get('user_level') < Config::get('cms.viewMemes')){
			return Redirect::to(_l(URL::action('AdminHomeController@getIndex')))->with('message', Lang::get('admin.notPermitted'))->with('notif', 'warning');
		}
		$this->setLayout();
		$surveys= Ps_survey::all();
		View::share('title', Lang::get('admin.showSurveys'));
		View::share('surveys', $surveys);
		$this->layout->content = View::make('backend.surveys.index');
	}





	/**
	 * Show the form for creating a new resource.
	 * GET /ps_surveys/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ps_surveys
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /ps_surveys/{id}
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
	 * GET /ps_surveys/{id}/edit
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
	 * PUT /ps_surveys/{id}
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
	 * DELETE /ps_surveys/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}