<?php
	session_start();
if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 0 ){exit;}
$nivel = $_SESSION['nivel'];	
	?>
<!DOCTYPE html>
<html>
<head>
    <title>Multiple Table</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="assets/examples.css">
    <script src="assets/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="ga.js"></script>
    <link rel="stylesheet" href="assets/js/date/jquery-ui.css">
	<script src="assets/js/date/jquery-ui.js"></script> 
	<link rel="stylesheet" href="assets/js/date/style.css">
    <script src="assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
    <script src="assets/bootstrap-table/src/extensions/editable/bootstrap-table-editable.js"></script>    
    <script src="assets/bootstrap-table/src/extensions/filter-control/bootstrap-table-filter-control.js"></script>
    <script src="assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
    <script src="assets/bootstrap-table/src/extensions/flat-json/bootstrap-table-flat-json.js"></script>
</head>
<body>
    <div class="container">        
        <div class="row">
	        
    <div class="col-sm-4">
	<div id="toolbar1">
       <a href='?page=animaciones_form' class='btn btn-primary'>Añadir animacion</a>
       <button id='show' class='btn btn-danger' disabled>vaciar Animaciones</button>
    </div>
			<table id="tableAnimacion"
	         data-toggle="table"
	         data-search="true"
		     data-height="480"
			 data_width="480"
			 data-flat="true"
		     data-cookie="true"             
	         data-toolbar="#toolbar1"
             data-query-params="queryParams"
             data-pagination="true"
	         data-page-list="[10, 25, 50, 100, ALL]"
		     data-maintain-selected="true"
			 data-toolbar="#show"
			 data-flat="true"
             data-url="administracion/vistas/animaciones.php">
            <thead>
                    <tr>
	            <th data-field="state" data-checkbox="true"></th>
                <th data-field="id" >Id</th>
                <th data-formatter="dataFormater" data-width="40">Accion</th>
                <th data-field="animacion"  >Animacion</th>
				<th data-field="descripcion">Descripcion</th> 
                    </tr>
                    </thead>
                </table>               
<script>
    var $table = $('#tableAnimacion'),
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
						
      borrar=confirm("Eliminar animacion seleccionado : " + ids);
       if(borrar)
       window.location = "index.php?page=del_animacion&datos=" + ids;
       //enviar parametro post get 
            else
      alert('No se ha podido eliminar el personal..');
      
 $('#tableAnimacion').bootstrapTable('refresh', {url: 'administracion/vistas/animaciones.php'});
        });
    });
 });
</script>  
<script>
    var $table = $('#tableAnimacion'),
        $button = $('#show');
        $edit = $('#edit');
  
  
      function dataFormater(value, row, index) {

        var id = row.id;

        var strHTML = "<div>";
         strHTML += "<a href='index.php?page=animaciones_form&datos=" + id + "' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Editar</a>";
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
    
 $('#tableAnimacion').bootstrapTable('refresh', {url: 'administracion/vistas/animaciones.php'});
        });
    });
 });
</script>
    	</div>
         
    <div class="col-sm-4">
	<div id="toolbar2">
       <a href='?page=bloques_form' class='btn btn-primary'>Añadir Bloque</a>
       <button id='show1' class='btn btn-danger' disabled>vaciar Bloques</button>
    </div>
             <table id="tablebloque"
	         data-toggle="table"
	         data-search="true"
		     data-height="480"
			 data_width="480"
			 data-flat="true"
		     data-cookie="true"             
	         data-toolbar="#toolbar2"
             data-query-params="queryParams"
             data-pagination="true"
	         data-page-list="[10, 25, 50, 100, ALL]"
		     data-maintain-selected="true"
			 data-toolbar="#show"
			 data-flat="true"
                       data-url="administracion/vistas/bloques.php">
                    <thead>
                    <tr>
	            <th data-field="state" data-checkbox="true"></th>
                <th data-field="id" >Id</th>
                <th data-formatter="dataFormater" data-width="40">Accion</th>
                <th data-field="bloque"  >Bloque</th>
				<th data-field="descripcion">Descripción</th> 
                    </tr>
                    </thead>   
                </table>
<script>
    var $table = $('#tablebloque'),
        $button = $('#show1');
        
        $(function () {
        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $button.prop('disabled', !$table.bootstrapTable('getSelections').length);
        });

    $(function () {
        $button.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id;
            });
						
      borrar=confirm("Eliminar bloques seleccionado : " + ids);
       if(borrar)
       window.location = "index.php?page=del_bloques&datos=" + ids;
       //enviar parametro post get 
            else
      alert('No se ha podido eliminar el bloque..');
      
 $('#tablebloque').bootstrapTable('refresh', {url: 'administracion/vistas/bloques.php'});
        });
    });
 });
</script>  
<script>
    var $table = $('#tablebloque'),
        $button = $('#show1');
        $edit = $('#edit');
  
  
      function dataFormater(value, row, index) {

        var id = row.id;

        var strHTML = "<div>";
         strHTML += "<a href='index.php?page=bloques_form&datos=" + id + "' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Editar</a>";
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
    
 $('#tablebloque').bootstrapTable('refresh', {url: 'administracion/vistas/bloques.php'});
        });
    });
 });
</script>
    </div>
          
	<div class="col-sm-4">
	<div id="toolbar3">
       <a href='?page=estilos_form' class='btn btn-primary'>Añadir Estilo</a>
       <button id='show2' class='btn btn-danger' disabled>vaciar Estilo</button>
    </div>
            <table id="tableEstilos"
	         data-toggle="table"
	         data-search="true"
		     data-height="480"
			 data_width="480"
			 data-flat="true"
		     data-cookie="true"             
	         data-toolbar="#toolbar3"
             data-query-params="queryParams"
             data-pagination="true"
	         data-page-list="[10, 25, 50, 100, ALL]"
		     data-maintain-selected="true"
			 data-toolbar="#show"
			 data-flat="true"
                       data-url="administracion/vistas/plantillas.php">
                    <thead>
                    <tr>
	            <th data-field="state" data-checkbox="true"></th>
                <th data-field="id" >Id</th>
                <th data-formatter="dataFormater" data-width="40">Accion</th>
                <th data-field="estilo"  >Bloque</th>
				<th data-field="descripcion">Descripción</th> 
                    </tr>
                    </thead>               
            </table>
<script>
    var $table = $('#tableEstilos'),
        $button = $('#show2');
        
        $(function () {
        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $button.prop('disabled', !$table.bootstrapTable('getSelections').length);
        });

    $(function () {
        $button.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id;
            });
						
      borrar=confirm("Eliminar bloques seleccionado : " + ids);
       if(borrar)
       window.location = "index.php?page=del_estilos&datos=" + ids;
       //enviar parametro post get 
            else
      alert('No se ha podido eliminar el bloque..');
      
 $('#tableEstilos').bootstrapTable('refresh', {url: 'administracion/vistas/plantillas.php'});
        });
    });
 });
</script>  
<script>
    var $table = $('#tableEstilos'),
        $button = $('#show2');
        $edit = $('#edit');
  
  
      function dataFormater(value, row, index) {

        var id = row.id;

        var strHTML = "<div>";
         strHTML += "<a href='index.php?page=estilos_form&datos=" + id + "' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Editar</a>";
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
    
 $('#tablebloque').bootstrapTable('refresh', {url: 'administracion/vistas/plantillas.php'});
        });
    });
 });
</script>
	</div>
		</div>
    </div>	
</body>
</html>
