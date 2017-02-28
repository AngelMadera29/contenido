<?php 
 session_start();
 if ($_SESSION['nivel'] == '' || $_SESSION['nivel']  < 0 ){exit;}

 $pos=0;
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>vista de habitaciones</title>
 </head>
 <body>
 <div class="row" style="padding:1% 2%">
 <?php 
$conn = new PDO("sqlite:../db/bbdd.db");  // SQLite Database
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql="select * from ofertas order by 2 limit $pos,4 ";
$stmt=$conn->prepare($sql);
$stmt->execute();
$res=$stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($res as $vista) {
        print('<div class="col-xs-12 col-sm-4 col-md-3 ">
              <div class="thumbnail" style=" height: auto;" >');
        print('<img src="administracion/db/imagenes'.$vista['foto_id'].'" class="img-responsive" alt="Responsive image" style=" height: 200px;width:100%">');
        print('<div class="col-xs-12 col-sm-12 col-md-12 ">');
        print('<h3><p>Articulo. '.$vistas['articulo'].'<br>Contenido:'.$vista['texto'].'</p></h3>');
       
        print('<p>habitacion N°: '.$key['numero_hab'].'<br>Ubigeo:'.$key['ubigeo_hab'].'</p>');
       
        print('<a href="index.php?page=personal_form&datos='.$vista['id'].'" class="btn btn-primary" role="button" style="width:100%">Editar</a>');
       // print('</div>');
      
        print('</div><br><br><br><br><br><br><br>');
        print('</div></div>');
} 
   ?>
<div class="col-xs-12 col-sm-12 col-md-12">

<nav>
  <ul class="pagination">
    <li>
      <a href="v_habitacionh.php?pos=<?php echo ($pos-1); ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li><a href="v_habitacionh.php?pos=1">1</a></li>
    <li><a href="v_habitacionh.php?pos=2">2</a></li>
    <li><a href="v_habitacionh.php?pos=3">3</a></li>
    <li><a href="v_habitacionh.php?pos=4">4</a></li>
    <li><a href="v_habitacionh.php?pos=5">5</a></li>
    <li>
      <a href="v_habitacionh.php?pos=<?php echo ($pos+1); ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
</div>
</div>

 </body>
 </html