<?php 
	session_start();
	
	include_once "administracion/db/BBDD.php";
   	$bbdd = new Base_de_datos('administracion/db/bbdd.db');
   	
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 2 ){exit;}
$op = $_POST['op']; 
$id = $_POST['id'];
$nombre = $_POST['nombre'];	
$contrasena = $_POST['sha_pass'];
$nivel = $_POST['nivel'];
$str = "$nombre:$contrasena";
$sha1 = sha1($str);

	$resultado = $bbdd->consulta("SELECT * from usuarios where id = '".$id."'","SELECT","USUARIOS","");
	$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

$nombre_1 = $res['nombre'];
$sha_pass_1 = $res['sha_pass'];
$nivel_1 = $res['nivel'];
$usuario = $_SESSION['nombre'];
$now = gmdate('d-m-y H:i:s', time() - 3600 * 5);


if($op=="actualizar"){
	if($_POST['id']!=''){

$update = "UPDATE usuarios SET nombre = '".$nombre."', sha_pass = '".$sha1."', nivel = '".$nivel."' WHERE id = '".$id."'";
		$bbdd->consulta($update,"UPDATE","USUARIOS","");
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
echo '<script language="javascript">alert("Usuario actualizado correctamente");</script>'; 
}//fin de si post es actualizar

if ($op=="insert"){
	
$insertar = "INSERT INTO usuarios (`id`,`nombre`,`sha_pass`,`nivel`,`sessionkey`) VALUES (NOT NULL,'".$nombre."','".$sha1."','".$nivel."','')";
	$bbdd->consulta($insertar,"UPDATE","USUARIOS","");
	/*
	//resultado del ultido id registrado
	$id = $bbdd->resultado_id();
	$logs = "INSERT INTO logs (`id`,`usuario`,`fecha`,`accion`,`descripcion`)VALUES(NULL,'".$usuario."','".$now."','agregado','insertado nuevo usuario ID = $id')";
	*/
    echo '<script language="javascript">alert("Usuario insertado correctamente");</script>'; 
} //fin del if uodate

include "administracion/vistas/usr.php";
	
?>
	