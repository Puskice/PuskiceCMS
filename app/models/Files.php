<?php

class Files extends Eloquent {
	protected $table = 'files';
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function news(){
    	return $this->belongsTo('News', 'news_id');
    }

    public function user(){
    	return $this->belongsTo('User', 'user_id');
    }
}