<?php
/**
 * SMSC Api
 *
 * @author Pablo Gabriel Reyes
 * @link http://www.pabloreyes.com.ar/ Blog personal
 * @link http://www.reyesoft.com/ Reyesoft
 * @license http://creativecommons.org/licenses/by-sa/2.5/ar/ Creative Commons Attribution-Share Alike 2.5
 * @version 0.1.10
 */

class SMSC
{
	/**
	 * @var string ApiKey de SMSC
	 */
	private $apikey = '';

	/**
	 * @var string Alias de SMSC
	 */
	private $alias = '';

	private $mensaje = '';

	private $return = '';
	
	private $fecha = '';
	public function  __construct($alias = null, $apikey = null) {
		if ($alias !== null)
			$this->setAlias ($alias);
		if ($apikey !== null)
			$this->setApikey ($apikey);

	}

	public function getApikey()
	{
	 return $this->apikey;
	}
	public function setApikey($apikey)
	{
	 $this->apikey = $apikey;
	}

	public function getAlias()
	{
	 return $this->alias;
	}
	public function setAlias($alias)
	{
	 $this->alias = $alias;
	}


	public function getData()
	{
		return $this->return['data'];
	}

	public function getStatusCode()
	{
		return $this->return['code'];
	}

	public function getStatusMessage()
	{
		return $this->return['message'];
	}

	public function exec($cmd = null, $extradata = null)
	{
		$this->return = null;

		// construyo la URL de consulta
		$url = 'http://www.smsc.com.ar/api/0.2/?alias='.$this->alias.'&apikey='.$this->apikey;
		$url2 = '';
		if ($cmd !== null)
			$url2 .= '&cmd='.$cmd;
		if ($extradata !== null)
			$url2 .= $extradata;

		// hago la consulta
		$data = @file_get_contents($url.$url2);
		if ($data === false)
		{
			throw new Exception('No se pudo conectar al servidor.', 1);
			return false;
		}
		$ret = json_decode($data, true);
		if (!is_array($ret))
		{
			throw new Exception('Datos recibidos, pero no han podido ser reconocidos ("'.$data.'") (url2='.$url2.').', 2);
			return false;
		}
		$this->return = $ret;
		return true;
	}


	/**
	 * Estado del sistema SMSC.
	 * @return bool Devuelve true si no hay demoras en la entrega.
	 */
	public function getEstado()
	{
		$ret = $this->exec('estado');
		if (!$ret)
			return false;
		if ($this->getStatusCode() != 200)
		{
			 throw new Exception($this->getStatusMessage(), $this->getStatusCode());
			 return false;
		} else {
			$ret = $this->getData();
			return $ret['estado'];
		}
	}


	/**
	 * Validar n�mero
	 * @return bool Devuelve true si es un n�mero v�lido.
	 */
	public function evalNumero($prefijo, $fijo = null)
	{
		$ret = $this->exec('evalnumero', '&num='.$prefijo.($fijo === null?'':'-'.$fijo));
		if (!$ret)
			return false;
		if ($this->getStatusCode() != 200)
		{
			 throw new Exception($this->getStatusMessage(), $this->getStatusCode());
			 return false;
		} else {
			$ret = $this->getData();
			return $ret['estado'];
		}
	}


	/**
	 *
	 * @return array
	 */
	public function getSaldo()
	{
		$ret = $this->exec('saldo');
		if (!$ret)
			return false;
		if ($this->getStatusCode() != 200)
		{
			throw new Exception($this->getStatusMessage(), $this->getStatusCode());
			return false;
		} else {
			$ret = $this->getData();
			return $ret['mensajes'];
		}
	}


	/**
	 *
	 * @param int $prioridad 0:todos 1:baja 2:media 3:alta
	 * @return array
	 */
	public function getEncolados($prioridad = 0)
	{
		$ret = $this->exec('encolados', '&prioridad='.intval($prioridad));
		if (!$ret)
			return false;
		if ($this->getStatusCode() != 200)
		{
			throw new Exception($this->getStatusMessage(), $this->getStatusCode());
			return false;
		} else {
			$ret = $this->getData();
			return $ret['mensajes'];
		}
	}


	/**
	 * *******************************************
	 * *******   Metodos para enviar SMS   *******
	 * *******************************************
	 */

	/**
	 * @param integer $prefijo	Prefijo del �rea, sin 0
	 *					Ej: 2627 � 2627530000
	 * @param integer $fijo N�mero luego del 15, sin 15
	 *					Si s�lo especifica prefijo, se tomar� como n�mero completo (no recomendado).
	 *					Ej: 530000
	 */
	public function addNumero($prefijo, $fijo = null)
	{
		if ($fijo === null)
			$this->numeros[] = $prefijo;
		else
			$this->numeros[] = $prefijo.'-'.$fijo;
	}

	public function getMensaje()
	{
		return $this->mensaje;
	}
	public function setMensaje($mensaje)
	{
		$this->mensaje = $mensaje;
	}
	
	public function setFecha($fecha)
	{
	    $this->fecha = $fecha;
	
	}

	public function enviar()
	{
		$ret = $this->exec('enviar', '&num='.implode(',', $this->numeros).'&msj='.urlencode($this->mensaje).'&time='.urlencode($this->fecha));
		if (!$ret)
			return false;
		if ($this->getStatusCode() != 200)
		{
			 throw new Exception($this->getStatusMessage(), $this->getStatusCode());
			 return false;
		} else {
			return $this->getData();
		}
	}


	/**
	 * ***********************************************
	 * *******  Metodos para hacer consultas   *******
	 * ***********************************************
	 */

	/**
	 * Devuelve los �ltimos 30 SMSC recibidos.
	 * 
	 * Lo �ptimo es usar esta funci�n cuando se recibe la notificaci�n, que puede
	 * especificar en http://www.smsc.com.ar/usuario/api/
	 * 
	 * @param int $ultimoid si se especifica, el sistema s�lo devuelve los SMS
	 *						m�s nuevos al sms con id especificado (acelera la
	 *						consulta y permite un chequeo r�pido de nuevos mensajes)
	 */
	public function getRecibidos($ultimoid = 0)
	{
		$ret = $this->exec('recibidos', '&ultimoid='.(int)$ultimoid);
		if (!$ret)
			return false;
		if ($this->getStatusCode() != 200)
		{
			 throw new Exception($this->getStatusMessage(), $this->getStatusCode());
			 return false;
		} else {
			return $this->getData();
		}
	}

}

