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

/*
$resultado = $bbdd->consulta("SELECT * from ofertas where id = '".$id."'","SELECT","OFERTAS","");
$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);


$id1 = $res['id'];	
$articulo1 = $res['articulo'];
$precio1 = $res['precio'];	
$texto1 = $res['texto'];
$foto_id1=$res['foto_id'];	
$video_id1 = $res['video_id'];
$fecha_inicio1 = $res['fecha_inicio'];	
$fecha_fin1 = $res['fecha_fin'];
$pases_pendientes1 = $res['pases_pendientes'];
$momento_inicial1 = $res['momento_inicial'];	
$momento_final1 = $res['momento_final'];
$retardo1 = $res['retardo'];	
$duracion1 = $res['duracion'];	
$canal1 = $res['canal'];	
	
/*if($bbdd_tipo=="sqlite"){
	$conexion2 = new PDO("sqlite:administracion/db/registros.sqlite");
	$conexion2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
if($bbdd_tipo=="mysql"){
	$conexion2 = new mysqli ("localhost","root","root","registros");
}*/

if ($op=="update"){
	if ($_POST["id"]!=''){
		if ($visitante == "NO" && $_SESSION['nivel'] == 0){exit;} //no se tiene permisos con nivel cero mas que para editar visitantes!!

		$actulizar = "UPDATE ofertas SET 		
		id = '".$id."', 
		articulo = '".$articulo."', 
		precio = '".$precio."', 
		texto = '".$texto."',
		fecha_inicio = '".$fecha_inicio."',
		fecha_fin = '".$fecha_fin."',
		pases_pendientes = '".$pases_pendientes."',
		momento_inicial = '".$momento_inicial."',
		momento_final = '".$momento_final."',
		retardo = '".$retardo."',
		duracion = '".$duracion."',
		canal = '".$canal."'
		WHERE id = '".$id_antiguo."'";

		$bbdd->consulta($actulizar,"UPDATE","OFERTAS","");
	

		//comprobamos la extencion del archivo
		$archivo = $_FILES["fotografia"]["type"]; 
		$trozos = explode(".", $archivo); 
		$extension = end($trozos); 
		
		// mostramos la extensión del archivo
		if ($archivo != "video/mp4"){
			//si el archivo es fotografia este lo mandara direnctamente a esta opcion
			if ($_FILES["fotografia"]["tmp_name"]!="")
			{
		
			//$upload_img = cwUpload('fotografia',"administracion/db/imagenes/fotografia_".$id.".jpg",'',TRUE,"administracion/db/imagenes/fotografia_".$id.".jpg",'','');
			move_uploaded_file($_FILES["fotografia"]["tmp_name"], "administracion/db/imagenes/fotografia_".$id.".jpg");	
			$foto_id="fotografia_".$id.".jpg?".rand();
															}else{
			$foto_id="sin_imagen.jpg";
											 	 	 }

			$bbdd->consulta("UPDATE ofertas SET foto_id = '".$foto_id."' WHERE id = '".$id."'","UPDATE","ofertas","");
		//fin de la opcion si el tipo de archivo es fotogrfia
			
			  }else{		
		//es metodo para agregar video y transformarlo a gif
		if ($_FILES["fotografia"]["tmp_name"]!="")
										{
			move_uploaded_file($_FILES["fotografia"]["tmp_name"], "administracion/db/videos/video_".$id."_". $_FILES["fotografia"]["name"]);		
     		$video_id="video_".$id."_".$_FILES["fotografia"]["name"];
										}else{
			$video_id="sin_imagen.jpg";
											 }
			$bbdd->consulta("UPDATE ofertas SET video_id = '".$video_id."' WHERE id = '".$id."'","UPDATE","ofertas","");
		
		$resultado1 = $bbdd->consulta("SELECT * from ofertas where id = '".$id."'","SELECT","OFERTAS","");
		$res1 = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
		$video_id1 = $res1['video_id'];
		
		$nombre_de_video=explode('?',$video_id1);
		
		if (file_exists("administracion/db/videos/".$nombre_de_video[0])&&$nombre_de_video[0]!="sin_imagen.jpg"&&$nombre_de_video[0]!="")
		{
			comprobar_previsualizacion("administracion/db/videos/".$nombre_de_video[0],"administracion/db/previsualizaciones","1");
		}
		
					}//fin de else si no es video
		
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
echo '<script language="javascript">alert("Oferta actualizada correctamente");</script>'; 
include "administracion/vistas/ofertas.php";
}	//fin del if update

if ($op=="insert"){
if ( $_SESSION['nivel'] < $nivel_editar){exit;}

$insertar_estilo = "INSERT INTO estilos (id,estilo,descripcion)VALUES(NOT NULL,'".$estilo."','".$descripcion."')";
$bbdd->consulta($insertar_estilo,"INSERT","ESTILOS","");
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

 $bbdd->consulta($insertar_estilos,"INSERT","PLANTILAS_DE_ESTILOS","");
 //$id = $bbdd->resultado_id();

		
		echo '<script language="javascript">alert("Oferta agregada correctamente");</script>'; 	
		echo '<script language="javascript">alert("Actualiza o agrega fotografia");</script>'; 
		echo "<script> window.location = '?page=ofertas_form&datos=$id';</script>";	
		include "administracion/vistas/ofertas.php";
	}//fin del if si es insert
	
?>
