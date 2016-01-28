<?php

class ProductCategory extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

	public function products(){
		return $this->hasMany('ProductCategoryPivot', 'product_category_id');
	}
}