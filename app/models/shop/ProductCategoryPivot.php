<?php

class Shop/ProductCategoryPivot extends \Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

	public function product(){
		return $this->belongsTo('Product', 'product_id');
	}

	public function category(){
		return $this->belongsTo('ProductCategory', 'product_category_id');
	}
}