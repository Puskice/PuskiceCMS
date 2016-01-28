<?php

class Meme extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

	public function instances(){
		return $this->hasMany('MemeInstance', 'meme_id');
	}

}