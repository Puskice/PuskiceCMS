<?php

class Poll extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function pollOptions(){
    	return $this->hasMany('PollOption', 'poll_id');
    }

    public function votes(){
    	return $this->hasMany('PollVote', 'poll_id');
    }
}