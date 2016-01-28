<?php

class Category extends Eloquent {
	protected $table = 'categories';
	public $timestamps = true;
	use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    public function newsCategories(){
    	return $this->hasMany('NewsCategory', 'category_id');
    }

    public function parent(){
    	return $this->belongsTo('Category', 'parent_id');
    }

    public function children(){
        return $this->hasMany('Category', 'parent_id');
    }
}