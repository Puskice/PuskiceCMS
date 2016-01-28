<?php

class PollVote extends Eloquent {
	protected $table = 'poll_votes';

	public function poll(){
		return $this->belongsTo('Poll', 'poll_id');
	}

	public function pollOption(){
		return $this->belongsTo('PollOption', 'option_id');
	}
}