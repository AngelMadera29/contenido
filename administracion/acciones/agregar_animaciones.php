<?php 
	session_start();
	
	include_once "administracion/db/BBDD.php";
 $bbdd = new Base_de_datos('administracion/db/bbdd.db','administracion/db/registros.sqlite');
   	
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 2 ){exit;}
$op = $_POST['op']; 
$id = $_POST['id'];
$animacion = $_POST['animacion'];	
$descripcion = $_POST['descripcion'];

if ($op=="update")
{
	if($_POST['id']!='')
	{
		$update = "UPDATE animaciones SET animacion = '".$animacion."', descripcion = '".$descripcion."' WHERE id = '".$id."'";
		$bbdd->consulta($update,"UPDATE","ANIMACIONES",session_id());
	}//fin de if post no esta vacio 
		echo '<script language="javascript">alert("Animación actualizada correctamente");</script>'; 
		include "administracion/vistas/tablas.php";
}//fin de si post es actualizar

if ($op=="insert")
	{
		$insertar = "INSERT INTO animaciones (`id`,`animacion`,`descripcion`) VALUES (NOT NULL,'".$animacion."','".$descripcion."')";
		$bbdd->consulta($insertar,"UPDATE","ANIMACIONES",session_id());
		echo '<script language="javascript">alert("Animacion insertada correctamente");</script>'; 
		include "administracion/vistas/tablas.php";
	} //fin del if uodate

	
?>