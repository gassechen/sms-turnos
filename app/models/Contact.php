<?php

class Contact extends Eloquent
{

	protected $guarded = array();

	public static $rules = array();




		public function contactos()
	{
		
		return $this->belongsTo('User', 'user_id');
	}



}