<?php

class ContactsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$user=Auth::user();
    	$userid=$user->id;
		// get all the contacts
		//echo $userid;
		$contacts = Contact::where('user_id','=',$userid)->get(array('id' ,'user_id' ,'cname' ,'cemail' ,'cdirection' ,'cnumtel','confirmed','ccategory'));
		
		// load the view and pass the turns
		return View::make('site.contacts.index')
			->with('contacts', $contacts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the create form (app/views/contacts/create.blade.php)
		return View::make('site.contacts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{


		$user=Auth::user();
    	$userid=$user->id;
    	$username=$user->username;
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'cname'       => 'required',
			'cemail'      => 'required|email',
			
			'cnumtel'     => 'required|numeric'
			
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('contacts/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			//$start_day_old = Input::get('fecha');
			//$fecha = date("yyyy-mm-dd hh:ii:ss", strtotime($start_day_old));

			$contact = new Contact;
			$contact->cname       = Input::get('cname');
			$contact->cemail      = Input::get('cemail');
			
			$contact->cnumtel 	  = Input::get('cnumtel');
			$contact->ccategory   = Input::get('ccategory');
			$contact->user_id	  =$userid;	
			$contact->save();


			
			// redirect
			Session::flash('message', 'Ha creado correctamente contacto!');
			return Redirect::to('contacts');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$user=Auth::user();
    
    	$username=$user->username;
		// get the contact
		$contact = Contact::find($id);

		// show the view and pass the contact to it
		return View::make('site.contacts.show')
			->with('contact', $contact)
			->with('username',$username);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// get the contact
		$contact = Contact::find($id);

		// show the edit form and pass the contact
		return View::make('site.contacts.edit')
			->with('contact', $contact);
			
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$user=Auth::user();
    	$userid=$user->id;
    	$username=$user->username;
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'cname'       => 'required',
			'cemail'      => 'required|email',
			
			'cnumtel'     => 'required|numeric'
			
			
			
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('contacts/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$contact = Contact::find($id);
			$contact->cname       = Input::get('cname');
			$contact->cemail       = Input::get('cemail');
			
			$contact->cnumtel 	  = Input::get('cnumtel');
			$contact->ccategory   = Input::get('ccategory');
			
			$contact->save();



			
			Session::flash('message', 'Ha actualizado correctamente contacto!');
			return Redirect::to('contacts');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		// delete
		$contact = Contact::find($id);
		$contact->delete();

		// redirect
		Session::flash('message', 'Ha borrado correctamente contacto!');
		return Redirect::to('contacts');
	}

}