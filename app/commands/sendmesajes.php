<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class sendmesajes extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'send:mesajes';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
		

		
		

		$turns=Message::with('mensajes')->where( 'fecha','>', Carbon::now()->addDay()->setTime(0, 0, 0))
				   ->where('fecha','<', Carbon::now()->addDays(2)->setTime(0, 0, 0))->get();
		
		
		//$turns=Message::where( 'fecha','>', Carbon::now()->setTime(0, 0, 0))
		//		   ->get();
		

			   
		foreach($turns as $tr)
		{
		 
		 $username=$tr->mensajes->username;	
		 $fecha=$tr->fecha;
		 $cliente=$tr->mcname;
		 $numtel=$tr->mcnumtel;
		 $body=$tr->mensaje;
		
		///////////////ENVIAR SMS////////////////////////////////////////
		
			//////////////////MENSAJE//////////////////////
			
			$dot=":";

			$mensaje= "$cliente$dot $body $username";

			echo $mensaje;
			echo "\n";
			$smsc = new SMSC('tusturnos', '1f4e2b54146e3481301bc8e44d79e093');
			
				
	             $smsc->addNumero($numtel);
				
				//////////////////////////SMS//////////////////////////////////	
			
				// Enviar SMS
				
				$smsc->setMensaje($mensaje);
			
				if ($smsc->enviar() )
				echo 'Mensaje enviado.';
				
		}


}
	}

	
	

