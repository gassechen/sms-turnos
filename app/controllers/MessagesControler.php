<?php

class MessagesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$user=Auth::user();
    	$userid=$user->id;
		// get all the messages		//echo $userid;
		$messages = Message::where('user_id','=',$userid)->get(array('id' ,'mcname','mcnumtel' ,'mensaje','status','fecha','turn_level' ,'created_at' ,'updated_at'));
		
		// load the view and pass the turns
		return View::make('site.messages.index')
			->with('messages', $messages);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// load the create form (app/views/contacts/create.blade.php)
		$user=Auth::user();
    		$userid=$user->id;
		// get all the messages		//echo $userid;
		$contacts = Contact::where('user_id','=',$userid)->get(array('id' ,'user_id' ,'cemail','cname' ,'ccategory' ,'cdirection' ,'cnumtel','confirmed','created_at' ));
		
		// load the view and pass the turns
		return View::make('site.messages.create')
			->with('contacts', $contacts);

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
		
    	$id = Input::get('check');

    	$mensaje = Input::get('mensaje');
    	$fecha = Input::get('fecha');

		// validate
		// read more on validation at http://laravel.com/docs/validation
		
		$rules = array(
			'check'     => 'required',
			'mensaje'   => 'required'
			
			
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('messages/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			
			if (empty($fecha))
			{

				$fecha = Carbon::now()->toDateTimeString();
			}
			else {
				$fecha = Input::get('fecha');
				}

				///////////////////unzerialize////////////////////////////////
				$id=str_replace("check=","", $id);
				$id=str_replace("&",",", $id);
				
        	
				$arr=explode(",",$id);
				
			////////////////////////////////////////////////
        	
			
			$contact = Contact::find($arr);

			//return $contact;
			foreach($contact as $contac)
				{			
			$message = new Message;
			$message->mcname =$contac->cname; 

			$message->mcnumtel       =$contac->cnumtel ;
			
			$message->status        =0;
			$message->mensaje 	    = Input::get('mensaje');
			$message->fecha		=$fecha;
			$message->user_id	    =$userid;	
			$message->save();

				
			/////////////////////////////////////////////
			
			$smsc = new SMSC('tusturnos', '1f4e2b54146e3481301bc8e44d79e093');
			
			$smsc->addNumero($message->mcnumtel);
			
			$dot=":";
			
			$mens= "$contac->cname$dot $message->mensaje  $username";
			
			$smsc->setMensaje($mens);
			
			//if ($smsc->enviar() )
			//	echo 'Mensaje enviado.';
				


			///////////////////////PROGRAMADO/////////////////////////////////////
				
				
				$dt1=Carbon::parse($message->fecha);
				

				$smsc->setFecha($dt1->timestamp);
					if ($smsc->enviar() )
				echo 'Mensaje diferido enviado.';

			//////////////////////////SMS//////////////////////////////////			
			}
			
			// redirect
			Session::flash('message', 'Ha creado correctamente su SMS!');
			return Redirect::to('messages');
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
		$contact = Message::find($id);

		// show the edit form and pass the contact
		return View::make('site.messages.edit')
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
			'cemail'      => 'required|email'
			
			
			
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
			$contact->email      = Input::get('cemail');
			
			$contact->numtel 	  = Input::get('cnumtel');
			
			
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
		$contact = Message::find($id);
		$contact->delete();

		// redirect
		Session::flash('message', 'Ha borrado correctamente tu mensaje!');
		return Redirect::to('messages');
	}


	
    
    

}
