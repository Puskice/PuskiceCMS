<?php

class Point extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function user(){
    	return $this->belongsTo('User', 'user_id');
    }
}