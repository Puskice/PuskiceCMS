<?php

class PollOption extends Eloquent {
	protected $table = 'poll_options';
	public $timestamps = false;

	public function poll(){
		return $this->belongsTo('Poll', 'poll_id');
	}

	public function votes(){
		return $this->hasMany('PollVote', 'option_id');
	}

}