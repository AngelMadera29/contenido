<?php		
   	session_start();
   	include("comprobar_previsualizacion.php");
   	include_once "administracion/db/BBDD.php";
   	$bbdd = new Base_de_datos('administracion/db/bbdd.db');
   
   	
   	$nivel = $_SESSION['nivel'];
   	$id_usuario = $_SESSION['id'];
	$nivel_editar=1;
	

if ($_SESSION['nivel'] == ''){exit;}
	
$op = $_POST['op']; 
$id_antiguo = $_POST['id_antiguo'];
$id = $_POST['id'];	
$articulo = $_POST['articulo'];
$precio = $_POST['precio'];	
$texto = $_POST['texto'];
$fecha_inicio = $_POST['fecha_inicio'];	
$fecha_fin = $_POST['fecha_fin'];
$pases_pendientes = $_POST['pases_pendientes'];
$momento_inicial = $_POST['momento_inicial'];	
$momento_final = $_POST['momento_final'];
$retardo = $_POST['retardo'];	
$duracion = $_POST['duracion'];	
$canal = $_POST['canal'];	
$id_estilo = $_POST['id_estilo'];
$video = $_POST['video'];

$usuario = $_SESSION['nombre'];
$now = gmdate('d-m-y H:i:s', time() - 3600 * 5);		



$resultado = $bbdd->consulta("SELECT * from ofertas where id = '".$id."'","SELECT","OFERTAS",session_id());
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
$id_estilo1 = $_POST['id_estilo_animacion'];

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
		canal = '".$canal."',
		id_estilo_animacion = '".$id_estilo."'
		WHERE id = '".$id_antiguo."'";
		

		
		$bbdd->consulta($actulizar,"UPDATE","OFERTAS","");
		$bbdd->consulta("UPDATE ofertas SET id_usuario = '".$id_usuario."' WHERE id = '".$id_antiguo."'","UPDATE","OFERTAS","$nivel");
		
		
		if ($video_id1 != $video){
			$bbdd->consulta("UPDATE ofertas SET video_id = '".$video."' WHERE id = '".$id_antiguo."' ","UPATE","OFERTAS","$nivel");
		}
		
	
		//comprobamos la extencion del archivo
		$archivo = $_FILES["fotografia"]["type"]; 
		$trozos = explode(".", $archivo); 
		$extension = end($trozos); 
		
		
		// mostramos la extensión del archivo
		if ($archivo != "video/mp4" ){
			//si el archivo es fotografia este lo mandara direnctamente a esta opcion
			if($foto_id1 != ""){}
			if ($_FILES["fotografia"]["tmp_name"]!="")
			{
			//$upload_img = cwUpload('fotografia',"administracion/db/imagenes/fotografia_".$id.".jpg",'',TRUE,"administracion/db/imagenes/fotografia_".$id.".jpg",'','');
			move_uploaded_file($_FILES["fotografia"]["tmp_name"], "administracion/db/imagenes/fotografia_".$id.".jpg");	
			$foto_id="fotografia_".$id.".jpg?".rand();
			$bbdd->consulta("UPDATE ofertas SET foto_id = '".$foto_id."' WHERE id = '".$id."'","UPDATE","OFERTAS",session_id());
			}
			if($foto_id1=="")										 
			{										 
			$foto_id="sin_imagen.jpg";
			$bbdd->consulta("UPDATE ofertas SET foto_id = '".$foto_id."' WHERE id = '".$id."'","UPDATE","OFERTAS",session_id());
			}
				
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
			$bbdd->consulta("UPDATE ofertas SET video_id = '".$video_id."' WHERE id = '".$id."'","UPDATE","OFERTAS",session_id());
		
		$resultado1 = $bbdd->consulta("SELECT * from ofertas where id = '".$id."'","SELECT","OFERTAS",session_id());
		$res1 = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
		$video_id1 = $res1['video_id'];
		
		$nombre_de_video=explode('?',$video_id1);
		
		if (file_exists("administracion/db/videos/".$nombre_de_video[0])&&$nombre_de_video[0]!="sin_imagen.jpg"&&$nombre_de_video[0]!="")
		{
			comprobar_previsualizacion("administracion/db/videos/".$nombre_de_video[0],"administracion/db/previsualizaciones","1");
		}
		
					}//fin de else si no es video
		
	
	}//fin de if post no esta vacio
echo '<script language="javascript">alert("Oferta actualizada correctamente");</script>'; 
include "administracion/vistas/ofertas.php";
}	//fin del if update

if ($op=="insert"){
if ( $_SESSION['nivel'] < $nivel_editar){exit;}

$insertar = 'INSERT INTO ofertas (`id`,`articulo`,`precio`,`texto`,`foto_id`,`video_id`,`fecha_inicio`,fecha_fin,`pases_pendientes`,`momento_inicial`,`momento_final`,`retardo`,`duracion`,`canal`) VALUES
'." (NOT NULL,
'".$articulo."',
'".$precio."',
'".$texto."',
'".$foto_id."',
'".$video_id."',
'".$fecha_inicio."',
'".$fecha_fin."',
'".$pases_pendientes."',
'".$momento_inicial."',
'".$momento_final."',
'".$retardo."',
'".$duracion."',
'".$canal."')";

 $bbdd->consulta($insertar,"INSERT","OFERTAS",session_id());
 $id = $bbdd->resultado_id();
 

$resultado = $bbdd->consulta("SELECT * from ofertas where id = '".$id."'","SELECT","OFERTAS",session_id());
$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$video = $res['video_id'];	 
$texto = $res['texto'];	
 
 $bbdd->consulta("INSERT INTO videos (id,nombre,descripcion) VALUES ('".$id."','".$nombre."','".$texto."')"); 
 $bbdd->consulta("UPDATE ofertas SET id_usuario = '".$id_usuario."' WHERE id = '".$id."'","UPDATE","OFERTAS","$nivel");

			
		echo '<script language="javascript">alert("Oferta agregada correctamente");</script>'; 	
		echo '<script language="javascript">alert("Actualiza o agrega fotografia");</script>'; 
		echo "<script> window.location = '?page=ofertas_form&datos=$id';</script>";	
		include "administracion/vistas/ofertas.php";
	}//fin del if si es insert
	
?>
