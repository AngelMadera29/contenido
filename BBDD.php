<?php
class Base_de_datos{
	
	//atributos
	private $conexion;
	public $bbdd;
	private $respuesta;
	public $resultado;
	//metodos
	public function __construct($bbdd){
	$this->bbdd = $bbdd;
		
	$this->conexion = new PDO ("sqlite:$bbdd") or die ('No conexion con base de datos');
	$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		
	}
	
	public function obtener_conexion(){
		
		return $this->conexion;
	}
	
	
	public function consulta($consulta,$tipo,$tabla,$session_id){
		
	$this->respuesta = $this->conexion->query($consulta);
	
	}
	public function obtener_resutado($opciones){
	$this->resultado = $this->respuesta->fetch($opciones);
	return $this->resultado;
	}
	
	
}                     
   
   
  ?>