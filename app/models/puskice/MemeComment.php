<?php

class MemeComment extends Eloquent {
	protected $table = 'meme_comments';
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function meme(){
    	return $this->belongsTo('MemeInstance', 'news_id');
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