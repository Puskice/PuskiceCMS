<?php

class MemeInstance extends Eloquent {
	protected $table = 'meme_instances';
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function meme(){
    	return $this->belongsTo('Meme', 'meme_id');
    }

    public function user(){
    	return $this->belongsTo('User', 'user_id');
    }
}