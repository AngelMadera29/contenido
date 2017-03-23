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
    <script src="assets/bootstrap-table/src/extensions/filter-control/bootstrap-datepicker.js"></script>
    <script src="assets/bootstrap-table/src/extensions/export/bootstrap-table-export.js"></script>
      <script src="assets/bootstrap-table/src/extensions/flat-json/bootstrap-table-flat-json.js"></script>
        <script src="assets/ga.js"></script>
         <link rel="stylesheet" href="assets/css/style2.css">

     </head>     
<body>
		 
	<div class='row'>
	<?php
	echo "<div class='col-md-8'>";
echo "<h3> Noticias </h3>";		  
echo  "<a href='?page=ofertas_form' class='btn btn-primary'>Añadir Ofertas</a> ";
$contenido = "<button id='show' class='btn btn-danger' disabled>Vaciar Ofertas</button>";
$auth->autorizar("ofertas","botones",$contenido,$nivel);
	 echo "&nbsp";

	 ?>
	 <a href="#" onClick ="$('#table').tableExport({type:'pdf',escape:'false'});" class="btn btn-success">PDF</a>
		
     <button type="hidden" class="btn btn-success" id="run">Convert!</button><script>$('#run').hide();</script>
 
	 <a class="btn btn-primary pull-right" data-toggle="modal" href="#myModal" id="modellink">Show Modal</a>

    <button class="btn1">Hide</button>
	<button class="btn2">Show</button>
     <p>

    </div>
     <div class="modal-container"></div>
        <table id="table"             
	       	 data-search="true"
          	 data-show-refresh="true"
          	 data-show-columns="true"
	         data-page-size="9"
	         data-url="administracion/vistas/oferta.php"
	     	 data-toggle="table"
		     data-cookie="true"
             data-show-refresh="true"
	         data-toolbar="#toolbar"
             data-pagination="true"
		     data-page-list="[9, 27, 50, 100, ALL]"
	         data-filter-control="true" 
	         data-show-export="true"
             >
         <thead>
            <tr>
	            <th data-field="state" data-checkbox="true">Check</th>
                <th data-field="id">id</th>
                <th data-formatter="dataFormater" data-width="90">Accion</th>
                <th data-field="foto_id"  data-formatter="imageFormatter">Foto</th>               
				<th data-field="articulo" data-filter-control="input">Articulo</th> 
				<th data-field="precio" data-filter-control="input">Precio</th> 
				<th data-field="texto" data-filter-control="input">Texto</th> 
				<th data-field="video_id" data-formatter="imageFormatter1">Video</th>
				<th data-field="fecha_inicio" data-filter-control="datepicker" data-filter-datepicker-options='{"autoclose":true, "clearBtn": true, "todayHighlight": true}'>Fecha I.</th>
				<th data-field="fecha_fin" data-filter-control="datepicker" data-filter-datepicker-options='{"autoclose":true, "clearBtn": true, "todayHighlight": true}'>Fecha F.</th>
				<th data-field="pases_pendientes" data-filter-control="select" >Pases P.</th>	
				<th data-field="momento_inicial" >Momento I.</th>
				<th data-field="momento_final" >Momento F.</th>
				<th data-field="retardo" data-filter-control="select">Retardo</th>
				<th data-field="duracion" >Duracion</th>
				<th data-field="canal" >Canal</th>
				<th data-field="id_estilo_animacion" >Estilo</th>
            </tr>
		  </thead>
        </table> 
    </div>
	 	<script>
		//hide
		var modo_vision = "tarjetas";
		$(document).ready(function(){
		    $(".btn1").click(function(){
			if (modo_vision == "tarjetas")
				modo_vision = "tabla";
			else
				modo_vision = "tarjetas";
			$('#table').bootstrapTable('refresh');
			//$('.btn btn-default').click();
		 });
		 //show
		$(".btn2").click(function(){
		    $("td").show();
		    $(".gallery-widget").show();
		    $("thead").show();
		    });
		});
	</script>
 	
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
       window.location = "index.php?page=vaciado-ofertas&datos=" + ids;
       //enviar parametro post get 
            else
      alert('No se ha podido eliminar el personal..');
      
 $('#table').bootstrapTable('refresh', {url: 'administracion/vistas/oferta.php'});
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
    
	function imageFormatter1(value, row) {
		var file = value.replace(/\.[^\.]+$/, '.gif');
      return "<img width=100 src='administracion/db/previsualizaciones/" + file + "'>";
    }
 
    
    function dataFormater(value, row, index) {

        var id = row.id;

        var strHTML = "<div>";
         strHTML += "<a href='index.php?page=ofertas_form&datos=" + id + "' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Editar</a>";
        strHTML += "</div>";

        var valReturn = strHTML;

        return valReturn;
    }
    
    $(document).ready(function(){
		var url = "administracion/acciones/prueba.php";
		jQuery('#modellink').click(function(e) {
		    $('.modal-container').load(url,function(result){
				$('#myModal').modal({show:true});
			});
		});
	});
   
    $(function () {
        $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function () {
            $button.prop('disabled', !$table.bootstrapTable('getSelections').length);
    });
    
    $(function () {
        $button.click(function () {
            var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id;
            });
    
 $('#table').bootstrapTable('refresh', {url: 'administracion/vistas/oferta.php'});
        });
    });
 });
</script>
    
    <script type="text/javascript">  
	    
	    		//$(document).ready(function(){
			//var $table1 = $('#table');
			
		
		  
		$('#run').click( function() {
			
			  var $table1 = $('#table');
			  //var table = (JSON.stringify($table1.bootstrapTable('getData')));
			  //var array = JSON.parse(table);
			  
			  //investigar https://github.com/wenzhixin/bootstrap-table/pull/693			  
			  var array = $table1.bootstrapTable('getData', {useCurrentPage: true});
			  var total = array.length;
	
	// <!-- este div muestra en pantalla el grid de las ofertas  --> 
	//	 				    <div id="result"></div> 	
	//	<!-- este div muestra en pantalla el grid de las ofertas  --> 
	
	// 1) añadir una fila a la tabla 
	// 2) añadir un td colspan 17 a esa fila 
	// 3) añadir div o si quieres, ese colspan que tenga un id que se llame resultados
			
			//$('#table tr:last').remove();
			if (document.getElementById("result"))
				$('#table tr:last').remove();
				
			$('#table tr:last').after('<tr><td colspan="19"><div id="result" width="100%" height="100%"></div></td></tr>');
		    	  
			var html = "<div class='gallery-widget'> <ul>";
			for (var i = 0; i < array.length; i++)
		{		
			var file = array[i].video_id .replace(/\.[^\.]+$/, '.gif');	
			html+="<li>";
			html+="<img class='img-responsive' src='administracion/db/previsualizaciones/" + file+ "' aria-labelledby='item3-description'/>";
			html+="<p>";
			html+="<span id='item3-description'><h4>" + array[i].articulo + "</h4></span>";
			html+="<small>" + array[i].texto + "</small>";
			html+="<a href='index.php?page=ofertas_form&datos=" + array[i].id + "' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-edit'></span>&nbsp;&nbsp;Editar</a>";
			html+="</p>";
			html+="</li>";
			
		}
			html+="</ul>";
			html+="</div>";
	
			document.getElementById("result").innerHTML = html;	

	
		});
		
		$('#table').on('load-success.bs.table', function (e) {
			if(modo_vision == "tarjetas") 
			{
				$("td").hide();
			    $("thead").show();
				$('#run').click();
			}
		});
		$('#table').on('page-change.bs.table', function (e) {
			if(modo_vision == "tarjetas") 
			{
				$("td").hide();
			    $("thead").show();
				$('#run').click();
			}
		});				
	
		$('#table').on('search.bs.table', function (e) {
			if(modo_vision == "tarjetas") 
			{
				$("td").hide();
			    $("thead").show();
				$('#run').click();
			}
		});
		$('#table').on('column-search.bs.table', function (e) {
			if(modo_vision == "tarjetas") 
			{
				$("td").hide();
			    $("thead").show();
				$('#run').click();
			}
		});
		$('#table').on('column-switch.bs.table', function (e) {
			if(modo_vision == "tarjetas") 
			{
				$("td").hide();
			    $("thead").show();
				$('#run').click();
			}
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

