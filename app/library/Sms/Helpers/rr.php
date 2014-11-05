<?php include "Sms.php";

$smsc = new SMSC ('tusturnos', '1f4e2b54146e3481301bc8e44d79e093');
try
{
  // Estado del servicio
  echo 'El estado del servicio es '.($smsc->getEstado ()? 'OK' : 'CAIDO').
    '. ';

  // Saldo
  echo 'Quedan: '.$smsc->getSaldo ().' sms. ';

  // Enviar SMS


        $fecha=strtotime("+1 week");

        $numero = "2994060571";

        $mens = "hola nanananananan";





        $smsc->addNumero ($numero);

        $smsc->setMensaje ($mens);




         if ($smsc->enviar ())
        echo 'Mensaje enviado.';


        $smsc->setFecha ($fecha);
         if ($smsc->enviar ())
         if ($smsc->enviar ())
        echo 'Mensaje enviado.';


        $smsc->setFecha ($fecha);
         if ($smsc->enviar ())
        echo 'Mensaje programado enviado.';



        }

  catch (Exception $e)
  {
    echo 'Error '.$e->getCode ().': '.$e->getMessage ();
  }
?>
~        
