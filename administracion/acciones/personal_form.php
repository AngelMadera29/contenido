
<?php 
	session_start();
	$bbdd_tipo = "mysql";
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 0 ){exit;}
$nivel = $_SESSION['nivel'];

$direccion_ip="192.168.20.11";
if ($_SESSION['lector'] == "126")
{
	$direccion_ip="192.168.20.126";
}
//si el nivel de usuario es menor que cero y si visitante es diferente a SÍ este mostrara mensaje que no podra modificar este personal.
if ($_SESSION['nivel'] == 0 && $_GET['visitante'] !== "SÍ"){
echo '<script language="javascript">alert("No tiene permisos para editar esta persona");</script>'; 
echo "<script> window.location = '?page=per';</script>";
}
// si el nivel se usuario es menor que cero pero siviante es SÍ este podra acceder al formulario de visitante y modificar el personal.
if ($_SESSION['nivel'] == 0 && $_GET['visitante'] == "SÍ"){
	$id=$_GET['datos'];
	echo "<script> window.location = '?page=invitado_form&datos=$id';</script>";
	}

if (isset($_GET))
{
	$id=$_GET['datos'];
	if ($id != "")
	{


if ($bbdd_tipo=="sqlite"){	
	$conexion = new PDO("sqlite:administracion/db/bbdd.sqlite");
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$resultado = $conexion->query("SELECT * from personal where id = '".$id."'");
	$res = $resultado->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
}
if($bbdd_tipo=="mysql"){
	$conexion = new mysqli ("localhost","root","root","bbdd") or die("Error " . mysqli_error($conexion));
	$resultado = $conexion->query("SELECT * from personal where id = '".$id."'");
	$res = $resultado->fetch_assoc();
}

$id = $res['id'];	
$nombre1 = $res['nombre'];	
$apellido1 = $res['apellido1'];
$apellido2 = $res['apellido2'];
$nacimiento = $res['fecha_nacimiento'];	
$fijo = $res['telefono_fijo'];
$celular = $res['telefono_celular'];

$id_empresa= $res['id_empresa'];
$nc_empresa = $res['nc_empresa'];

$codigo_OP = $res['codigoOP'];
$empresa = $res['NombreL'];
$rfid = $res['rfid'];
$visitante = $res['visitante'];
$ubicacion = $res['ubicacion'];
$sangre = $res['tipo_sangre'];	
$IMSS = $res['seguro_social'];	
$monta = $res['dc3_montacargas'];	
$gruas = $res['dc3_gruas'];	
$cargo = $res['cargo'];	
$llamar = $res['emergencias'];	
$fotografia = $res['fotografia'];	
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
			    <form class="form-horizontal" role="form" action="?page=personal_add" method="post" enctype="multipart/form-data">
				<input type="hidden" name="op" value="<?php echo $accion;?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">
  <fieldset>
    <legend>Agregar Noticias</legend>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label" >ID</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="id" value="<?php echo $id;?>" id="id" placeholder="Id" maxlength="30" >
        <input type="text"  hidden="hidden" name="id_antiguo" value="<?php echo $id;?>" id="id_antiguo" maxlength="30" >
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label" >Nombre ficha</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="articulo" value="<?php echo $nombre1;?>" id="articulo" placeholder="Articulo" maxlength="30" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Precio</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="precio" value="<?php echo $apellido1;?>" id="precio" placeholder="Precio" maxlength="20" required>
      </div>
    </div>

<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Texto</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="texto" value="<?php echo $apellido2;?>" id="texto" placeholder="texto" maxlength="20" required>
      </div>
    </div>

<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Fecha de inicio</label>
      <div class="col-lg-10">
        <input type="date" id="fecha_inicio" name="fecha_inicio"  value="<?php echo $nacimiento;?>" id="fecha_nacimiento" placeholder="Fecha de inicio" required>
      </div>
    </div>
      <script>
  $(function() {
    $( "#fecha_inicio" ).datepicker();
  });
  </script>

<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Fecha final</label>
      <div class="col-lg-10">
        <input type="date" id="fecha_fin" name="fecha_fin"  value="<?php echo $nacimiento;?>" id="fecha_fin" placeholder="Fecha final" required>
      </div>
    </div>
      <script>
  $(function() {
    $( "#fecha_fin" ).datepicker();
  });
  </script>



<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Momento inicial</label>
      <div class="col-lg-10">
        <input type="date" id="momento_inicial" name="momento_inicial"  value="<?php echo $nacimiento;?>" id="momento_inicial" placeholder="Momento inicial" required>
      </div>
    </div>
      <script>
  $(function() {
    $( "#momento_inicial" ).datepicker();
  });
  </script>

<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Momento final</label>
      <div class="col-lg-10">
        <input type="date" id="momento_final" name="momento_final"  value="<?php echo $nacimiento;?>" id="momento_final" placeholder="momento final" required>
      </div>
    </div>
      <script>
  $(function() {
    $( "#momento_final" ).datepicker();
  });
  </script>


<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Retardo</label>
      <div class="col-lg-10">
	      	 <input type="text" class="form-control" name="retardo" value="<?php echo $ubicacion;?>" id="retardo" placeholder="retardo">
	 </div>
	 
    </div>
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Duración</label>
      <div class="col-lg-10">
	      	        <input type="text" class="form-control" name="duracion" value="<?php echo $IMSS;?>" id="duracion" placeholder="Duración">
	 </div>
    </div>
    
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Canal</label>
      <div class="col-lg-10">
	      	        <input type="text" class="form-control" name="canal" value="<?php echo $IMSS;?>" id="canal" placeholder="Canal">
	 </div>
    </div>
 
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Fotografia</label>
      <div class="col-lg-10">
	 	      
	      <input type="file" name="foto_id" id="fotografia" onchange="previewFile()"  >
	      
	     <img src=".$ruta." height="200" alt="Previsualizar imagen..">

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
      </div>
<div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="button" name="Cancelar" value="Cancelar" onclick="location='?page=per'">
        <button type="submit" class="btn btn-primary">Añadir</button>
      </div>
    </div>
  </fieldset>
</form>
	</body>
</html