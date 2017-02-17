<?php
class Base_de_datos {
	
	//atributos
	private $conexion;
	public $bbdd;
	private $respuesta;
	public $resultado;
	public $id_record;
	//metodos
	public function __construct($bbdd){
	$this->bbdd = $bbdd;	
	$this->conexion = new PDO("sqlite:$bbdd") or die ('No conexion con base de datos');
	$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		
	}
	
	public function obtener_conexion(){
		
		return $this->conexion;
	}
	
	
	public function autorizador($tipo,$tabla,$session_id){
		return true;
		if($tabla == "OFERTAS" || $session_id < "2")
			return false;
		if($tabla == "USUARIOS" || $session_id < "2")
			return false;
	
		return true;
	}
	
	public function consulta($consulta,$tipo,$tabla,$session_id){
		if ($this->autorizador($tipo,$tabla,$session_id))	
	$this->respuesta = $this->conexion->query($consulta);
	else exit();
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
