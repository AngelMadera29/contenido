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

$resultado = $bbdd->consulta("SELECT * from estilos where id = '".$id."'","SELECT","ESTILOS","");
$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

$id_estilo = $res['id'];	
$estilo = $res['estilo'];
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
				<input type="hidden" name="id" value="<?php echo $id;?>">  
<fieldset>
	
    <legend>Nombre del estilo</legend>
    <?php
	    if($id_estilo!= "")	{ 
 echo " <div class='form-group'>
      <label for='inputEmail' class='col-lg-2 control-label'>Id</label>
      <div class='col-sm-2'>
        <input type='text' class='form-control' name='id' value=' $id_estilo'  id='id' placeholder='Id'>
      </div>
    </div> ";
    }
	?>
    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Nombre de estilo</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" name="estilo" value="<?php echo $estilo;?>"  id="estilo" placeholder="Nombre del estilo">
      </div>
    </div>
     <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Descripción</label>
      <div class="col-sm-4">
   <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder="Descripcion" equired="required"
  autocomplete="on" ><?php echo $descripcion;?></textarea>
      </div>
    </div>
</fieldset>	

<fieldset>
    <legend>Características estilo</legend> 
    <div class="row">
  <div class="col-sm-4">	
  <h3>Tipo de Bloque</h3>
	 <label for="inputEmail" class="control-label">Sección</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <?php	
if($id_estilo != ""){	 	 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 1 and id_bloque = 1","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT); 
$bloquea = $resp['id_bloque'];
 }
$resultado = $bbdd->consulta("SELECT * FROM bloques ORDER by bloque ASC","select","animaciones",""); //replace exec with query
echo '<select name="bloquea" id="bloquea" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$bloquea)
            {
	            echo " selected='selected'";
            }
            echo ' placeholder="Bloques">';
            echo $row['bloque'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';    
		 ?>
  </div>
  <div class="col-sm-4">	
   <h3>Animación Entrada</h3>  
 <?php
if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 1 and id_bloque = $bloquea","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$animacion = $resp['id_animacion'];
}

$bloquea = $resp['id_bloque'];
$resultado = $bbdd->consulta("SELECT * FROM animaciones ORDER by animacion ASC","select","animaciones",""); //replace exec with query
echo '<select name="fecha1" id="fecha1" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$animacion)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Animaciones">';
            echo $row['animacion'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';   
		 ?>
  </div>
  <div class="col-sm-4">	
  <h3>Animación Salida</h3>
 <?php
	 if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 2 and id_bloque = $bloquea","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$animacion = $resp['id_animacion'];
}
$resultado = $bbdd->consulta("SELECT * FROM animaciones ORDER by animacion ASC","select","animaciones",""); //replace exec with query
echo '<select name="fecha2" id="fecha2" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$animacion)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Animaciones">';
            echo $row['animacion'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';    
		 ?>
  </div>
 <hr align="left" noshade="noshade" size="2" width="100%" />
    <!-- una animacion de animacion -->
  <div class="col-sm-4">		 
	  <!-- una animacion de animacion-->  
	  <label for="inputEmail" class="control-label">Sección</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php 
		   if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 1 and id_bloque = 2","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT); 
$bloqueb = $resp['id_bloque']; 
}
		$resultado = $bbdd->consulta("SELECT * FROM bloques ORDER by bloque ASC","select","animaciones",""); //replace exec with query
echo '<select name="bloqueb" id="bloqueb" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$bloqueb)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Bloques">';
            echo $row['bloque'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';
		 ?> 
	</div>
  <div class="col-sm-4">	
	  <?php
		  if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 1 and id_bloque = $bloqueb","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$animacion = $resp['id_animacion'];
}		  		  
$resultado = $bbdd->consulta("SELECT * FROM animaciones ORDER by animacion ASC","select","animaciones",""); //replace exec with query
echo '<select name="titular1" id="titular1" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$animacion)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Animaciones">';
            echo $row['animacion'];
                        echo '</option>';  
        } 
     echo '   </select></p> '; 
 
		  ?>
  </div>
  <div class="col-sm-4">	
	   <?php
		   if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 2 and id_bloque = $bloqueb","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$animacion = $resp['id_animacion'];
}		  		  
$resultado = $bbdd->consulta("SELECT * FROM animaciones ORDER by animacion ASC","select","animaciones",""); //replace exec with query
echo '<select name="titular2" id="titular2" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$animacion)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Animaciones">';
            echo $row['animacion'];
                        echo '</option>';  
        } 
     echo '   </select></p> '; 
		   ?>
   </div>
<hr align="left" noshade="noshade" size="2" width="100%" />
	  <!-- una animacion de animacion-->
  <div class="col-sm-4">	
	  <label for="inputEmail" class="control-label">Sección</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php 
		   if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 1 and id_bloque = 3","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT); 
$bloquec = $resp['id_bloque']; 
		}   
$resultado = $bbdd->consulta("SELECT * FROM bloques ORDER by bloque ASC","select","animaciones",""); //replace exec with query
echo '<select name="bloquec" id="bloquec" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$bloquec)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Bloques">';
            echo $row['bloque'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';
		 ?>
 </div>
  <div class="col-sm-4">	
	 	 <?php
		 	 if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 1 and id_bloque = $bloquec","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$animacion = $resp['id_animacion'];
	}	  		  
$resultado = $bbdd->consulta("SELECT * FROM animaciones ORDER by animacion ASC","select","animaciones",""); //replace exec with query
echo '<select name="video1" id="video1" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$animacion)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Animaciones">';
            echo $row['animacion'];
                        echo '</option>';  
        } 
     echo '   </select></p> '; 
		 	 ?>
 	 </div>	 		 
  <div class="col-sm-4">
	 	 <?php
if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 2 and id_bloque = $bloquec","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$animacion = $resp['id_animacion'];
}		  		  
$resultado = $bbdd->consulta("SELECT * FROM animaciones ORDER by animacion ASC","select","animaciones",""); //replace exec with query
echo '<select name="video2" id="video2" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$animacion)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Animaciones">';
            echo $row['animacion'];
                        echo '</option>';  
        } 
     echo '   </select></p> '; 
		 	 ?>
 	 </div>
  <!-- una animacion de animacion -->
<hr align="left" noshade="noshade" size="2" width="100%" />
  <div class="col-sm-4">	
	  <label for="inputEmail" class="control-label">Sección</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php 
if($id_estilo!= "")	{ 		   
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_bloque = 4","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT); 
$bloqued = $resp['id_bloque']; 
}		   
$resultado = $bbdd->consulta("SELECT * FROM bloques ORDER by bloque ASC","select","animaciones",""); //replace exec with query
echo '<select name="bloqued" id="bloqued" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$bloqued)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Bloques">';
            echo $row['bloque'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';
		 ?>
  </div>
  <div class="col-sm-4">	
	 	 <?php
if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 1 and id_bloque = $bloqued","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$animacion = $resp['id_animacion'];
}		  		  
$resultado = $bbdd->consulta("SELECT * FROM animaciones ORDER by animacion ASC","select","animaciones",""); //replace exec with query
echo '<select name="noticia1" id="noticia1" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$animacion)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Animaciones">';
            echo $row['animacion'];
                        echo '</option>';  
        } 
     echo '   </select></p> '; 		 
     	 ?>
 	 </div>	 		 
  <div class="col-sm-4">
	 	 <?php
if($id_estilo!= "")	{ 
$resul = $bbdd->consulta("select * from plantillas_de_estilos where id_estilo = $id_estilo and id_tipo_animacion = 2 and id_bloque = $bloqued","select","estilos","");
$resp = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
$animacion = $resp['id_animacion'];
}		  		  
$resultado = $bbdd->consulta("SELECT * FROM animaciones ORDER by animacion ASC","select","animaciones",""); //replace exec with query
echo '<select name="noticia1" id="noticia1" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['id'].'" ';
	        if ($row['id']==$animacion)
            {
	            echo " selected='selected'";
            }

            echo ' placeholder="Animaciones">';
            echo $row['animacion'];
                        echo '</option>';  
        } 
     echo '   </select></p> '; 	
     		 	 ?>
 	 </div>
</div>

    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <input type="button" class="btn btn-danger"  name="Cancelar" value="Cancelar" onclick="location='?page=prueba_tablas'">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </fieldset>
</form>
	</body>
</html>
