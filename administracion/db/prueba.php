<?php
	
include ("BBDD.php");

$bbdd = new Base_de_datos('bbdd.db');	

//$bbdd->consulta("SELECT * FROM 'canales' LIMIT 0, 30","select","canales","");

/*
while($bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
{
print_r($bbdd->resultado);
$row = count($bbdd->resultado);
echo "numero de rows: $row";

}

$result = $bbdd->consulta("SELECT * FROM ofertas where id = 79","select","canales","");
$row = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$nombre = $row['articulo'];
$precio = $row['precio'];
$texto = $row['texto'];


echo $nombre;
echo $precio;
echo $texto;

//	echo "User :$nombre\n nivel: {$row['nivel']}<br>";	

/*
metodo ue devuelve el numero de consultas o total de la consulta mediante el objeto
$result = $bbdd->consulta("SELECT * FROM ofertas WHERE 1 AND fecha_inicio<=datetime('now','localtime') AND fecha_fin>=datetime('now','localtime') AND momento_inicial<= datetime('now','localtime') AND momento_final>=datetime('now','localtime') order by RANDOM()");
$result = $bbdd->resultado_completo(PDO::FETCH_ASSOC);
$filas =  count($result);
echo "Number of rows: $filas";



//metodo que devuelve completamente dentro de un foreach toddos los datos seleccionados para la consulta
$result = $bbdd->consulta("SELECT * FROM ofertas","select","ofertas","");
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $valor){
		
$id1 = $valor['id'];	
$articulo1 = $valor['articulo'];
$precio1 = $valor['video_id'];	

echo "Id :$id1\n Articulo: :$articulo1\n Precio: :$precio1\n <br>";	

}

*/
    $query = "SELECT * FROM ofertas WHERE 1 AND fecha_inicio<=datetime('now','localtime') AND fecha_fin>=datetime('now','localtime') AND momento_inicial<= datetime('now','localtime') AND momento_final>=datetime('now','localtime') order by RANDOM()";
        $result = $bbdd->consulta($query);
        $result = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        echo $result['id'];
        $filas =  count($result);
		echo "contenidos=$filas";
/*
$bbdd->consulta("SELECT * FRFOM usuarios","select","usuarios","")
while($bbdd->obtener_resutado($bbdd)){
	
}

$bbdd->consulta("UPDATE canales set peso = 20,restante = 20 where id = 8","update","canales","");


*/
	
	?>