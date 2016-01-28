<?php

class ApiPollController extends \BaseController {

	public function __construct(){
		parent::__construct();
	}
	/**
	 * Display a listing of the resource.
	 * GET /api/apipoll
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /api/apipoll/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /api/apipoll
	 *
	 * @return Response
	 */
	public function getCurrent()
	{
		try {
			$this->googleAnalytics('/polls/current/');
			$poll = Poll::where('published', '=', '1')
			->where('end_date', '>', date("Y-m-d H:i:s", strtotime('now')))
			->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))
			->orderBy('created_at', 'desc')
			->firstOrFail();
			$poll->title = __($poll->title);
			foreach($poll->pollOptions as $key => $option){
				$poll->pollOptions[$key]->title = __($poll->pollOptions[$key]->title);
			}
			return Response::json(array('status' => 'success', 'poll' => $poll));
			
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

	/**
	 * Display the specified resource.
	 * GET /api/apipoll/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		try {
			$this->googleAnalytics('/polls/show/'.$id);
			$poll = Poll::where('published', '=', '1')->where('id', '=', $id)
			->where('end_date', '>', date("Y-m-d H:i:s", strtotime('now')))
			->where('created_at', '<', date("Y-m-d H:i:s", strtotime('now')))
			->firstOrFail();
			$poll->title = __($poll->title);
			foreach($poll->pollOptions as $key => $option){
				$poll->pollOptions[$key]->title = __($poll->pollOptions[$key]->title);
			}
			return Response::json(array('status' => 'success', 'poll' => $poll));
			
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

	public function getShowResults($id)
	{
		try {
			$this->googleAnalytics('/polls/show-results/'.$id);
			$poll = Poll::where('id', '=', $id)->firstOrFail();
			$poll->title = __($poll->title);
			foreach($poll->pollOptions as $key => $option){
				$poll->pollOptions[$key]->title = __($poll->pollOptions[$key]->title);
			}
			return Response::json(array('status' => 'success', 'poll' => $poll));
			
		} catch (Exception $e) {
			return Response::json(array('status' => 'fail'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /api/apipoll/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postCastVote()
	{
		$this->googleAnalytics('/polls/cast-vote/');
		$rules = array(
		        'poll_id'    	=> 'Required',
		        'option_id'		=> 'Required'
		);
		$v = Validator::make(Input::all(), $rules);
		if($v->passes()){
			$ip = Puskice::getIP();
			$vote = PollVote::where('poll_id', '=', Input::get("poll_id"))->where('ip_address', '=', $ip)->first();
			if($vote != null) 
				return Response::json(array('status' => 'fail', 'text' => __("Већ сте гласали на овој анкети. Хвала :)")));
			$vote = new PollVote;
			$vote->poll_id = strip_tags(Input::get("poll_id"));
			$vote->option_id = strip_tags(Input::get("option_id"));
			$vote->ip_address = $ip;
			$vote->save();
			$option = PollOption::find(Input::get("option_id"));
			$poll = Poll::find($option->poll_id);
			if($poll->published == 1){
				$option->vote_count = $option->vote_count + 1;
				$option->save();
				return Response::json(array('status' => 'success', 'text' => __("Хвала што сте гласали")));
			}
			return Response::json(array('status' => 'fail', 'text' => __("Хвала што покушавате да хакујете анкету :)")));
		}
		else{
			return Response::json(array('status' => 'fail', 'text' => __("Десила се грешка")));	
		}
	}

	public function getPollResults($id){
		try {
			$this->googleAnalytics('/polls/poll-results/'.$id);
			$poll = Poll::findOrFail($id);
			$poll_options = PollOption::where('poll_id', '=', $id)->orderBy('vote_count', 'asc')->get();
			foreach ($poll_options as $key => $option) {
				$poll_options[$key]->title = __($option->title);
			}
			$total_votes = PollOPtion::where('poll_id', '=', $id)->sum('vote_count');
			$response = array("status" => 'success', "poll" => $poll, "poll_options" => $poll_options, "total_votes" => $total_votes, "totalvotes" => "Укупно ".$total_votes." гласова");
			return Response::json($response);
			
		} catch (Exception $e) {
			return Response::json(array("status" => "success", "text" => __("Десила се грешка")));
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /api/apipoll/{id}
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
	 * DELETE /api/apipoll/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}