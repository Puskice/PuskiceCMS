<?php

class NewsContact extends Eloquent {
	protected $table = 'news_contacts_mm';
	use SoftDeletingTrait;

	public function news(){
		return $this->belongsTo('News', 'news_id');
	}

	public function contact(){
		return $this->belongsTo('Contact', 'contact_id');
	}
}