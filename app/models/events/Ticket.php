<?php

class Ticket extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;

	public function product(){
		return $this->belongsTo('Product', 'product_id');
	}

	public function event(){
		return $this->belongsTo('Event', 'event_id');
	}

	
}