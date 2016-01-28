<?php

class Contact extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function newsContacts(){
    	return $this->hasMany('NewsContact', 'contact_id');
    }

    public function marks(){
    	return $this->hasMany('Mark', 'people_id');
    }
}