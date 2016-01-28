<?php

class Ps_surveyentry extends \Eloquent {
	protected $fillable = [];
	 protected $table = 'surveyentries';
	 public function surveyevals()
    {
        return $this->hasMany('Ps_surveyeval','surveyentry_id');
    }

   
}