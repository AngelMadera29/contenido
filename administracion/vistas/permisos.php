<?php
session_start();
include_once "administracion/acciones/comprobar_previsualizacion.php";
include_once "administracion/db/BBDD.php";
$auth = new Autorizador(); 

if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 0 ){exit;}
$nivel = $_SESSION['nivel'];
?>
	<!DOCTYPE html>
<html>
<head>
    <title>Noticias</title>
    <meta charset="utf-8">
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
      <script src="assets/bootstrap-table/src/extensions/flat-json/bootstrap-table-flat-json.js"></script>
        <script src="assets/ga.js"></script>
     </head>     
<body>
	<div class='row'>
	<?php

	echo "<div class='col-md-8'>";
echo "<h3> Noticias </h3>";


		  
echo  "<a href='?page=permisos_form' class='btn btn-primary'>Añadir Permisos</a> ";

$contenido = "<button id='show' class='btn btn-danger' disabled>Vaciar Permisos</button>";
$auth->autorizar("ofertas","botones",$contenido,$nivel);
	 echo "&nbsp";

	 ?>
	 <a href="#" onClick ="$('#table').tableExport({type:'pdf',escape:'false'});" class="btn btn-success">PDF</a>

	</div>
		 	 	
        <table id="table"
             data-search="true"
          	 data-show-refresh="true"
          	 data-show-columns="true"
             data-show-toggle="true"
	     	 data-toggle="table"
		     data-height="480"
			 data-flat="true"
		     data-cookie="true"
             data-show-refresh="true"
	         data-toolbar="#toolbar"
		     data-show-columns="true"
             data-query-params="queryParams"
             data-pagination="true"
	         data-page-list="[10, 25, 50, 100, ALL]"
	         data-filter-control="true" 
	         data-show-export="true"
		     data-maintain-selected="true"
			 data-toolbar="#show"
			 data-flat="true"
             data-url="administracion/vistas/permiso.php">
         <thead>

            <tr>
	            <th data-field="state" data-checkbox="true"></th>
                <th data-field="id">id</th>
                
                <th data-formatter="dataFormater" data-width="90">Acción</th>
                
				<th data-field="accion" data-filter-control="input">Acción</th> 
				<th data-field="tabla" data-filter-control="input">Tabla</th> 
				<th data-field="nivel" data-filter-control="input">Nivel</th> 

            </tr>
            </thead>
        </table> 
    </div>
    
     <script>
    var $table = $('#table'),
        $button = $('#show');
        
        $(function () {
        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $button.prop('disabled', !$table.bootstrapTable('getSelections').length);
        });

    $(function () {
        $button.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id;
            });
						
      borrar=confirm("Eliminar personal seleccionado : " + ids);
       if(borrar)
       window.location = "index.php?page=vaciado-permisos&datos=" + ids;
       //enviar parametro post get 
            else
      alert('No se ha podido eliminar el personal..');
      
 $('#table').bootstrapTable('refresh', {url: 'administracion/vistas/permiso.php'});
        });
    });
 });
</script>  


    <script>
    var $table = $('#table'),
        $button = $('#show');
        $edit = $('#edit');
    
    function dataFormater(value, row, index) {

        var id = row.id;

        var strHTML = "<div>";
         strHTML += "<a href='index.php?page=permisos_form&datos=" + id + "' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Editar</a>";
        strHTML += "</div>";

        var valReturn = strHTML;

        return valReturn;
    }
   
    $(function () {
        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $button.prop('disabled', !$table.bootstrapTable('getSelections').length);
    });
    
    $(function () {
        $button.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id;
            });
    
 $('#table').bootstrapTable('refresh', {url: 'administracion/vistas/permiso.php'});
        });
    });
 });
</script>

   		
<script type="text/javascript" src="assets/export/tableExport.js"></script>
<script type="text/javascript" src="assets/export/jquery.base64.js"></script>
<script type="text/javascript" src="assets/export/libs/FileSaver/FileSaver.min.js"></script>
<!-- to pdf -->

<script type="text/javascript" src="assets/export/libs/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="assets/export/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
</body>
</html>
