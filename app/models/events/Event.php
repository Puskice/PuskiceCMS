<?php

class Event extends Eloquent {
	public $timestamps = true;
	use SoftDeletingTrait;
}