<?php

class Thread extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

	public function user(){
		return $this->belongsTo('User', 'user_id');
	}

	public function tasks(){
		return $this->hasMany('Task', 'thread_id');
	}

	public function posts(){
		return $this->hasMany('Posts', 'thread_id');
	}
}