<?php
session_start();
$bbdd_tipo ="sqlite";
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
  	 articulo LIKE '".$search."%' OR 
  	  precio LIKE '".$search."%' OR 
  	  texto LIKE '".$search."%'OR
  	    foto_id LIKE '".$search."%' OR
  	     video_id LIKE '".$search."%' OR 
  	      fecha_inicio LIKE '".$search."%' OR
  	       fecha_fin LIKE '".$search."%' OR
  	        pases_pendientes LIKE '".$search."%' OR
  	         momento_inicial LIKE '".$search."%' OR 
  	         momento_final LIKE '".$search."%' OR 
  	         retardo LIKE '".$search."%' OR
  	          duracion LIKE '".$search."%' OR 
  	          canal LIKE '".$search."%' OR
  	             emergencias LIKE '".$search."%') "; 
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
$sql="SELECT id,articulo,precio,texto,foto_id,video_id,fecha_inicio,fecha_fin,pases_pendientes,momento_inicial,momento_final,retardo,duracion,canal FROM ofertas";

if ($bbdd_tipo=="sqlite")
{
	$conn = new PDO("sqlite:../db/bbdd.db");  // SQLite Database
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$results_array=$stmt->fetchAll(PDO::FETCH_ASSOC);
	$nRows=$conn->query("SELECT count(*) FROM ofertas WHERE $where")->fetchColumn();   /* specific search then how many match */
	$json=json_encode( $results_array );
	//echo "se conecto con mysqli";
	
		//echo "se conecto con sqlite";
}
if ($bbdd_tipo=="mysql")
{
	$bbdd = new mysqli ("localhost","root","root","bbdd");
	$result = mysqli_query($bbdd, $sql) or die("Error in Selecting " . mysqli_error($bbdd));
	$emparray = array();
	    while($row = mysqli_fetch_assoc($result))
	    {
	        $emparray[] = array_map('utf8_encode', $row);;
	    }
	$numeros = "SELECT count(*) FROM personal WHERE $where";
	$numero = mysqli_query($bbdd, $numeros) or die(mysqli_error($bbdd));
	$nRows = $numero->fetch_row();
	$json = json_encode($emparray, JSON_UNESCAPED_UNICODE);
	$json = urldecode(stripslashes($json)); 

	
}

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