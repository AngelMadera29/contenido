<?php
session_start();

include ('../db/LOGS.php');

$log = new registros('../db/registros.sqlite');   

$nivel = $_SESSION['nivel'];
$id_usuario = $_SESSION['id'];

  //conexion a la base de datos mediante sqlite
$where =" 1=1 ";
$order_by="id";
$rows=25;
$current=1;
$limit_l=($current * $rows) - ($rows);
$limit_h=$limit_lower + $rows  ;


if ($_GET['ff'])
{ 
	// $_SESSION['fecha_inicio']='2016-07-01';
	$_SESSION["fecha_inicio"]=$_GET['fi'];
	$_SESSION["fecha_fin"]=$_GET['ff'];
	exit;
	// $_SESSION['fecha_fin']='2016-07-01';
}	 
	 if ($_SESSION['fecha_fin']!= "")
	 {
		 $fechas=" fecha between '".$_SESSION['fecha_inicio']."' AND '".$_SESSION['fecha_fin']."'";
	 }
	 else
	 	 $fechas="1";


//Handles Sort querystring sent from Bootgrid
if (isset($_REQUEST['sort']) && is_array($_REQUEST['sort']) )
  {
    $order_by="";
    foreach($_REQUEST['sort'] as $key=> $value)
		$order_by.=" $key $value";
	}

//Handles search  querystring sent from Bootgrid 
if (isset($_REQUEST['searchPhrase']) )
  {
    $search=trim($_REQUEST['searchPhrase']);
  	$where.= " AND ( id LIKE '".$search."%' OR 
  	  usuario LIKE '".$search."%' OR 
  	  fecha LIKE '".$search."%' OR
  	  accion LIKE '".$search."%' OR
  	  tabla LIKE '".$search."%'OR
  	  descripcion LIKE '".$search."%') "; 	}

//Handles determines where in the paging count this result set falls in
if (isset($_REQUEST['rowCount']) )  
  $rows=$_REQUEST['rowCount'];

 //calculate the low and high limits for the SQL LIMIT x,y clause
  if (isset($_REQUEST['current']) )  
  {
   $current=$_REQUEST['current'];
	$limit_l=($current * $rows) - ($rows);
	$limit_h=$rows ;
   }

if ($rows==-1)
$limit="";  //no limit
else   
$limit=" LIMIT $limit_l,$limit_h  ";
   
//NOTE: No security here please beef this up using a prepared statement - as is this is prone to SQL injection.
$contenido="SELECT id, usuario, fecha, accion, descripcion FROM logs WHERE $fechas";

$result = $log->consulta($contenido,"SELECT","OFERTAS",$nivel);


$results_array = $log->resultado_completo(PDO::FETCH_ASSOC);
$json = json_encode($results_array);
$json = urldecode(stripslashes($json)); 


header('Content-Type: application/json'); //tell the broswer JSON is coming

if (isset($_REQUEST['rowCount']) )  //Means we're using bootgrid library
{
	$salida="{ \"current\":  $current, \"rowCount\":$rows,  \"rows\": ".$json.", \"total\": $nRows }";
	//file_put_contents('out.txt', $salida);
	echo $salida;
}
else
{
	echo $json;  //Just plain vanillat JSON output 
}
exit;

?>