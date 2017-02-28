<?php
class Autorizador{
	
public function autorizar($seccion,$objeto,$contenido,$session_id){
	//SECCION = apartado o ubicacion en donde se mostrara el contenido.
	//OBJETO = ubicacion en donde se encuentra el contenido a mostrar.
	//CONTENIDO = el dato o el valor que se desea mostrar si cumple con los parametros. 
	//SESSION_ID = identificador unico para cada usuario.
	//esta seccion muestra unicamente las opciones de respaldo y lista de ususrios
	if($seccion == "index" && $objeto == "listas" && $session_id >= 2)
		echo $contenido;	
	//esta seccion se encarga de mostrar unicamente el listado de logs para usuarios de nivel administrador 	
	if($seccion == "logs" && $objeto == "logs" && $session_id == 3 )
		echo $contenido;
	//esta seccion se encarga de mostrar o no las consulta de registros de usuarios nivel 1 o inferior
	if($seccion == "ofertas" && $objeto == "SELECT" && $session_id >2)
		//return true;
	//esta seccion se encarga de mostrar el id en el formulario de ofertas, mostrando este unicamente para usuarios de nivel 2> 
	if($seccion == "ofertas" && $objeto == "id" && $session_id >=2)
		echo $contenido;
	//esta seccion se encarga de mostrar el boton de eliminar oferta si en usuario esta registrado y si es mayor= que 2				
	if($seccion == "ofertas" && $objeto == "botones" && $session_id >= 2)
		echo $contenido;
	//esta seccion se encarga de mostrar el boton de usuarios agregar y eliminar en caso de ser usuario mayor nivel 2			
	if($seccion == "usuarios" && $objeto == "botones" && $session_id >= 2)
		echo $contenido;		
		//seccion encargada de mostrar la consulta completa en caso de ser un nivel superior a 1 o 2
	if ($seccion == "ofertas" && $objeto == "consulta" && $session_id >= 2)
		return $contenido;
	//esta seccion se encarga de regresar la consulta con un comparador en caso de ser un usuario de nivel inferior a 2	
	if ($seccion == "ofertas" && $objeto == "consulta" && $session_id < 2)
	 	$usuario = $_SESSION['id'];
		$consulta = "WHERE id_usuario = $usuario";
		return $contenido." ".$consulta;				
	
				
	}
}	
	
	
class REGISTROS{
	
	private $conexion_registro;
	private $bbdd;
	private $bbdd_registros;
	private $respuesta_registros;
	private $registro_query;
	
	public function __construct($bbdd,$bbdd_registros){	
	$this->bbdd_registros = $bbdd_registros;		
	$this->conexion_registro = new PDO("sqlite:$this->bbdd_registros") or die ('No conexion con base de datos');
	$this->conexion_registro ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->conexion_registro ->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	
	$this->bbdd = $bbdd;	
	}

	public function conexion_registros(){
		
		return $this->conexion_registro;
	}
	private function consulta_registro($registro_query)
	{
		try
		{
			$this->respuesta_registro = $this->conexion_registro->query($registro_query);
		}
		catch (PDOException $e) 
		{
			echo $e->getMessage()." Error de base de datos: $registro_query";
		}
		
	}
	//TIPO ES LA ACCIÓN REALIZADA (SELECT,UPDATE...)
	//LA TABLA EN LA QUE SE HACE LA CONSULTA
	//SESSION_ID EL NIVEL DEL USUARIO QUE REALIZA LA CONSULTA
	public function registro($consulta,$tipo,$tabla,$session_id){ 
	if($this->bbdd->consulta_no_controlada("select * from preferencias where accion='$tipo' and tabla = '$tabla' and nivel = ".$_SESSION['nivel'],$tipo,$tabla,$session_id)){
			$usuario = $_SESSION['nombre'];
		
			$now = gmdate('d-m-y H:i:s', time() - 3600 * 5);	
			//if($session_id())
			$registro_query = "INSERT INTO logs (`id`,`usuario`,`fecha`,`accion`,`tabla`,`descripcion`)
			VALUES
			(NOT NULL,'".$usuario."','".$now."','".$tipo."','".$tabla."',".$this->conexion_registro->quote($consulta).")";
			$this->consulta_registro($registro_query);
			}
	}

}	
	
	
	
class Base_de_datos {
	
	//atributos
	private $conexion;
	public $bbdd;
	private $respuesta;
	private $respuesta_no_controlada;
	public $resultado;
	public $id_record;
	private $registros;
	private $bbdd_registros;
	//metodosc
	
	public function __construct($bbdd,$bbdd_registros){
	$this->bbdd = $bbdd;
	$this->bbdd_registros = $bbdd_registros;	
	$this->conexion = new PDO("sqlite:$bbdd") or die ('No conexion con base de datos');
	$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	
	$this->registros = new REGISTROS($this,$this->bbdd_registros);
		
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
		if($tabla == "LOGS" || $session_id < "2")
			return false;
		if($tabla == "OFERTAS" || $session_id < "1")
			return false;
	
		return true;
	}
	
	public function consulta($consulta,$tipo,$tabla,$session_id){
		if ($this->autorizador($tipo,$tabla,$session_id))
		{		
			try 
			{
				$this->respuesta = $this->conexion->query("$consulta"); 
			}
			catch (PDOException $e) 
			{
				echo $e->getMessage()." Error de base de datos: $consulta";
			}
			if($this->respuesta)
			{
				$this->registros->registro($consulta,$tipo,$tabla,$session_id);
			}				
		}	
	else exit();
	}
	

	public function consulta_no_controlada($consulta,$tipo,$tabla,$session_id)
	{
		try
		{
			$this->respuesta_no_controlada = $this->conexion->query("$consulta"); 
		}
		catch(PDOException $e) 
		{
			echo $e->getMessage()." Error de base de datos: $consulta";
		}
		if($this->respuesta)
		{
			try
				{	
						return $this->conexion->query($consulta);
				}
			catch(PDOException $e) 
				{
						echo $e->getMessage()." Error de base de datos: $consulta";
				}		
		}		
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
  