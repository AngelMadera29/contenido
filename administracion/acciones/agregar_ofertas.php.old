<?php		
   	session_start();
   	include ('../administracion/db/BBDD.php');
   	$bbdd = new Base_de_datos('administracion/db/bbdd.db');
   	
   	$nivel = $_SESSION['nivel'];
	$nivel_editar=1;
	
	
if ($_SESSION['nivel'] == ''){exit;}
function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){
	//folder path setup
	$target_path = $target_folder;
	$thumb_path = $thumb_folder;
	
	//file name setup
	$filename_err = explode(".",$_FILES[$field_name]['tmp_name']);
	$filename_err_count = count($filename_err);
	$file_ext = $filename_err[$filename_err_count-1];
		
	//upload image path
	$upload_image = $target_path.basename($fileName);
	
	//upload image
	if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
	{
		//thumbnail creation
		if($thumb == TRUE)
		{
			$thumbnail = $thumb_path.$fileName;
			list($width,$height) = getimagesize($upload_image);
			$thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
			switch($file_ext){
				case 'jpg':
					$source = imagecreatefromjpeg($upload_image);
					break;
				case 'jpeg':
					$source = imagecreatefromjpeg($upload_image);
					break;
				case 'png':
					$source = imagecreatefrompng($upload_image);
					break;
				case 'gif':
					$source = imagecreatefromgif($upload_image);
					break;
				default:
					$source = imagecreatefromjpeg($upload_image);
			}
			imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
			switch($file_ext){
				case 'jpg' || 'jpeg':
					imagejpeg($thumb_create,$thumbnail,100);
					break;
				case 'png':
					imagepng($thumb_create,$thumbnail,100);
					break;
				case 'gif':
					imagegif($thumb_create,$thumbnail,100);
					break;
				default:
					imagejpeg($thumb_create,$thumbnail,100);
			}
		}

		return $fileName;
	}
	else
	{
		return false;
	}
}	
	
$op = $_POST['op']; 
$id_antiguo = $_POST['id_antiguo'];
$id = $_POST['id'];	
$articulo = $_POST['articulo'];
$precio = $_POST['precio'];	
$texto = $_POST['texto'];
$fotografia = $_POST['fotografia'];	
$video_id = $_POST['apellido2'];
$fecha_inicio = $_POST['fecha_inicio'];	
$fecha_fin = $_POST['fecha_fin'];
$pases_pendientes = $_POST['pases_pendientes'];
$momento_inicial = $_POST['momento_inicial'];	
$momento_final = $_POST['momento_final'];
$retardo = $_POST['retardo'];	
$duracion = $_POST['duracion'];	
$canal = $_POST['canal'];	




//obtenr la extencion del archivo a subir
$archivo = $_FILES["fotografia"]["type"]; 
$trozos = explode(".", $archivo); 
$extension = end($trozos); 
// mostramos la extensi�n del archivo
echo "La extensi�n del archivo es: $extension";  

if ($archivo == "image/jpeg"){
	echo "es imagen";
}else{
	echo "es otra cosa";
}

exit();


$usuario = $_SESSION['nombre'];
$now = gmdate('d-m-y H:i:s', time() - 3600 * 5);		


$resultado = $bbdd->consulta("SELECT * from ofertas where id = '".$id."'","SELECT","OFERTAS","");
$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);


$id1 = $res['id'];	
$articulo1 = $res['articulo'];
$precio1 = $res['precio'];	
$texto1 = $res['texto'];
$foto_id1=$res['foto_id'];	
$video_id1 = $res['apellido2'];
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
			
		if ($_FILES["fotografia"]["tmp_name"]!="")
		{
		
			$upload_img = cwUpload('fotografia',"administracion/db/imagenes/fotografia_".$id.".jpg",'',TRUE,"administracion/db/imagenes/fotografia_".$id.".jpg",'','');
					//move_uploaded_file($_FILES['fotografia']['tmp_name'], "administracion/db/imagenes/fotografia_".$id.".jpg");
			$foto_id="fotografia_".$id.".jpg?".rand();
			//$video="previsualizaciones/".replace_extension($row["video_id"],"gif");

			$bbdd->consulta("UPDATE ofertas SET foto_id = '".$foto_id."' WHERE id = '".$id."'","UPDATE","ofertas","");


				}//fin de if FILE from fotografia		
		

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
//else{
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

 $bbdd->consulta($insertar,"INSERT","OFERTAS","");
 $id = $bbdd->resultado_id();
/* 
	metodo para tomar la ultima id insertada de ofertas y utlizarla para agregarla a la tabla de logs
	$id=$conexion->lastInsertId();
	$log1 = "INSERT INTO logs(`id`,`usuario`,`fecha`,`accion`,`descripcion`)VALUES(NULL,'".$usuario."','".$now."','agregado','agregado personal id $id')";
	$stmt1=$conexion2->prepare($log1);
	$stmt1->execute();
*/
				
		if ($_FILES["fotografia"]["tmp_name"]!="")
		{
			$upload_img = cwUpload('fotografia',"administracion/db/imagenes/fotografia_".$id.".jpg",'',TRUE,"administracion/db/imagenes/fotografia_".$id.".jpg",'','');								$foto_id="fotografia_".$id.".jpg?".rand();
		}else{
			$foto_id="sin_imagen.jpg";
		}
		
		$bbdd->consulta("UPDATE ofertas SET foto_id = '".$foto_id."' WHERE id = '".$id."'","UPDATE","OFERTAS","");

		
		echo '<script language="javascript">alert("Oferta insertada correctamente");</script>'; 
	}//fin del if si es insert
include "administracion/vistas/ofertas.php";

?>
