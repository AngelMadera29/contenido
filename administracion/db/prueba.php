  <?php

include ('../db/LOGS.php');

$log = new registros('../db/registros.sqlite');



$contenido = "SELECT * FROM logs";


$result = $log->consulta($contenido);

$results_array = $log->resultado_completo(PDO::FETCH_ASSOC);
$json = json_encode($results_array);
$json = urldecode(stripslashes($json)); 
 	echo $json;
 	?>