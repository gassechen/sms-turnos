<?php

class Message extends Eloquent
{

	protected $guarded = array();

	public static $rules = array();




		public function mensajes()
	{
		
		return $this->belongsTo('User', 'user_id');
	}



}