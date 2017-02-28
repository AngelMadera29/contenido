<?php 
	session_start();
	
	include_once "administracion/db/BBDD.php";
 $bbdd = new Base_de_datos('administracion/db/bbdd.db','administracion/db/registros.sqlite');
   	
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 2 ){exit;}
$op = $_POST['op']; 
$id = $_POST['id'];
$bloque = $_POST['bloque'];	
$descripcion = $_POST['descripcion'];

if ($op=="update")
{
	if($_POST['id']!='')
	{
		$update = "UPDATE bloques SET bloque = '".$bloque."', descripcion = '".$descripcion."' WHERE id = '".$id."'";
		$bbdd->consulta($update,"UPDATE","BLOQUES",session_id());
	}//fin de if post no esta vacio 
		echo '<script language="javascript">alert("Bloque actualizado correctamente");</script>'; 
		include "administracion/vistas/tablas.php";
}//fin de si post es actualizar

if ($op=="insert")
	{
		$insertar = "INSERT INTO bloques (`id`,`bloque`,`descripcion`) VALUES (NOT NULL,'".$bloque."','".$descripcion."')";
		$bbdd->consulta($insertar,"UPDATE","BLOQUES",session_id());
		echo '<script language="javascript">alert("Bloque insertado correctamente");</script>'; 
		include "administracion/vistas/tablas.php";
	} //fin del if uodate

	
?>
	