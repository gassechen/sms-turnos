<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class sendturnos extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'send:turnos';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send A sms Crontab.';

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
		
			

		$turns=Turn::with('turnos')->where( 'fecha','>', Carbon::now()->addDay()->setTime(0, 0, 0))
				   ->where('fecha','<', Carbon::now()->addDays(2)->setTime(0, 0, 0))->get();
		
		//$turns=Turn::where( 'fecha','>', Carbon::now()->addDay()->setTime(0, 0, 0))
		//		   ->where('fecha','<', Carbon::now()->addDays(2)->setTime(0, 0, 0))->get();
		

			   
		foreach($turns as $tr)
		{
		 
		 $username=$tr->turnos->username;	
		 $fecha=$tr->fecha;
		 $cliente=$tr->name;
		 $numtel=$tr->numtel;
		
		
		
		///////////////ENVIAR SMS////////////////////////////////////////
			
			//////////////////MENSAJE//////////////////////
			

			$r=" Recuerde que el dia ";

			$f=date("d/m/y - h:i ", strtotime($fecha));

			$t= "Tiene Turno con ";


			$mensaje= "$cliente $r $f $t $username";



			$smsc = new SMSC('tusturnos', '1f4e2b54146e3481301bc8e44d79e093');
			
				// Enviar SMS
				$smsc->addNumero($numtel);
				$smsc->setMensaje($mensaje);
			
			if ($smsc->enviar() )
				echo 'Mensaje enviado.';
				

			//////////////////////////SMS//////////////////////////////////	
			
                        	   
                     

	}


}

}

