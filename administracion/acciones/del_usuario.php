<?php
	session_start();
	include ('../administracion/db/BBDD.php');
   	$bbdd = new Base_de_datos('administracion/db/bbdd.db');
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 2 ){exit;}

if (isset($_GET))
{
	$id=$_GET['datos'];
	if ($id != "")
	{
		
	$resultado = $bbdd->consulta("DELETE FROM usuarios WHERE id in ($id)","DELETE","USUARIOS","");
	$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);


/*
$usuario = $_SESSION['nombre'];
$now = gmdate('d-m-y H:i:s', time() - 3600 * 5);

$logs = "INSERT INTO logs(`id`,`usuario`,`fecha`,`accion`,`descripcion`)VALUES(NULL,'".$usuario."','".$now."','eliminacion','borrado usuario $id')";	
if ($bbdd_tipo=="sqlite"){
$db3 = new PDO("sqlite:administracion/db/registros.sqlite");
$db3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$result = $db3->query($logs); //replace exec with query
}	
if($bbdd_tipo=="mysql"){
$db3 = new mysqli ("localhost","root","root","registros");
$result = mysqli_query($db3,$logs);	 
}//fin del try para agregar logs dentro de la base de datos		
	*/	
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