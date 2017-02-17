<?php	
$db = new PDO('sqlite:bbdd.db');
$result = $db->query("SELECT video_id FROM ofertas "); //replace exec with query

foreach($result as $valor){
	
$nombre = $valor['video_id'];

$db3 = new PDO('sqlite:bbdd.db');
$db3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$insertar = $db3->exec("SELECT video_id
INTO videos
FROM ofertas");
}
?>

<script type="text/javascript">
<!--
var answer = confirm("Registros vaciados correctamente");
if (!answer){
window.location = "index.php";
}
//-->
</script>


















<img id="myImg" src="usuario.jpg" width="107" height="98">

<?php
	include_once "BBDD.php";

$bbdd = new Base_de_datos('bbdd.db');	
 	 
$resultado = $bbdd->consulta("SELECT foto_id FROM ofertas","select","estilos",""); //replace exec with query
echo '<select name="video" id="video"  onchange="myFunction()" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['foto_id'].'" ';
	        if ($row['foto_id']==$video)
            {
	            echo " selected='selected'";
            }
            echo ' placeholder="Estilos">';
            echo $row['foto_id'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';    
    echo "</div>";
	?>
<script>
function myFunction() {
	var x = document.getElementById("video").value;
    document.getElementById("myImg").src = "imagenes/"+ x;
}
</script>


















<?php
	
include_once "BBDD.php";

$bbdd = new Base_de_datos('bbdd.db');	
 

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



*/

// run query

$query = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = 3 ","select","estilos","");


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
	 echo $nombre_variable."-".$animacion."<br>";
	 $array_salida[$nombre_variable]=$animacion;
	

}
$returnString = http_build_query($array_salida);
echo $returnString;


  /*
//metodo que devuelve completamente dentro de un foreach toddos los datos seleccionados para la consulta
$result = $bbdd->consulta("select distinct plantillas_de_estilos.id_bloque, bloques.bloque
from plantillas_de_estilos 
left join bloques on 
plantillas_de_estilos.id_bloque= bloques.id","select","ofertas","");
$array = $bbdd->resultado_completo(PDO::FETCH_ASSOC);


*/

/*
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