<?php

/**
 * CLASE CONEXION
 */
class Conexion
{
	
	public $host;
	public $usuario;
	public $clave;
	public $bd;
	public $conector;

	function __construct()
	{
		$this->host = "localhost";
		$this->usuario = "root";
		$this->clave = "";
		$this->bd = "tabata";
		try {
			$this->conector = new mysqli($this->host,$this->usuario,$this->clave,$this->bd);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	function getHost(){
		return $this->host;
	}

	function getUsuario(){
		return $this->usuario;
	}

	function getClave(){
		return $this->clave;
	}

	function getBD(){
		return $this->bd;
	}

	function ejecutarConsulta($sql){
		try {
		  $datos = $this->conector->query($sql);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return $datos;
	}

	function cerrarConexion(){
		$this->conector->close();
	}
}

?>