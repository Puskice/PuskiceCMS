<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	public $timestamps = true;
	use SoftDeletingTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


	public function news(){
		return $this->hasMany('News', 'published_by');
	}

	public function comments(){
		return $this->hasMany('Comment', 'user_id');	
	}

	public function memeComments(){
		return $this->hasMany('MemeComment', 'user_id');
	}

	public function points(){
		return $this->hasMany('Point', 'user_id');
	}
}
