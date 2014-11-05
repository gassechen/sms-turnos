<?php

class Turn extends Eloquent
{

	protected $guarded = array();

	public static $rules = array();




		public function turnos()
	{
		
		return $this->belongsTo('User', 'user_id');
	}

	

}