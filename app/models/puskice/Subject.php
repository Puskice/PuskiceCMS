<?php

class Subject extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function news(){
    	return $this->belongsTo('News', 'news_id');
    }
}