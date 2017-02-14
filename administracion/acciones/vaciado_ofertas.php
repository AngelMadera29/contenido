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
		
	/*
	$resultado = $bbdd->consulta("SELECT id, articulo,precio,texto,foto_id,video_id,fecha_inicio,fecha_fin,pases_pendientes,momento_inicial,momento_final,retardo,duracion,canal FROM ofertas where id in ($date)","SELECT","OFERTAS","");
	
	foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $res){
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
	
	
	$db3 = new PDO('sqlite:administracion/db/registros.sqlite');
	$db3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
$replace = "REPLACE INTO personal ('id','nombre','apellido1','apellido2','fecha_nacimiento','telefono_fijo','telefono_celular','rfid','visitante','ubicacion','seguro_social','tipo_sangre','dc3_montacargas','dc3_gruas','cargo','emergencias','id_empresa','nc_empresa')VALUES ('".$id."','".$nombre."','".$apellido1."','".$apellido2."','".$nacimiento."','".$fijo."','".$celular."',	'".$rfid."','".$visitante."','".$ubicacion."','".$IMSS."','".$sangre."','".$monta."','".$gruas."','".$cargo."','".$llamar."','".$id_empresa."','".$nc_empresa."')";

	$stmt=$db3->prepare($replace);
	$stmt->execute();	
		
	$buscar= $conexion->query("SELECT fotografia FROM personal WHERE id in ($id)");
	$bu = $buscar->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
	$foto=explode('?',$bu['fotografia']);
	unlink("administracion/db/imagenes/".$foto[0]);
	
			}//fin del ciclo foreach
	$log = "INSERT INTO logs('id','usuario','fecha','accion','descripcion')VALUES(NULL,'".$usuario."','".$now."','vaciado de personal','borrado personal $date')";
	$stmt1=$db3->prepare($log);
	$stmt1->execute();
	*/
	
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