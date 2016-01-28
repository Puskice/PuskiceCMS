<?php

class Task extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

	public function assignedTo(){
		return $this->belongsTo('User', 'assigned_to');
	}

	public function assignedBy(){
		return $this->belongsTo('User', 'user_id');
	}

	public function thread(){
		return $this->belongsTo('Thread', 'thread_id');
	}
}