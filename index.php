<?php
if (!isset($_SESSION)) {
  session_start();
}
 
    include_once 'include/class.user.php';    
    $user = new User();
    include_once "administracion/db/BBDD.php";
    $auth = new Autorizador(); 

    $id = $_SESSION['id'];
    $nivel = $_SESSION['nivel'];
   

    if (!$user->get_session()){
       header("location:login.php");
    }

    if (isset($_GET['q'])){
        $user->user_logout();
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-sca le=1">
   
    <title>Noticias</title> 
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/js/jquery.bootgrid.css" rel="stylesheet">
	<link href="assets/js/bootstrap.min.js" rel="stylesheet">
  <link rel="stylesheet" href="assets/js/date/jquery-ui.css">
  
  <script src="assets/js/date/jquery-1.10.2.js"></script>
  <script src="assets/js/date/jquery-ui.js"></script>
  <link rel="stylesheet" href="assets/js/date/style.css">
	<!--<link href="assets/jquery.min.js" rel="stylesheet">-->
    
  </head>
  <body style="cursor: auto;" >
	  <div class="container-fluid">
			  <h1>Gestión de Noticias</h1>
			  
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Inicio</a>
      
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">	 
       <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="">Listado de contenido<span class="caret"></span></a>
        <ul class="dropdown-menu">
	        <li><a href="?page=ofertas">Lista de ofertas</a></li>
	        <li><a href="?page=prueba_tablas">Listas de Estilos</a></li>
	        <li><a href="?page=videos">Videos de fondo</a></li>
<?php  
$contenido = "
<li><a href='?page=usr'>Lista de usuarios</a></li>
<li><a href='?page=respaldo'>Respaldos</a></li>";
$auth->autorizar("index","listas",$contenido,$nivel);
?>

<?php
$contenido = "
<li><a href='?page=logs'>Lista de Logs</a></li>
<li><a href='?page=permisos'>Lista de Permisos</a></li>";
$auth->autorizar("logs","logs",$contenido,$nivel);
	?>

		  	  
        </ul>
     </li>         
</ul>
           <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php?q=logout"><?php  echo "<b>";  echo $_SESSION['nombre']; echo "</b>"; echo "&nbsp";?>Cerrar Sesión</a></li>
      </ul>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

	  <?php 	  
		  
		
		if (!isset($_GET['page']))
		{
			$_GET['page']="ofertas";	
		}
		switch ($_GET['page']) {
			
			//caso de listado de personal y edicion 
			default:
			include "administracion/vistas/ofertas.php";
			break;
			
			
		//seccion de control de registros de noticias
			case 'ofertas_form':
			include "administracion/acciones/ofertas_form.php";
			break;	
			case 'ofertas_add':
			include "administracion/acciones/agregar_ofertas.php";
			break;				
		//accion para abrir formulario de registro de nuevos usuarios
			case 'usuario_form':
			include "administracion/acciones/usuario_form.php";
			break;		
			case 'usuario_add':
			include "administracion/acciones/agregar_usuario.php";
			break;		
			case 'del_usuario':
			include "administracion/acciones/del_usuario.php";
			break;	
			
			
			
			//seccion de los videos de fondo 
			case 'videos':
			include "administracion/vistas/videos.php";
			break;	
			//seccion de control de registros de noticias
			case 'videos_form':
			include "administracion/acciones/videos_form.php";
			break;	
			case 'videos_add':
			include "administracion/acciones/agregar_videos.php";
			break;	
			case 'vaciado-videos':
			include "administracion/acciones/vaciado_videos.php";
			break;			

			
			
			
			
			//vistas de los bloques nuevos
			case 'animaciones':
			include "administracion/vistas/animaciones.php";
			break;	
			//seccion de control de registros de noticias
			case 'animaciones_form':
			include "administracion/acciones/animaciones_form.php";
			break;	
			case 'animaciones_add':
			include "administracion/acciones/agregar_animaciones.php";
			break;				
			
			
			case 'bloques':
			include "administracion/vistas/bloques.php";
			break;	
			//seccion de control de registros de noticias
			case 'bloques_form':
			include "administracion/acciones/bloques_form.php";
			break;	
			case 'bloques_add':
			include "administracion/acciones/agregar_bloques.php";
			break;	
						
			case 'estilos':
			include "administracion/vistas/plantillas.php";
			break;	
			//seccion de control de registros de noticias
			case 'estilos_form':
			include "administracion/acciones/estilos_form.php";
			break;	
			case 'estilos_add':
			include "administracion/acciones/agregar_estilos.php";
			break;	

			case 'prueba_tablas':
			include "administracion/vistas/tablas.php";
			break;	
			
			
			
			case 'permisos':
			include "administracion/vistas/permisos.php";
			break;	
			//seccion de control de registros de noticias
			case 'permisos_form':
			include "administracion/acciones/permisos_form.php";
			break;	
			case 'permisos_add':
			include "administracion/acciones/agregar_permisos.php";
			break;		
			
					
			
	//contenido para el vaciado de contenidos			
			case 'vaciado-ofertas':
			include "administracion/acciones/vaciado_ofertas.php";
			break;	
			case 'vaciado_logs':
			include "administracion/acciones/vaciado_logs.php";
			break;	
			
				

			//metodos para realizar respaldo correspondiente
			case 'respaldo':
			include "administracion/db/descomprimir.php";
			break;
			case 'descomprimir':
			include "administracion/db/test.php";
			break;	
				
			
			
			
			case 'ofertas':
			include "administracion/vistas/ofertas.php";
			break;		
			case 'usr':
			include "administracion/vistas/usr.php";
			break;	
			case 'thum';
			include 'administracion/vistas/thumbnail.php';
			break;
					
					
			case 'logs':
			include "administracion/vistas/logs.php";
			break;	
				

			
					
						
			
		} 
	 
	   ?> 
     </div>
  </body>
</html>