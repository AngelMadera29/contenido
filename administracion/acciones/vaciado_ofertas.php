<?php
session_start();
	include_once "administracion/db/BBDD.php";
   	$bbdd = new Base_de_datos('administracion/db/bbdd.db');
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 1 ){exit;}
if (isset($_GET))
{
	$date=$_GET['datos'];
	if ($date != "")
	{
		$usuario = $_SESSION['nombre'];
		$now =  date("Y-m-d H:i:s"); 			
		$resultado = $bbdd->consulta("DELETE FROM ofertas WHERE id in ($date)","DELETE","OFERTAS","");		
  	}
}

?>
<script type="text/javascript">
<!--
var answer = confirm("Personal vaciado correctamente correctamente");
if (!answer){
window.location = "administracion/vistas/ofertas.php";
}
//-->
</script>

<?php
	include "administracion/vistas/ofertas.php";
	?>