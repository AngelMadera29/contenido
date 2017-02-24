<?php
$lenguaje = 'es_ES.UTF-8';
putenv("LANG=$lenguaje");
setlocale(LC_ALL, $lenguaje);
setlocale(LC_ALL,"es_ES@euro","es_ES","esp");

include ('../db/BBDD.php');
$bbdd = new Base_de_datos('../db/bbdd.db','../db/registros.sqlite');


$returnVars = array();

if ($_GET['op']=="disponibilidad_contenidos")
{
        $query = "SELECT * FROM ofertas WHERE 1 AND fecha_inicio<=datetime('now','localtime') AND fecha_fin>=datetime('now','localtime') AND momento_inicial<= datetime('now','localtime') AND momento_final>=datetime('now','localtime') order by RANDOM()";
        $result = $bbdd->consulta($query);
        $result = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        $filas =  count($result);
		echo "contenidos=$filas";
		//$result = sqlite_query($manejador_bbdd, $query) or die("No se ha podido buscar la ficha en noticias:" . mysql_error());
        //echo "contenidos=".sqlite_num_rows($result);
        exit;
}
if ($_GET['id']!="")
{
	$query  = "SELECT * FROM ofertas WHERE id=".$_GET['id']." LIMIT 1";
	$result = $bbdd->consulta($query);
    $row = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
	//$result = sqlite_query($manejador_bbdd, $query) or die("No se ha podido buscar la ficha en noticias:" . mysql_error());
	//$row = sqlite_fetch_array($result, SQLITE_ASSOC);
}
else
{

	$query  = "SELECT * FROM ofertas WHERE pases_pendientes>0 AND fecha_inicio<=datetime('now','localtime') AND fecha_fin>=datetime('now','localtime') AND momento_inicial<= time('now','localtime') AND momento_final>=time('now','localtime') order by RANDOM()";
	$result = $bbdd->consulta($query);
	$row = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
	//$result = sqlite_query($manejador_bbdd, $query) or die("No se ha podido buscar la ficha en noticias:" . mysql_error());
	//$row = sqlite_fetch_array($result, SQLITE_ASSOC);
	$id=$row['id'];
	$id_estilo_animacion = $row['id_estilo_animacion'];
	if ($id!="")
	{
		$pases_pendientes=$row['pases_pendientes']-1;
		$query_2  = "UPDATE ofertas SET pases_pendientes=0 WHERE id='".$id."'";
		$result = $bbdd->consulta($query_2);
		$result = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
		//$result = sqlite_query($manejador_bbdd,$query_2) or die("No se ha podido buscar la ficha: contenidos.php:" . mysql_error());
	}
	else
	{
		$query_2  = "UPDATE ofertas SET pases_pendientes=1";
		$result = $bbdd->consulta($query_2);
		//$result = sqlite_query($manejador_bbdd,$query_2) or die("No se ha podido buscar la ficha: contenidos.php:" . mysql_error());
		//ejecutamos la consulta
		$result = $bbdd->consulta($query);
		$result = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
		//$result = sqlite_query($manejador_bbdd,$query) or die("No se ha podido buscar la ficha: contenidos.php:" . mysql_error());
		//$row = sqlite_fetch_array($result, SQLITE_ASSOC);
		$id=$row['id'];
		$query_2  = "UPDATE ofertas SET pases_pendientes=0 WHERE id='".$id."'";
		$result = $bbdd->consulta($query_2);
		$row = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
		
		
	}
}

	
	$fecha_parte_inicial=ucfirst(strftime('%A, %d de ',strtotime('now')));
	$fecha_parte_final=ucfirst(strftime('%B de %Y',strtotime('now')));
	//$fecha_parte_inicial=ucfirst(strftime('%A, %d de ',strtotime($row['fecha_inicio'])));
	//$fecha_parte_final=ucfirst(strftime('%B de %Y',strtotime($row['fecha_inicio'])));

	

	$foto_url=explode("?",$row['foto_id']);
	$returnVars['id']=$row['id'];
	$path_total=explode('/',$_SERVER["REQUEST_URI"]);
	$path_base="";
	for ($i=1;$i<count($path_total)-2;$i++)
	{
	        $path_base=$path_base.$path_total[$i];
	        $path_base=$path_base.'/';
	}

	
$query = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = '".$id_estilo_animacion."' ","select","plantillas_de_estilo","");
// look through query
$resultado = $bbdd->resultado_completo(PDO::FETCH_ASSOC);

foreach ($resultado as $row){
	
	$id_animacion = $row['id_animacion'];
	$id_estilo = $row['id_estilo'];
	$id_bloque = $row['id_bloque'];
	$id_tipo_animacion= $row['id_tipo_animacion'];
	
	if($id_tipo_animacion == '1' )
		$nombre_variable="en";
	if($id_tipo_animacion == '2' )
		$nombre_variable="sal";
		
	$query = $bbdd->consulta("select * from bloques where id = '".$id_bloque."' ","select","bloques","");
	$row1 = $bbdd->obtener_resutado(PDO::FETCH_ASSOC);
	 
	 $bloque = $row1['bloque'];
	 
	 $nombre_variable = $nombre_variable.$bloque;
	 
	$query = $bbdd->consulta("select * from animaciones where id = '".$id_animacion."' ","select","animacion","");
	$row1 = $bbdd->obtener_resutado(PDO::FETCH_ASSOC);
	 $animacion = $row1['animacion'];
	 $array_salida[$nombre_variable]=$animacion;

}

	$array_salida['id']=$row['id'];
	$array_salida['foto']='/'.$path_base."/imagenes/".$foto_url[0];
	$array_salida['fondo'] = $row[''];
	$array_salida['fecha'] =$fecha_parte_inicial.$fecha_parte_final;
	$array_salida['titulo']=$row['articulo'];
	$array_salida['contenido']=$row[''];
	$array_salida['noticia']=$row['texto'];

	
	/*
	$returnVars['foto']='/'.$path_base."/imagenes/".$foto_url[0];
	//$returnVars['foto']="/media/noticias_victoria_dgo/administrador/imagenes/".$foto_url[0];
	$returnVars['descripcion']=$row['texto'];
	$returnVars['fecha']=$fecha_parte_inicial.$fecha_parte_final;
	//$returnVars['fecha']="Victoria de Durango Durango";
	$returnVars['titulo']=$row['articulo'];
	$returnVars['fuente']="Durango 450 aniversario";
	*/
	
	
$returnString = http_build_query($array_salida);
echo $returnString;



?>
