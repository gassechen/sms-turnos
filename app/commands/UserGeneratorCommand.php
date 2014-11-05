<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UserGeneratorCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'user:generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Generate a new user';

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
	
	$this->line('########################### U)suarios | E)quipos ##################################');
	
	$entrada=trim(fgets(STDIN));

	if($entrada=="U")
	{
	
	$this->line('Usuarios');
	
	$this->line('L)istar / A)lta / B)aja / E)dicion Usuarios');
	
	$entrada=trim(fgets(STDIN));
	
	switch($entrada)
	    {
		case "L":
				listar();
				break;
		case "A":
				
		    	alta();
				break;
		case "B":
		break;
		case "E":
					
					editar();


		break;
		
		default:
		break; 
	    }
	
	}
	
	
	if($entrada=="E")
	{

	$this->line('Equipos');
	
	$this->line('L)istar / A)lta / B)aja / E)dicion Equipo');
	
	$entrada=trim(fgets(STDIN));
	
	switch($entrada)
	    {
		case "A":
				$this->line('Alta de Equipos');
	
				$this->line('Alta de Equipos');
				$this->line('Tipo:| T)otem | G)enerador | C)ompresor | B)ombas | A)IB | R)edes ');
				
				$this->line('TOTEM');
				$this->line('T,Nº Equipo,Tipo BBa,Capacidad Lts,Tipo Producto,Prveedor,Ubcacion');
				$this->line('Generador');
				$this->line('G,Marca Generador,Marca Motor,Potencia Kva,Nº Equipo,Capacidad Lts,Ubcacion');
				$this->line('Generador');
				$this->line('G,Marca Compresor,Marca Motor,Potencia Kva,Nº Equipo,Capacidad Lts,Ubcacion');

				$this->line('||||||||||||||CARGA|||||||||||||||||||||||');
				$campos=fgets(STDIN);
				aequipos($campos);
				break;
		case "B":
		break;
		case "E":
		
		break;
		
		default:
		break; 
	    }
	
	
	
	
	}
	
	}
}
	


function listar()
{

$users = DB::table('users')->get();
				
				echo "|ID|USENAME\n";
				foreach ($users as $user)
				{	
					echo "| ";
					echo "$user->id";
					echo "|";
				    echo "$user->username";
				    echo"\n";
				    }				

}

function alta(){

				$this->line('Username:');
				$username=trim(fgets(STDIN));
				$this->line('Email:');
				$email=trim(fgets(STDIN));
				$this->line('Password:');
				$password=Hash::make(trim(fgets(STDIN)));


				$id = DB::table('users')->insertGetId(
  					  array('username' => $username, 'email' => $email,'password'=>$password,'confirmed'=>'1','created_at'=>new DateTime,'updated_at'=>new DateTime)
										);
}

function editar(){
				listar();
				echo "Userid:\n";
				$userid=trim(fgets(STDIN));
				echo "Email:\n";
				$email=trim(fgets(STDIN));
				echo "Password:\n";
				$password=Hash::make(trim(fgets(STDIN)));
				DB::table('users')->where('$id','=','userid')
								  ->update(array('username' => $userid, 'email' => $email,'password'=>$password,'confirmed'=>'1','created_at'=>new DateTime,'updated_at'=>new DateTime)

								  	);	



}


function aequipos($campos)
{
	
	
$equip = explode(",", $campos);
	
print_r($equip);

	if($equip[0]=="T")
		{

		echo "Insetr equipo a Usario \n";
		listar();
		echo "User ID:";
		$userid=trim(fgets(STDIN));
		echo "Listo\n";

		$id = DB::table('equips')->insertGetId(
  		  array('user_id' => $userid,'tipo' => 'Totem','numeroequipo' => $equip[1],'tipobba' => $equip[2],'capacidad' => $equip[3],'productotipo' => $equip[4],'varios' => $equip[5],'ubicacion' => $equip[6],'created_at'=>new DateTime,'updated_at'=>new DateTime)
				);

							}


}


/*
$equips = array(
  array('id' => '1',,'tipo' => 'Totem','marcam' => '','marcagc' => '','potencia' => '','numeroequipo' => 'T400','tipobba' => 'Electrica a piston','qh' => '','capacidad' => '2000','productotipo' => 'Floqulante RfC5t6y','numpozo' => '','varios' => '','ubicacion' => 'a 8 km de cutral co','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
  array('id' => '2','user_id' => '2','tipo' => 'Generador','marcam' => 'Caterpillar','marcagc' => 'G&E','potencia' => '12000kVA','numeroequipo' => 'G1243','tipobba' => '','qh' => '','capacidad' => '1000','productotipo' => '','numpozo' => '','varios' => '','ubicacion' => 'neuquen','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
  array('id' => '3','user_id' => '2','tipo' => 'Totem','marcam' => '','marcagc' => '','potencia' => '','numeroequipo' => 'T405','tipobba' => '','qh' => '','capacidad' => '1200','productotipo' => 'Floqulante RfC5t6y','numpozo' => '','varios' => '','ubicacion' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
  array('id' => '4','user_id' => '1','tipo' => 'Totem','marcam' => '','marcagc' => '','potencia' => '','numeroequipo' => 'T540','tipobba' => '','qh' => '','capacidad' => '1200','productotipo' => 'Floqulante RfC5t6y','numpozo' => '','varios' => '','ubicacion' => '','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00'),
  array('id' => '5','user_id' => '2','tipo' => 'Totem','marcam' => '','marcagc' => '','potencia' => '','numeroequipo' => 'T407','tipobba' => 'Electrica 1hp','qh' => '','capacidad' => '1500','productotipo' => 'Floqulante RfC5t6y','numpozo' => '','varios' => 'Champion','ubicacion' => '1244','created_at' => '0000-00-00 00:00:00','updated_at' => '0000-00-00 00:00:00')
);*/