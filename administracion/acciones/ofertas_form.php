<?php 
session_start();
include_once "comprobar_previsualizacion.php";
include_once "administracion/db/BBDD.php";
$auth = new Autorizador(); 
$bbdd = new Base_de_datos('administracion/db/bbdd.db','administracion/db/registros.sqlite');

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

	$resultado = $bbdd->consulta("SELECT * from ofertas where id = '".$id."'","SELECT","OFERTAS",session_id());
	//$logs = $bbdd->consulta("INSERT ");
	
	$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

$id = $res['id'];	
$articulo = $res['articulo'];
$precio = $res['precio'];	
$texto = $res['texto'];
$fotografia =$res['foto_id'];	
$video_id = $res['video_id'];
$fecha_inicio = $res['fecha_inicio'];	
$fecha_fin = $res['fecha_fin'];
$pases_pendientes = $res['pases_pendientes'];
$momento_inicial = $res['momento_inicial'];	
$momento_final = $res['momento_final'];
$retardo = $res['retardo'];	
$duracion = $res['duracion'];	
$canal = $res['canal'];	
$id_estilo = $res['id_estilo_animacion'];
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
<form class="form-horizontal" role="form" action="?page=ofertas_add" method="post" enctype="multipart/form-data">
				<input type="hidden" name="op" value="<?php echo $accion;?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">
  <fieldset>
    <legend>Agregar Noticias</legend>
<div class="row">
	 							<div class="col-md-6">
		 							
		 						
	<?php
echo "<div class='container' id='foto'>";  
if($fotografia != ""){
  echo "<img  src='administracion/db/imagenes/$fotografia' class='img-thumbnail'  width='300' height='200'> ";
}if($video_id != "" ){
	$fichero_gif="administracion/db/previsualizaciones/".replace_extension($video_id,"gif");
   echo "<img id='myImg' src='$fichero_gif' class='img-thumbnail'  width='300' height='200'> ";
}
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
<?php

$contenido =  "<div class='form-group'>
      <label for='inputEmail' class='col-lg-2 control-label' >ID</label>
      <div class='col-xs-4'>
        <input type='text' class='form-control' name='id' value='$id' id='id' placeholder='Id' maxlength='30' >
      </div>
    </div>";
$auth->autorizar("ofertas","id",$contenido,$nivel);

    ?>
        <div class="form-group">
	        <input type='text'  hidden='hidden' name='id_antiguo' value='<?php echo $id;?>' id='id_antiguo' maxlength='30' >
      <label for="inputEmail" class="col-lg-2 control-label" >Nombre articulo</label>
      <div class="col-xs-4">
        <input type="text" class="form-control" name="articulo" value="<?php echo $articulo;?>" id="articulo" placeholder="Articulo" maxlength="30" required>
      </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Precio</label>
      <div class="col-xs-4">
        <input type="text" class="form-control" name="precio" value="<?php echo $precio;?>" id="precio" placeholder="Precio" maxlength="20" required>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Texto</label>
      <div class="col-sm-4">
   <textarea class="form-control" rows="3" id="texto" name="texto" placeholder="Descripcion" equired="required"
  autocomplete="on" ><?php echo $texto;?></textarea>
      </div>
    </div>
    <?php
	    if($fotografia == "" && $video_id == "" || $id == ""){
	echo "<div class='form-group'>";
	echo "<label for='inputEmail' class='col-lg-2 control-label'></label>";
	echo "<div class='col-xs-4'>"   ;
	echo "</div>";
	echo "</div>";
		    
	    }if($id != ""){
	echo "<div class='form-group'>";
	echo "<label for='inputEmail' class='col-lg-2 control-label'>Archivo</label>";
	echo "<div class='col-xs-4'>"   ;
	echo "<input type='file' name='fotografia' id='fotografia' onchange='previewFile()'  >";
	echo "</div>";
	echo "</div>";
	}
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
    
    
    <?php
if($id != ""){	
 echo " <div class='form-group'>
	  <label for='inputEmail' class='col-lg-2 control-label'>Estilo</label>
	&nbsp;&nbsp;&nbsp;";
 	 
$resultado = $bbdd->consulta("SELECT * FROM estilos ORDER by estilo ASC","SELECT","ESTILOS",session_id()); //replace exec with query
echo '<select name="id_estilo" id="id_estilo" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$id_estilo)
            {
	            echo " selected='selected'";
            }
            echo ' placeholder="Estilos">';
            echo $row['estilo'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';    
    echo "</div>";
    }
    
    ?>




	 							</div>
	 							<div class="col-md-6">
		 							        
<?php
 	  echo " <div class='form-group'>
	  <label for='inputEmail' class='col-lg-2 control-label'>Video</label>
	&nbsp;&nbsp;&nbsp;";
$resultado = $bbdd->consulta("SELECT nombre FROM videos","SELECT","VIDEOS",session_id()); //replace exec with query
echo '<select name="video" id="video"  onchange="myFunction()" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['nombre'].'" ';
	        if ($row['nombre']==$video_id)
            {
	            echo " selected='selected'";
            }
            echo ' placeholder="Estilos">';
            echo $row['nombre'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';    
    echo "</div>";
	?>
<script>
function myFunction() {
	var x = document.getElementById("video").value;
	var file = x.replace(/\.[^\.]+$/, '.gif');
    document.getElementById("myImg").src = "administracion/db/previsualizaciones/"+file;
}
</script>

    
    
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Fecha de inicio</label>
      <div class="col-xs-4">
        <input type="date" id="fecha_inicio" name="fecha_inicio"  value="<?php echo $fecha_inicio;?>" id="fecha_nacimiento" placeholder="Fecha de inicio" required>
      </div>
    </div>
      <script>
  $(function() {
    $( "#fecha_inicio" ).datepicker();
  });
  </script>

<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Fecha final</label>
      <div class="col-xs-4">
        <input type="date" id="fecha_fin" name="fecha_fin"  value="<?php echo $fecha_fin;?>" id="fecha_fin" placeholder="Fecha final" required>
      </div>
    </div>
      <script>
  $(function() {
    $( "#fecha_fin" ).datepicker();
  });
  </script>
  
  <div class="form-group">
	  <label for="inputEmail" class="col-lg-2 control-label">Momento inicial</label>
	   <div class="col-xs-4">
<input type="time" id="momento_inicial" name="momento_inicial"  value="<?php echo $momento_inicial;?>" class="timepicker">
</div>
    </div>

        
  <div class="form-group">
	  <label for="inputEmail" class="col-lg-2 control-label">Momento final</label>
	   <div class="col-xs-4">
<input type="time" id="momento_final" name="momento_final"  value="<?php echo $momento_final;?>" class="timepicker">
</div>
    </div>


    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Retardo</label>
      <div class="col-xs-4">
        <input type="text" class="form-control" name="retardo" value="<?php echo $retardo;?>" id="retardo" placeholder="Retardo" maxlength="20" required>
      </div>
    </div>
    
    
<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Duración</label>
      <div class="col-xs-4">
	      	        <input type="text" class="form-control" name="duracion" value="<?php echo $duracion;?>" id="duracion" placeholder="Duración">
	 </div>
    </div>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Canal</label>
      <div class="col-xs-4">
	      	        <input type="text" class="form-control" name="canal" value="<?php echo $canal;?>" id="canal" placeholder="Canal">
	 </div>
    </div>
<div class="form-group">
      <div class="col-xs-4 col-lg-offset-2">
        <input type="button" name="Cancelar" value="Cancelar" onclick="location='?page=per'">
        <button type="submit" class="btn btn-primary">Añadir</button>
      </div>
    </div>
	 							</div>


  </fieldset>
</form>
	</body>
</html>