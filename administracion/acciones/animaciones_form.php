<?php 
session_start();
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

	$resultado = $bbdd->consulta("SELECT * from animaciones where id = '".$id."'","select","animaciones","");
	$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

$id = $res['id'];	
$animacion = $res['animacion'];
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
		
<form class="form-horizontal" role="form" action="?page=estilos_add" method="post" enctype="multipart/form-data">
				<input type="hidden" name="op" value="<?php echo $accion;?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">  <fieldset>
    <legend>Agregar Animación</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Animacion</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="animacion" value="<?php echo $animacion;?>"  id="animacion" placeholder="Tipo de animación">
      </div>
    </div>
     <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Descripcion</label>
      <div class="col-lg-10">
   <textarea class="form-control" rows="5" id="descripcion" name="descripcion"  value="<?php echo $descripcion;?>"  placeholder="Descripcion" equired="required"
  autocomplete="on" ></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="button" name="Cancelar" value="Cancelar" onclick="location='?page=prueba_tablas'">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>
	</body>
</html>
