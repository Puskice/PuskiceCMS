<?php

class Product extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

	public function children(){
		return $this->hasMany('Product', 'parent_id');
	}

	public function parent(){
		return $this->belongsTo('Product', 'parent_id');
	}

	public function categories(){
		return $this->hasMany('ProductCategoryPivot', 'product_id');
	}

	public function event(){
		return $this->belongsTo('Event', 'event_id');
	}
}