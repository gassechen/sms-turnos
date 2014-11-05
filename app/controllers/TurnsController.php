<?php

class TurnsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$user=Auth::user();
    	$userid=$user->id;
		// get all the turns
		//echo $userid;
		$turns = Turn::where('user_id','=',$userid)->get(array('id' ,'name' ,'email' ,'turn_level' ,'created_at' ,'updated_at' ,'numtel','fecha','notas'));
		
		// load the view and pass the turns
		return View::make('site.turns.index')
			->with('turns', $turns);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user=Auth::user();
    	$userid=$user->id;
		
		$contacts = Contact::where('user_id','=',$userid)->get(array('cname' ,'cemail' ,'cnumtel'));
		// load the create form (app/views/turns/create.blade.php)
		$matches = array();
		
		foreach($contacts as $contact){
	
		// Add the necessary "value" and "label" fields and append to result set
		$contact['value'] = $contact['cname'];
		$contact['label'] = "{$contact['cname']}, {$contact['cemail']} {$contact['cnumtel']}";
		$matches[] = $contact ;
		
		}

		$contacts=implode(",",$matches);
		
		

		return View::make('site.turns.create')->with('contacts',$contacts);
												
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
			'name'       => 'required',
			'email'      => 'required|email',
			
			'numtel'     => 'required|numeric',
			'fecha'      => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('turns/create')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			//$start_day_old = Input::get('fecha');
			//$fecha = date("yyyy-mm-dd hh:ii:ss", strtotime($start_day_old));

			$turn = new Turn;
			$turn->name       = Input::get('name');
			$turn->email      = Input::get('email');
			$turn->turn_level = 2;
			$turn->numtel 	  = Input::get('numtel');
			$turn->fecha      = Input::get('fecha');
			$turn->user_id	  =$userid;	
			$turn->save();


			///////////////ENVIAR SMS////////////////////////////////////////
			
			//////////////////MENSAJE//////////////////////
			

			$r=" Recuerde que el dia ";

			$f=date("d/m/y - H:i ", strtotime($turn->fecha));

			$t= "Tiene Turno con ";


			$mensaje= "$turn->name $r $f $t $username";



			
			$smsc = new SMSC ('tusturnos', '1f4e2b54146e3481301bc8e44d79e093');
			
				// Estado del servicio
				echo 'El estado del servicio es '.($smsc->getEstado()?'OK':'CAIDO').'. ';

				// Saldo
				echo 'Quedan: '.$smsc->getSaldo().' sms. ';
	
				// Enviar SMS
			$smsc->addNumero($turn->numtel);
			$smsc->setMensaje($mensaje);
			
			if ($smsc->enviar() )
				echo 'Mensaje enviado.';
				
			////////////////////////////////////////////////////////////
						
				//$dt=Carbon::parse($turn->fecha);
				//echo $dt;
				$dt1=Carbon::parse($turn->fecha)->subDay();
				//echo $dt1;
				$smsc->setFecha($dt1->timestamp);
				    if ($smsc->enviar() )
				echo 'Mensaje diferido enviado.';

			
			
			//////////////////////////SMS//////////////////////////////////	
			// redirect
			Session::flash('message', 'Ha creado correctamente turno!');
			return Redirect::to('turns');
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
		// get the turn
		$turn = Turn::find($id);

		// show the view and pass the turn to it
		return View::make('site.turns.show')
			->with('turn', $turn)
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
		// get the turn
		$turn = Turn::find($id);

		// show the edit form and pass the turn
		return View::make('site.turns.edit')
			->with('turn', $turn);
			
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
			'name'       => 'required',
			'email'      => 'required|email',
			
			
			'fecha'      => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('turns/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// store
			$turn = Turn::find($id);
			$turn->name       = Input::get('name');
			$turn->email      = Input::get('email');
			$turn->turn_level = 2;
			$turn->numtel 	  = Input::get('numtel');
			$turn->fecha      = Input::get('fecha');
			
			$turn->save();



			///////////////ENVIAR SMS////////////////////////////////////////
			
			//////////////////MENSAJE//////////////////////
			

			$r=" Recuerde que el dia ";

			$f=date("d/m/y - H:i ", strtotime($turn->fecha));

			$t= "Tiene Turno con ";
			

			$mensaje= "$turn->name $r $f $t $username";



			$smsc = new SMSC('tusturnos', '1f4e2b54146e3481301bc8e44d79e093');
			
				// Estado del servicio
				//echo 'El estado del servicio es '.($smsc->getEstado()?'OK':'CAIDO').'. ';

				// Saldo
				//echo 'Quedan: '.$smsc->getSaldo().' sms. ';
	
				// Enviar SMS
			$smsc->addNumero($turn->numtel);
			$smsc->setMensaje($mensaje);
			
			if ($smsc->enviar() )
				//echo 'Mensaje enviado.';
				////////////////////////////////////////////////////////////
						
				//$dt=Carbon::parse($turn->fecha);
				//echo $dt;
				$dt1=Carbon::parse($turn->fecha)->subDay();
				//echo $dt1;
				$smsc->setFecha($dt1->timestamp);
				    if ($smsc->enviar() )
				//echo 'Mensaje diferido enviado.';

			//////////////////////////SMS//////////////////////////////////	
			// redirect
			Session::flash('message', 'Ha actualizado correctamente turno!');
			return Redirect::to('turns');
			
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
		$turn = Turn::find($id);
		$turn->delete();

		// redirect
		Session::flash('message', 'Ha borrado correctamente turno!');
		return Redirect::to('turns');
	}

}
