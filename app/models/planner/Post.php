<?php

class Post extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;


	public function user(){
		return $this->belongsTo('User', 'user_id');
	}

	public function user(){
		return $this->belongsTo('Thread', 'thread_id');
	}	
}