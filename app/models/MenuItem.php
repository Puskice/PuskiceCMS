<?php

class MenuItem extends Eloquent {
	protected $table = 'menu_items';
	public $timestamps = false;

	public function menu(){
		return $this->belongsTo('Menu', 'menu_id');
	}

	public function children(){
		return $this->hasMany('MenuItem', 'parent_id');
	}

	public function parent(){
		return $this->belongsTo('MenuItem', 'parent_id');
	}
}