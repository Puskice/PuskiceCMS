<?php

class Errormsg extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function parent(){
    	return $this->belongsTo('Errormsg', 'parent');
    }

    public function children(){
    	return $this->hasMany('Errormsg', 'parent');
    }
}