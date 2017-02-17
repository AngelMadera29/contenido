<?php 
	session_start();
	
	include_once "administracion/db/BBDD.php";
   	$bbdd = new Base_de_datos('administracion/db/bbdd.db');
   	
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 2 ){exit;}
$op = $_POST['op']; 
$id = $_POST['id'];
$video = $_POST['video'];	
$descripcion = $_POST['descripcion'];


	$resultado = $bbdd->consulta("SELECT * from videos where id = '".$id."'","SELECT","VIDEOS","$nivel");
	$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

$nombre_1 = $res['nombre'];
$descripcion1 = $res['descripcion'];
$usuario = $_SESSION['nombre'];

if($op=="actualizar"){
	if($_POST['id']!=''){

$update = "UPDATE videos SET nombre = '".$nombre."', descripcion = '".$descripcion."' WHERE id = '".$id."'";
$bbdd->consulta($update,"UPDATE","VIDEOS","");
		
	
		//es metodo para agregar video y transformarlo a gif
		if ($_FILES["video"]["tmp_name"]!="")
										{
			move_uploaded_file($_FILES["video"]["tmp_name"], "administracion/db/videos_fondo/video_".$id."_". $_FILES["video"]["name"]);		
     		$video_id="video_".$id."_".$_FILES["video"]["name"];
										}else{
			$video_id="sin_imagen.jpg";
											 }
			$bbdd->consulta("UPDATE video SET nombre = '".$video_id."' WHERE id = '".$id."'","UPDATE","VIDEOS","");
		
		$resultado1 = $bbdd->consulta("SELECT * from videos where id = '".$id."'","SELECT","OFERTAS","");
		$res1 = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
		$video_id1 = $res1['nombre'];
		
		$nombre_de_video=explode('?',$video_id1);
		
		if (file_exists("administracion/db/videos/".$nombre_de_video[0])&&$nombre_de_video[0]!="sin_imagen.jpg"&&$nombre_de_video[0]!="")
		{
			comprobar_previsualizacion("administracion/db/videos/".$nombre_de_video[0],"administracion/db/previsualizaciones","1");
		}
		
					}//fin de else si no es video
		
/*
$log = "INSERT INTO logs(`id`,`usuario`,`fecha`,`accion`,`descripcion`)
VALUES
(NOT NULL,'".$usuario."','".$now."','actualizacion',
'actualizados los valores usuario ID -> $id 
nombre DE $nombre_1 A-> $nombre 
contraseña DE $sha_pass_1 A-> $contrasena 
nivel DE $nivel_1 A-> $nivel')";

	$stmt2=$db3->prepare($log);
	$stmt2->execute();
 */

	}//fin de if post no esta vacio 
echo '<script language="javascript">alert("Video actualizado correctamente");</script>'; 
}//fin de si post es actualizar

if ($op=="insert"){
	
$insertar = "INSERT INTO videos (`id`,`nombre`,`descripcion`) VALUES (NOT NULL,'".$nombre."','".$descripcion."')";
$bbdd->consulta($insertar,"UPDATE","VIDEOS","");
$id = $bbdd->resultado_id();
	
	
	if ($_FILES["video"]["tmp_name"]!="")
										{
			move_uploaded_file($_FILES["video"]["tmp_name"], "administracion/db/videos_fondo/video_".$id."_". $_FILES["video"]["name"]);		
     		$video_id="video_".$id."_".$_FILES["video"]["name"];
										}else{
			$video_id="sin_imagen.jpg";
											 }
			$bbdd->consulta("UPDATE video SET nombre = '".$video_id."' WHERE id = '".$id."'","UPDATE","VIDEOS","");
		
		$resultado1 = $bbdd->consulta("SELECT * from videos where id = '".$id."'","SELECT","OFERTAS","");
		$res1 = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
		$video_id1 = $res1['nombre'];
		
		$nombre_de_video=explode('?',$video_id1);
		
		if (file_exists("administracion/db/videos/".$nombre_de_video[0])&&$nombre_de_video[0]!="sin_imagen.jpg"&&$nombre_de_video[0]!="")
		{
			comprobar_previsualizacion("administracion/db/videos/".$nombre_de_video[0],"administracion/db/previsualizaciones","1");
		}
		
					}//fin de else si no es video

	/*
	//resultado del ultido id registrado
	$id = $bbdd->resultado_id();
	$logs = "INSERT INTO logs (`id`,`usuario`,`fecha`,`accion`,`descripcion`)VALUES(NULL,'".$usuario."','".$now."','agregado','insertado nuevo usuario ID = $id')";
	*/
    echo '<script language="javascript">alert("Video insertado correctamente");</script>'; 
} //fin del if uodate

include "administracion/vistas/videos.php";
	
?>
	