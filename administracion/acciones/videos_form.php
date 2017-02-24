<?php 
session_start();
include_once "comprobar_previsualizacion.php";
include_once "administracion/db/BBDD.php";
$bbdd = new Base_de_datos('administracion/db/bbdd.db');
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 0 ){exit;}
$nivel = $_SESSION['nivel'];

$direccion_ip="192.168.20.11";
if ($_SESSION['lector'] == "126")
{
	$direccion_ip="192.168.20.126";
}

if (isset($_GET))
{
	$id=$_GET['datos'];
	if ($id != "")
	{

	$resultado = $bbdd->consulta("SELECT * from videos where id = '".$id."'","SELECT","VIDEOS","");
	$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

$id = $res['id'];	
$nombre = $res['nombre'];
$descripcion = $res['descripcion'];	

		}		
		
}
if ($id!='')
	$accion="update";
else
	$accion="insert";
	
?>
<!DOCTYPE html>
<html>
	<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="assets/examples.css">
    
       <link rel="stylesheet" href="assets/css/wickedpicker.css">
       
    <script src="assets/jquery.min.js"></script>  
    <link rel="stylesheet" href="assets/js/date/jquery-ui.css">
	<script src="assets/js/date/jquery-ui.js"></script> 
	<link rel="stylesheet" href="assets/js/date/style.css">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
    <script src="assets/bootstrap-table/src/extensions/editable/bootstrap-table-editable.js"></script>    
    <script src="assets/bootstrap-table/src/extensions/filter-control/bootstrap-table-filter-control.js"></script>
    <script src="assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
    <script src="assets/ga.js"></script>
    
          <script src="assets/js/jquery-1.12.4.min.js"></script> 
        <script type="text/javascript" src="assets/js/wickedpicker.js"></script>
        
	</head>
	<body>
<form class="form-horizontal" role="form" action="?page=videos_add" method="post" enctype="multipart/form-data">
				<input type="hidden" name="op" value="<?php echo $accion;?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">
  <fieldset>
    <legend>Agregar Noticias</legend>
<div class="row" >
<div class="col-md-12">		 							
<?php
echo "<div  style='width:800px; margin:0 auto;'  class='container' id='foto'>";  
	$fichero_gif="administracion/db/previsualizaciones/".replace_extension($nombre,"gif");
   echo "<img id='myImg' src='$fichero_gif' class='img-thumbnail'  width='300' height='200'> ";
echo "</div>";
  ?>
<script>
  function placeDiv(x_pos, y_pos) {
  var d = document.getElementById('foto');
  d.style.position = "absolute";
  d.style.left = x_pos+'2000px';
  d.style.top = y_pos+'30px';
}
	</script>
<br>
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label" >ID</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="id" value="<?php echo $id;?>" id="id" placeholder="Id" maxlength="30" >
        <input type="text"  hidden="hidden" name="id_antiguo" value="<?php echo $id;?>" id="id_antiguo" maxlength="30" >
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Descripcion</label>
      <div class="col-sm-4">
   <textarea class="form-control" rows="3" id="texto" name="Texto" placeholder="Descripcion" equired="required" autocomplete="on" ><?php echo $texto;?></textarea>
      </div>
    </div>
    <?php
	   
	echo "<div class='form-group'>";
	echo "<label for='inputEmail' class='col-lg-2 control-label'></label>";
	echo "<div class='col-xs-4'>"   ;
	echo "</div>";
	echo "</div>";		    
	echo "<div class='form-group'>";
	echo "<label for='inputEmail' class='col-lg-2 control-label'>Archivo</label>";
	echo "<div class='col-xs-4'>"   ;
	echo "<input type='file' name='video' id='video' onchange='previewFile()'  >";
	echo "</div>";
	echo "</div>";
	
	     ?>
<script type="text/javascript">
        function previewFile() {
  var preview = document.querySelector('img');
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}
    </script> 
    
	<div class="form-group">
      <div class="col-xs-4 col-lg-offset-2">
        <input type="button" name="Cancelar" value="Cancelar" onclick="location='?page=videos'">
        <button type="submit" class="btn btn-primary">Añadir</button>
      </div>
    </div>
</div>


  </fieldset>
</form>
	</body>
</html