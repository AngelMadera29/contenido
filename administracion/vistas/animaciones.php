<?php
session_start();
include ('../db/BBDD.php');
$bbdd = new Base_de_datos('../db/bbdd.db','../db/registros.sqlite');

if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 0 ){exit;}
$nivel = $_SESSION['nivel'];


  //conexion a la base de datos mediante sqlite

$where =" 1=1 ";
$order_by="id";
$rows=25;
$current=1;
$limit_l=($current * $rows) - ($rows);
$limit_h=$limit_lower + $rows  ;


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
  	 animacion LIKE '".$search."%' OR 	
  	 descripcion LIKE '".$search."%') "; 
	}

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
   
//NOTE: No security here please beef this up using a prepared statement - as is this is prone to SQL injection
$sql="SELECT id, animacion,descripcion FROM animaciones";

	$result = $bbdd->consulta($sql,"SELECT","ANIMACIONES","$nivel");
	$results_array = $bbdd->resultado_completo(PDO::FETCH_ASSOC);
	$json = json_encode($results_array);
	$json = urldecode(stripslashes($json)); 
	//$nRows=$conn->query("SELECT count(*) FROM ofertas WHERE $where")->fetchColumn();   /* specific search then how many match */
		

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