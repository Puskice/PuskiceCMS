<?php

class Menu extends Eloquent {

	public $timestamps = false;
	protected $table = 'menus';

	public function items(){
		return $this->hasMany('MenuItem', 'menu_id')->orderBy('parent_id')->orderBy('ordering');
	}
}