<?php

class Comment extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function news(){
    	return $this->belongsTo('News', 'news_id');
    }

    public function user(){
    	return $this->belongsTo('User', 'user_id');
    }

    public function parent(){
    	return $this->belongsTo('Comment', 'parent_id');
    }

    public function children(){
        return $this->hasMany('Comment', 'parent_id');
    }
}