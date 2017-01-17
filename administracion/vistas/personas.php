<?php
session_start();
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
	 if ($nivel == 0){	 
echo "<a href='?page=invitado_form' class='btn btn-primary'>Añadir invitado</a> "; 
	 }else{
echo "";
	 }
	 ?>
	 <?php
	 if ($nivel >= 1){	 
echo "<a href='?page=invitado_form' class='btn btn-info'>Añadir invitado</a> "; 
echo "<a href='?page=personal_form' class='btn btn-primary'>Añadir personal</a> ";
echo "<button id='show' class='btn btn-danger' disabled>Vaciar registros</button>";
	 }else{
echo "";
	 }
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
             data-url="administracion/vistas/personal.php">
         <thead>

            <tr>
	            <th data-field="state" data-checkbox="true"></th>
                <th data-field="id">id</th>
                
                <th data-formatter="dataFormater" data-width="90">Accion</th>
                
                <th data-field="foto_id"  data-formatter="imageFormatter">Foto</th>
                
				<th data-field="articulo" data-filter-control="input">Articulo</th> 
				<th data-field="precio" data-filter-control="input">Precio</th> 
				<th data-field="texto" data-filter-control="input">Texto</th> 
				<th data-field="video_id" data-filter-control="select" >Video</th>
				<th data-field="fecha_inicio" >Fecha I.</th>
				<th data-field="fecha_fin" >Fecha F.</th>
				<th data-field="pases_pendientes" data-filter-control="select" >Pases P.</th>	
				<th data-field="momento_inicial" >Momento I.</th>
				<th data-field="momento_final" >Momento F.</th>
				<th data-field="retardo" data-filter-control="select">Retardo</th>
				<th data-field="duracion" >Duracion</th>
				<th data-field="canal" >Canal</th>
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
       window.location = "index.php?page=vaciado-personal&datos=" + ids;
       //enviar parametro post get 
            else
      alert('No se ha podido eliminar el personal..');
      
 $('#table').bootstrapTable('refresh', {url: 'administracion/vistas/personal.php'});
        });
    });
 });
</script>  


    <script>
    var $table = $('#table'),
        $button = $('#show');
        $edit = $('#edit');
        
	function imageFormatter(value, row) {
      return "<img width=50 src='administracion/db/imagenes/" + value + "'>";
    }
    
    function dataFormater(value, row, index) {

        var id = row.id;
        var visitante = row.visitante;

        var strHTML = "<div>";
         strHTML += "<a href='index.php?page=personal_form&datos=" + id + "&visitante="+ visitante +"' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Editar</a>";
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
    
 $('#table').bootstrapTable('refresh', {url: 'administracion/vistas/personal.php'});
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
