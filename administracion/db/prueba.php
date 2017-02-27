  <?php
session_start();
include ('../db/BBDD.php');

$bbdd = new Base_de_datos('../db/bbdd.db','../db/registros.sqlite');
$auth = new Autorizador();    
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 0 ){exit;}
$nivel = $_SESSION['nivel'];
$id_usuario = $_SESSION['id'];

$contenido = "SELECT * FROM ofertas";
$consulta = $auth->autorizar("ofertas","consulta",$contenido,$nivel);

$result = $bbdd->consulta($consulta,"SELECT","OFERTAS",$nivel);

$results_array = $bbdd->resultado_completo(PDO::FETCH_ASSOC);
$json = json_encode($results_array);
$json = urldecode(stripslashes($json)); 
 	echo $json;
 	?>