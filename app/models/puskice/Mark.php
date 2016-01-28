<?php

class Mark extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function contact(){
    	return $this->belongsTo('Contact', 'people_id');
    }

    public function user(){
    	return $this->belongsTo('User', 'user_id');
    }
}