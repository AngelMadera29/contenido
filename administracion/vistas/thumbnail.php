<?php 
session_start();
include_once "administracion/db/BBDD.php";
$bbdd = new Base_de_datos('administracion/db/bbdd.db','administracion/db/registros.sqlite');
 if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 0 ){exit;}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>vista de habitaciones</title>


 </head>
 <body>
 <div class="row" style="padding:1% 2%">
 <?php 
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	$results_per_page = 8;
	$start_from = ($page-1) * $results_per_page;
	$sql = "select * from ofertas order by id asc limit  $start_from, ".$results_per_page;
	echo $sql;
	$resultado = $bbdd->consulta($sql,"SELECT","ESTILOS",session_id()); //replace exec with query
	
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $vista)
{
	echo '<div id="container-folio_'.$vista['id'].'" style="position:relative">'.
	'<div class="box col-xs-12 col-md-4 col-sm-6 col-lg-3">'.
	'<div class="thumbnail">'.
	'<img class="img-responsive" src="../administracion/db/imagenes/'.$vista['foto_id'].'" alt="">'.
	'<div class="caption">'.
	'<h3><p>'.$vista['articulo'].'<br>'.$vista['texto'].'</p></h3>'.
	'<span class="meta">'.
	'<i class="fa-icon-calendar"></i> January 1, 2013'.
	'</span>'.
	'<p> 
	<a href="index.php?page=ofertas_form&datos='.$vista['id'].'" class="btn btn-primary" role="button" style="width:100%">Editar</a>
	</p>'.
	'</div>'.
	'</div>'.
	'</div>'.
	'</div>';
	
}
?>

<?php 
$sql = "SELECT COUNT(ID) AS total FROM ofertas ";
$result = $bbdd->consulta($sql,"SELECT","OFERTAS",session_id()); 
$row = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results 
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
            echo "<a href='vistas/thumbnail.php?page=thumb?page=".$i."'";
            if ($i==$page)  echo " class='curPage'";
            echo ">".$i."</a> "; 
}; 
?>

   

</div>

 </body>
 </html