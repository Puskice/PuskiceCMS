<?php

class Ps_surveyeval extends \Eloquent {
	protected $fillable = [];
	 protected $table = 'surveyevals';
	public function surveyentry()
	{
		return $this->belongsTo('Ps_surveyentry','surveyentry_id');
	}
	public function subject()
	{
		return $this->belongsTo('Subject','subject_id');
	}

}