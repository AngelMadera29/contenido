<?php
session_start();
$path_website = $_SESSION['page_website'];
include ("$_SERVER[DOCUMENT_ROOT]/$path_website/comprobar_previsualizacion.php");
include  ("$_SERVER[DOCUMENT_ROOT]/$path_website/administracion/db/BBDD.php");
$base1 = "$_SERVER[DOCUMENT_ROOT]/$path_website/administracion/db/bbdd.db";
$base2 = "$_SERVER[DOCUMENT_ROOT]/$path_website/administracion/db/registros.sqlite"; 
$auth = new Autorizador(); 
$bbdd = new Base_de_datos("$base1","$base2");
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 0 ){exit;}
$nivel = $_SESSION['nivel'];

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

<html>
<head>
    <title>Noticias</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/examples.css">
    <script src="assets/jquery.min.js"></script>  
    <link rel="stylesheet" href="assets/js/date/jquery-ui.css">
	<script src="assets/js/date/jquery-ui.js"></script> 
	<link rel="stylesheet" href="assets/js/date/style.css">
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/ga.js"></script>

     </head>     
<body>
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Modificación de Ofertas</h4>
            </div>
            <div class="modal-body">
	            		 							 						
	<?php
echo "<div class='container' id='foto'>";  
if($fotografia == "sin_imagen.jpg"){
echo "<p>";
}
if($fotografia != "" && $fotografia != "sin_imagen.jpg"){
  echo "<img  src='administracion/db/imagenes/$fotografia' class='img-thumbnail'  width='300' height='200'> ";
}if($video_id != "" ){
$filename = preg_replace('"\.mp4$"', '.gif', $video_id);	
	$fichero_gif="administracion/db/previsualizaciones/$filename";
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

$contenido =  "
  <div class='input-group'>
    <span class='input-group-addon'>ID</span>
    <input id='id' type='text' class='form-control' name='id' value='<?php echo $id;?>' placeholder='Nombre del articulo' maxlength='30' required>
  </div>";
$auth->autorizar("ofertas","id",$contenido,$nivel);

    ?>
        <p>
  <div class="input-group">
    <span class="input-group-addon">Nombre articulo</span>
    <input id="articulo" type="text" class="form-control" name="articulo" value="<?php echo $articulo;?>" placeholder="Nombre del articulo" maxlength="30" required>
  </div>
    <p>
  <div class="input-group">
    <span class="input-group-addon">Precio</span>
    <input id="precio" type="text" class="form-control" name="precios" value="<?php echo $precio;?>" placeholder="Precio" maxlength="30" required>
  </div>
        <p>
  <div class="input-group">
    <span class="input-group-addon">Texto</span>
     <textarea id="texto" type="text" rows="3" class="form-control" name="texto" placeholder="Descripción" maxlength="30"><?php echo $texto;?></textarea>
  </div>
    <p>
    
    
    <?php
	    if($fotografia == "" && $video_id == "" || $id == ""){
	echo "<div class='input-group'>";
	echo "</div>";
		    
	    }if($id != ""){
	echo "<div class='input-group'>";
	echo "<span class='input-group-addon'>Archivo</span>";
	echo "<input type='file' class='form-control' name='fotografia' id='fotografia' onchange='previewFile()'  >";
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
        <p>
    
    <?php
if($id != ""){	
 echo " <div class='input-group'>
 <span class='input-group-addon'>Estilo</span>
	&nbsp;&nbsp;&nbsp;";
 	 
$resultado = $bbdd->consulta("SELECT * FROM estilos ORDER by estilo ASC","SELECT","ESTILOS",session_id()); //replace exec with query
echo '<select class="form-control" name="id_estilo" id="id_estilo" >';
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

		 							        
<?php
 	  echo " <div class='input-group'>
 	  <span class='input-group-addon'>Video</span>
	&nbsp;&nbsp;&nbsp;";
$resultado = $bbdd->consulta("SELECT nombre FROM videos","SELECT","VIDEOS",session_id()); //replace exec with query
echo '<select class="form-control" name="video" id="video"  onchange="myFunction()" >';
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
    <p>


  <div class="input-group">
    <span class="input-group-addon">Fecha de inicio</span>
    <input id="fecha_inicio"  type="date" class="form-control" name="fecha_inicio" value="<?php echo $fecha_inicio;?>" required>
  </div>
   <script>
  $(function() {
    $( "#fecha_inicio" ).datepicker();
  });
  </script>
        <p>
  <div class="input-group">
    <span class="input-group-addon">Fecha Final</span>
    <input id="fecha_fin"  type="date" class="form-control" name="fecha_fin" value="<?php echo $fecha_fin;?>" required>
  </div>
   <script>
  $(function() {
    $( "#fecha_fin" ).datepicker();
  });
  </script>
    
      <p>
  
    <div class="input-group">
    <span class="input-group-addon">Momento inicial</span>
    <input id="momento_inicial" type="time" class="form-control" name="momento_inicial" value="<?php echo $momento_inicial;?>" class="timepicker">
  </div>
        <p>
        
  <div class="input-group">
    <span class="input-group-addon">Momento final</span>
    <input id="momento_final" type="time" class="form-control" name="momento_final" value="<?php echo $momento_final;?>" class="timepicker">
  </div>
      <p>
    
  <div class="input-group">
    <span class="input-group-addon">Retardo</span>
    <input id="retardo" type="text" class="form-control" name="retardo" value="<?php echo $retardo;?>" placeholder="Retardo" maxlength="20">
  </div>
    <p>
    
      <div class="input-group">
    <span class="input-group-addon">Duración</span>
    <input id="duracion" type="text" class="form-control" name="duracion" value="<?php echo $duracion;?>"  id="duracion" placeholder="Duración">
  </div>
    <p>
    
  <div class="input-group">
    <span class="input-group-addon">Canal</span>
    <input id="canal" type="text" class="form-control" name="canal" value="<?php echo $canal;?>" placeholder="Canal" required>
  </div>
    <p>
   
    <div class="modal-footer">
	    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>        
	    <button type="submit" class="btn btn-primary">Añadir</button>
    </div>
	
  </fieldset>
</form>

                
                
				
            </div>
        </div>
    </div>
</div>
</body>
</html>