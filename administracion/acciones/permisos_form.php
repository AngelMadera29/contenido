<?php 
session_start();
include_once "comprobar_previsualizacion.php";
include_once "administracion/db/BBDD.php";
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

	$resultado = $bbdd->consulta("SELECT * from preferencias where id = '".$id."'","SELECT","PERMISOS",$nivel);
	//$logs = $bbdd->consulta("INSERT ");
	
	$res = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

$id = $res['id'];	
$accionp = $res['accion'];
$tablap = $res['tabla'];	
$nivelp = $res['nivel'];
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
<style>
div.fixed {
    position: fixed;
    bottom: 90;
    right: 0;
    width: 300px;
}
</style>
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
<form class="form-horizontal" role="form" action="?page=permisos_add" method="post" enctype="multipart/form-data">
				<input type="hidden" name="op" value="<?php echo $accion;?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">
			
<div class="container">        
 <div class="row">
	
  <fieldset>
    <legend>Agregar permisos</legend>
  </fieldset>
   <div class="col-sm-4">
   <h4>Seleccione nivel para el permiso</h4>
	   <!--  Aqui van los niveles que se pueden utilizar para establecer todos los permisos   -->
	<label for="inputEmail" class="col-lg-2 control-label">Nivel</label>
	<label class="radio-inline">
		<input type="radio"  id="nivelp" name="nivelp" value="1"  <?php if ($nivelp  == '1') {echo ' checked ';} ?>  /> 1
	</label>
	<br>
	<label for="inputEmail" class="col-lg-2 control-label">Nivel</label>
	<label class="radio-inline">
		<input type="radio"  id="nivelp" name="nivelp"  value="2"   <?php if ($nivelp  == '2') {echo ' checked ';} ?>  /> 2
	</label>
	<br>
	<label for="inputEmail" class="col-lg-2 control-label">Nivel</label>
	<label class="radio-inline">
  		<input type="radio"  id="nivelp" name="nivelp"  value="3"   <?php if ($nivelp  == '3') {echo ' checked ';} ?>   /> 3
  	</label>
   </div>
   <div class="col-sm-4">
	    <!--  Aqui van las acciones que se pueden utilizar para establecer todos los permisos   -->
	<h4>Seleccione la acción permitida a realizar</h4>
		<br>
		<select class="form-control" id="accion" name="accion" values="" placeholder="Seleccione alguna accion">
          	  <option><?php echo $accionp ?></option>
			  <option id="hidden_div1" style="display:block;" value="INSERT" >Insertar</option>
			  <option id="hidden_div2" style="display:block;" value="UPDATE" >Actualizar</option>
			  <option id="hidden_div3" style="display:block;" value="DELETE" >Eliminar</option>
			  <option  value="LOGIN" >Login</option>
			  <option  value="LOGOUT" >Logout</option>
			  <option id="hidden_div4" style="display:block;" value="BACKUP" >Respaldo</option>
		</select>
		<div id="hidden_div" style="display:block;"></div>

   </div> 
   <div class="col-sm-4">
	    <!--  Aqui van las tablas que se pueden utilizar para establecer todos los permisos   -->
	    <h4>Seleccione la acción permitida a realizar</h4>
		<br>
	   <?php
$resultado = $bbdd->consulta("SELECT name FROM sqlite_master WHERE type = 'table' and name NOT IN ('historico','sqlite_sequence','plantillas_de_estilos')","SELECT","TABLAS",$nivel); //replace exec with query
echo '<select class="form-control" name="tabla" id="tabla" onchange="showDiv(this)" >';
foreach($bbdd->resultado_completo(PDO::FETCH_ASSOC) as $row){
	        echo '<option value="'.$row['name'].'" ';
	        if ($row['name']==$tablap)
            {
	            echo " selected='selected'";
            }
            echo ' placeholder="name">';
            echo $row['name'];
                        echo '</option>';  
        } 
     echo '   </select></p> ';    
    echo "</div>";
		?> 

<script type="text/javascript">
function showDiv(select){
   if(select.value=='usuarios'){
    document.getElementById('hidden_div').style.display = "none";
     document.getElementById('hidden_div1').style.display = "none";
      document.getElementById('hidden_div2').style.display = "none";
       document.getElementById('hidden_div3').style.display = "none";
        document.getElementById('hidden_div4').style.display = "none";
   } else{
    document.getElementById('hidden_div').style.display = "block";

   }
} 
</script>

    </div>
 </div>
</div>	
<div class="fixed">
 <input type="button" name="Cancelar" value="Cancelar" onclick="location='?page=per'">
 <button type="submit" class="btn btn-primary">Añadir</button>
</div>
</form>
	</body>
</html