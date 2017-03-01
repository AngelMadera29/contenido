<?php
	session_start();
	include_once "administracion/db/BBDD.php";
   	$bbdd = new Base_de_datos('administracion/db/bbdd.db');
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 2 ){exit;}

if (isset($_GET))
{
	$id=$_GET['datos'];
	if ($id != "")
	{
		$resultado = $bbdd->consulta("DELETE FROM usuarios WHERE id in ($id)","DELETE","USUARIOS","");
		$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
	}
}

?>

<script type="text/javascript">
<!--
var answer = confirm("Usuario(s) eliminado");
if (!answer){
window.location = "administracion/vistas/usr.php";
}
//-->
</script>

<?php
	include "administracion/vistas/usr.php";
?>