<?php
	
include ("BBDD.php");

$bbdd = new Base_de_datos('bbdd.db');	

$bbdd->consulta("SELECT * FROM 'canales' LIMIT 0, 30","select","canales","");
while($bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
{
print_r($bbdd->resultado);
}
	
	?>