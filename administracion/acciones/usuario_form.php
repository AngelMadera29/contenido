<?php 	
session_start();
include_once "administracion/db/BBDD.php";
$bbdd = new Base_de_datos('administracion/db/bbdd.db');
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 2 ){exit;}
if (isset($_GET))
{
	$id=$_GET['datos'];
	if ($id != "")
	{


	$resultado = $bbdd->consulta("SELECT * from usuarios where id = '".$id."'","SELECT","USUARIOS","");
	$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

$nombre = $res['nombre'];
$sha_pass = $res['sha_pass'];
$nivel = $res['nivel'];

	}
}
if ($id!=''){
	$accion="actualizar";
}else{
	$accion="insert";
	}
?>
<!DOCTYPE html>

<html>
	<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="assets/examples.css">
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
	</head>
	<body>
			<form class="form-horizontal" role="form" action="?page=usuario_add" method="post">
				<input type="hidden" name="op" value="<?php echo $accion;?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">

  <fieldset>
    <legend>Agregar personal</legend>
 <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Nombre de usuario</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="nombre" value="<?php echo $nombre;?>"  id="nombre" placeholder="Nombres" required="required"
  autocomplete="on" >
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Contraseña</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" name="sha_pass" value="<?php echo $sha_pass;?>"  id="sha_pass" placeholder="Contraseña">
      </div>
    </div>
     <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Nivel</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="nivel" value="<?php echo $nivel;?>"  id="nivel" placeholder="Nivel" required="required"
  autocomplete="on" >
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="button" name="Cancelar" value="Cancelar" onclick="location='?page=usr'">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>
	</body>
</html>
