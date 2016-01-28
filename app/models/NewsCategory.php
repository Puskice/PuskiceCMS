<?php

class NewsCategory extends Eloquent {
	protected $table = 'news_categories_mm';
	public $timestamps = false;

	public function news(){
		return $this->belongsTo('News', 'news_id');
	}

	public function category(){
		return $this->belongsTo('Category', 'category_id');
	}
}