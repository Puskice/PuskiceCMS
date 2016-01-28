<?php

class News extends Eloquent {
	protected $table = 'news';
	public $timestamps = true;
	use SoftDeletingTrait;

    public function publishedBy(){
    	return $this->belongsTo('User', 'published_by');
    }

    public function lastEdit(){
    	return $this->belongsTo('User', 'last_edited_by');
    }

    public function newsContacts(){
    	return $this->hasMany('NewsContact', 'news_id');
    }

    public function files(){
    	return $this->hasMany('Files', 'news_id')->orderBy('thumbs_up', 'desc');	
    }

    public function comments(){
    	return $this->hasMany('Comment', 'news_id');
    }

    public function subjects(){
    	return $this->hasMany('Subject', 'news_id');
    }

    public function newsCategories(){
    	return $this->hasMany('NewsCategory', 'news_id');
    }

    public static function inCategories($ids = array()){
        return static::leftJoin('news_categories_mm', 'news_categories_mm.news_id', '=', 'news.id')
        ->whereIn('news_categories_mm.category_id', $ids)->select(array('news.*', 'news_categories_mm.category_id', 'news_categories_mm.news_id'));
    }

    public static function inCategory($id){
        return static::select(DB::raw("ps_news.*"))->leftJoin('news_categories_mm', 'news_categories_mm.news_id', '=', 'news.id')
        ->where('news_categories_mm.category_id', $id);
    }
}