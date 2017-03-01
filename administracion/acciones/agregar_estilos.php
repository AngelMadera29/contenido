<?php		
   	session_start();

   	include_once "administracion/db/BBDD.php";
   	$bbdd = new Base_de_datos('administracion/db/bbdd.db');
   
   	
   	$nivel = $_SESSION['nivel'];
	$nivel_editar=1;
	
	
if ($_SESSION['nivel'] == ''){exit;}
	
$op = $_POST['op']; 
$id = $_POST['id'];
	
$bloquea = $_POST['bloquea'];
$bloqueb = $_POST['bloqueb'];
$bloquec = $_POST['bloquec'];
$bloqued = $_POST['bloqued'];
//insertado en los bloques para la animacion de entrada
$fecha1 = $_POST['fecha1'];
$titular1 = $_POST['titular1'];
$video1 = $_POST['video1'];
$noticia1 = $_POST['noticia1'];
//insertado en los bloques para la animacion de salida
$fecha2 = $_POST['fecha2'];	
$titular2 = $_POST['titular2'];
$video2 = $_POST['video2'];
$noticia2 = $_POST['noticia2'];	

$estilo = $_POST['estilo'];
$descripcion = $_POST['descripcion'];

$usuario = $_SESSION['nombre'];
$now = gmdate('d-m-y H:i:s', time() - 3600 * 5);		

if ($op=="update"){
	if ($_POST["id"]!=''){
		if ($visitante == "NO" && $_SESSION['nivel'] == 0){exit;} //no se tiene permisos con nivel cero mas que para editar visitantes!!
		
$upadate1 = "UPDATE plantillas_de_estilos set id_animacion = '".$fecha1."' where id_estilo = '".$id."' and id_bloque = '".$bloquea."' and id_tipo_animacion = 1 ";
$upadate2 = "UPDATE plantillas_de_estilos set id_animacion = '".$fecha2."' where id_estilo = '".$id."' and id_bloque = '".$bloquea."' and id_tipo_animacion = 2 ";

$upadate3 = "UPDATE plantillas_de_estilos set id_animacion = '".$titular1."' where id_estilo = '".$id."' and id_bloque = '".$bloqueb."' and id_tipo_animacion = 1 ";
$upadate4 = "UPDATE plantillas_de_estilos set id_animacion = '".$titular2."' where id_estilo = '".$id."' and id_bloque = '".$bloqueb."' and id_tipo_animacion = 2 ";

$upadate5 = "UPDATE plantillas_de_estilos set id_animacion = '".$video1."' where id_estilo = '".$id."' and id_bloque = '".$bloquec."' and id_tipo_animacion = 1 ";
$upadate6 = "UPDATE plantillas_de_estilos set id_animacion = '".$video2."' where id_estilo = '".$id."' and id_bloque = '".$bloquec."' and id_tipo_animacion = 2 ";

$upadate7 = "UPDATE plantillas_de_estilos set id_animacion = '".$noticia1."' where id_estilo = '".$id."' and id_bloque = '".$bloqued."' and id_tipo_animacion = 1 ";
$upadate8 = "UPDATE plantillas_de_estilos set id_animacion = '".$noticia2."' where id_estilo = '".$id."' and id_bloque = '".$bloqued."' and id_tipo_animacion = 2 ";	

$bbdd->consulta($upadate1,"UPDATE","ESTILOS",session_id());
$bbdd->consulta($upadate2,"UPDATE","ESTILOS",session_id());
$bbdd->consulta($upadate3,"UPDATE","ESTILOS",session_id());
$bbdd->consulta($upadate4,"UPDATE","ESTILOS",session_id());
$bbdd->consulta($upadate5,"UPDATE","ESTILOS",session_id());
$bbdd->consulta($upadate6,"UPDATE","ESTILOS",session_id());
$bbdd->consulta($upadate7,"UPDATE","ESTILOS",session_id());
$bbdd->consulta($upadate8,"UPDATE","ESTILOS",session_id());
			
				
		/*
$logs = "INSERT INTO logs(`id`,`usuario`,`fecha`,`accion`,`descripcion`)
VALUES
(NOT NULL,'".$usuario."','".$now."','actualizacion',
'actualizados los valores de personal ID -> $id
 Nombres DE $nombre1 A-> $nombre
 Apellido1 DE $apellido1_1 A-> $apellido1
 Apellido2 DE $apellido2_2 A-> $apellido2 
 Nacimiento DE $nacimiento1 A-> $nacimiento 
 Telefono DE $fijo_1 A-> $telefono_fijo
 Celular DE $celular_1 A-> $celular 
 ID Empresa DE $id_empresa_1 A-> $id_empresa 
 NC Empresa DE $nc_empresa_1 A-> $nombre_C
 Codigo OP DE $codigo_OP_1 A-> $codigoop
 Empresa DE $nc_empresa_1 A-> $NombreL
 RFID DE $rfid_1 A->  $rfid 
 Visitante DE $visitante_1 A-> $visitante
 Ubicacion DE $ubicacion_1 A-> $ubicacion
 Tipo de sangre DE $sangre_1 A-> $sangre
 IMSS DE $IMSS_1 A-> $IMSS
 Montacargas DC3 DE $monta_1 A-> $monta
 Gruas DC3 DE $gruas_1 A-> $gruas
 Cargo DE $cargo_1 A-> $cargo 
 Emergencias DE $llamar_1 A-> $llamar
 Fotografia DE $fotografia_1 A-> $foto_id')";

if ($bbdd_tipo=="sqlite"){
	$conexion2 = new PDO("sqlite:administracion/db/registros.sqlite");
	$conexion2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$logs_personal = $conexion2->query($logs); //replace exec with query
}	
if($bbdd_tipo=="mysql"){
	$conexion2 = new mysqli ("localhost","root","root","registros");
	$logs_personal1 = mysqli_query($conexion2,$logs);	 
}//fin del try para agregar logs dentro de la base de datos
    
 
 */

	}//fin de if post no esta vacio
echo '<script language="javascript">alert("Estilo actualizada correctamente");</script>'; 
include "administracion/vistas/ofertas.php";
}	//fin del if update

if ($op=="insert"){
if ( $_SESSION['nivel'] < $nivel_editar){exit;}

$insertar_estilo = "INSERT INTO estilos (id,estilo,descripcion)VALUES(NOT NULL,'".$estilo."','".$descripcion."')";
$bbdd->consulta($insertar_estilo,"INSERT","ESTILOS",session_id());
$id_estilo = $bbdd->resultado_id();

$insertar_estilos = "INSERT INTO plantillas_de_estilos (id,id_estilo,id_bloque,id_tipo_animacion,id_animacion) 
VALUES 
(NOT NULL,'".$id_estilo."','".$bloquea."','1','".$fecha1."'),
(NOT NULL,'".$id_estilo."','".$bloqueb."','1','".$titular1."'),
(NOT NULL,'".$id_estilo."','".$bloquec."','1','".$video1."'),
(NOT NULL,'".$id_estilo."','".$bloqued."','1','".$noticia1."'),

(NOT NULL,'".$id_estilo."','".$bloquea."','2','".$fecha2."'),
(NOT NULL,'".$id_estilo."','".$bloqueb."','2','".$titular2."'),
(NOT NULL,'".$id_estilo."','".$bloquec."','2','".$video2."'),
(NOT NULL,'".$id_estilo."','".$bloqued."','2','".$noticia2."')"; 

 $bbdd->consulta($insertar_estilos,"INSERT","PLANTILAS_DE_ESTILOS",session_id());
		
		echo '<script language="javascript">alert("Estilo agregada correctamente");</script>'; 	
		include "administracion/vistas/ofertas.php";
	}//fin del if si es insert
	
?>
