<?php        include 'Sms.php';

$smsc = new SMSC ('tusturnos', '1f4e2b54146e3481301bc8e44d79e093');
try
{

                /*
                // control extra
                if (!isset($_GET['controlinterno']) || $_GET['controlinterno'] != 'dk2?aDANDxe1!')
                        exit;   // no es un IPN autorizado
                */
                $mensaje=$smsc->getRecibidos();
                $count=count($mensaje);
                echo $count;

                foreach($mensaje as $key=>$val)

                {


                //$fechahora= $mensaje['fechahora'];
                //echo $key;
                echo $val['de'];echo "|";

                echo date('m-d-Y H:i',$val['fecha']);echo "|";
                //echo $val['mensaje'];
                echo "\n";

                }
                //mail('tucorreo@dominio.com', 'IPN recibido en SMSC', $mensaje);
        } catch (Exception $e) {

        }
?>
      
