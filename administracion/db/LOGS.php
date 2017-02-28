<?php
class registros {
	
	//atributos
	private $conexion;
	public $logs;
	private $respuesta;
	public $resultado;
	public $id_record;
	//metodos
	public function __construct($logs){
	$this->bbdd = $logs;	
	$this->conexion = new PDO ("sqlite:$logs") or die ('No conexion con base de datos');
	$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		
	}
	
	public function obtener_conexion(){
		
		return $this->conexion;
	}
	
	
	public function consulta($consulta){
		
	$this->respuesta = $this->conexion->query($consulta);
	
	}
	
	public function obtener_resutado($opciones){
	$this->resultado = $this->respuesta->fetch($opciones);
	return $this->resultado;
	
	}
	public function resultado_completo($opciones){
	$this->resultado = $this->respuesta->fetchAll($opciones);
	return $this->resultado;
	}
	
	public function resultado_id($consulta){
	$this->id_record = $this->conexion->lastInsertId();
	return $this->id_record;
	}
	
}                     
   
   
  ?>