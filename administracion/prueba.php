<?php
	
include ("BBDD.php");

$bbdd = new Base_de_datos('bbdd.db');	

$bbdd->consulta("SELECT * FROM 'canales' LIMIT 0, 30","select","canales","");

/*
while($bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
{
print_r($bbdd->resultado);
$row = count($bbdd->resultado);
echo "numero de rows: $row";

}
*/


$result = $bbdd->consulta("SELECT * FROM usuarios where id = 36","select","canales","");
$row = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$nombre = $row['nombre'];

	echo "User :$nombre\n nivel: {$row['nivels']}<br>";	


/*
	
$bbdd->consulta("INSERT INTO 'canales' (id,peso,restante) VALUES ('8','10',30) ","insert","canales","");

$bbdd->consulta("SELECT * FRFOM usuarios","select","usuarios","")
while($bbdd->obtener_resutado($bbdd)){
	
}

$bbdd->consulta("UPDATE canales set peso = 20,restante = 20 where id = 8","update","canales","");


*/
	
	?>