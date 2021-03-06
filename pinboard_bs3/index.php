<!DOCTYPE html>
<!-- saved from url http://www.bootstraptor.com ##########################################################################
Don't remove this attribution!
This template build on Bootstrap 3 Developer  Kit v.3.0. by @Bootstraptor
Built with Bootstrap 3.0. RC 1 version/ part of Bootstraptor KIT
Read usage license on for this template on http://www.bootstraptor.com 
##########################################################################
-->
<html lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Base page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">




<!-- Le styles -->
<!-- Latest compiled and minified CSS BS 3.0. -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<!--<link href="assets/css/theme.css" rel="stylesheet">-->

<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">

<!--[if lt IE 7]>
	<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome-ie7.min.css" rel="stylesheet">
	<![endif]-->
    <!-- Fav and touch icons -->
	
    <!-- Le styles -->
<!-- GOOGLE FONT-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700italic,700,500&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<!-- /GOOGLE FONT-->	
<!-- SOME BOOTSTRAP OVERRIDES STYLES -->
<style type="text/css">
      body {
        padding-top: 50px;
		padding-bottom:40px;
		max-height:100%;
      }
	
	.jumbotron{
		background:#358cce;
		color:#fff;
	  }
	  
	
	  
	.thumbnail{
		position:relative;
	  }
	  .plus{
		position:absolute;
		top:20px;
		left:20px;
		
		text-align:center;
		 /* IE 8 */
		  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";

		  /* IE 5-7 */
		  filter: alpha(opacity=0);

		  /* Netscape */
		  -moz-opacity: 0;

		  /* Safari 1.x */
		  -khtml-opacity: 0;

		  /* Good browsers */
		  opacity: 0;
	  }
	  
	  .thumbnail:hover .plus{
		
		 /* IE 8 */
		  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";

		  /* IE 5-7 */
		  filter: alpha(opacity=100);

		  /* Netscape */
		  -moz-opacity: 1;

		  /* Safari 1.x */
		  -khtml-opacity: 1;

		  /* Good browsers */
		  opacity: 1;
	  }
	  .box{
		margin-bottom:30px;
	  }
	  
	  /* isotop items animation */
	  .isotope .isotope-item {
		-moz-transition-property: -moz-transform, opacity;
		-ms-transition-property: -moz-transform, opacity;
		-o-transition-property: top, left, opacity;
		transition-property: transform, opacity;
		-webkit-transition-property: -webkit-transform, opacity;
		}
		.isotope .isotope-item {
		-moz-transition-property: -moz-transform, opacity;
		-ms-transition-property: -moz-transform, opacity;
		-o-transition-property: top, left, opacity;
		transition-property: transform, opacity;
		-webkit-transition-property: -webkit-transform, opacity;
		}
		.isotope-item {
		-moz-transition-duration: 0.8s;
		-ms-transition-duration: 0.8s;
		-o-transition-duration: 0.8s;
		transition-duration: 0.8s;
		-webkit-transition-duration: 0.8s;
		z-index: 2;
		}
	  
	  @media (max-width: 767px){
		.thumbnail img{
			min-width:100%;
			height:auto;
		}
	  }
	  


	  
	  
    </style>

	


<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

  <body>

   <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
		<div class="container">
	  <!-- Brand and toggle get grouped for better mobile display -->
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">YOURSITE.COM</a>
	  </div>

	  <!-- Collect the nav links, forms, and other content for toggling -->
	  <div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul class="nav navbar-nav">
		   <li><a href="#">Link 1</a></li>
		  <li><a href="#">Link 2</a></li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
			<ul class="dropdown-menu">
			  <li><a href="#">Action</a></li>
			  <li><a href="#">Another action</a></li>
			  <li><a href="#">Something else here</a></li>
			  <li><a href="#">Separated link</a></li>
			  <li><a href="#">One more separated link</a></li>
			</ul>
		  </li>
		</ul>
		<form class="navbar-form navbar-right visible-lg" role="search">
		  <div class="form-group">
			<input type="text" class="form-control" placeholder="Search">
		  </div>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div><!-- /.navbar-collapse --> 
	</div>	
</nav>


    

      <!-- Main hero unit for a primary marketing message or call to action -->
<div class="jumbotron">     
	
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h1>Pinboard blog responsive</h1>
				</div>
			</div>
		</div>
</div>
  <!-- CONTENT CONTAINER-->
		<div class="container">
		
	
      	
<!--###################-->
<!-- START PORTFOLIO -->
<!--###################-->

<?php 
$pos=0;
$conn = new PDO("sqlite:../administracion/db/bbdd.db");  // SQLite Database
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$resultado = $conn->query("select * from ofertas order by id asc limit $pos,8 ");
$res = $resultado->fetchAll(PDO::FETCH_ASSOC);

foreach ($res as $vista) {
echo '<div id="container-folio_'.$vista['id'].'" style="position:relative">'.
	'<div class="box col-xs-12 col-md-4 col-sm-6 col-lg-3">'.
	'<div class="thumbnail">'.
	'<img class="img-responsive" src="../administracion/db/imagenes/'.$vista['foto_id'].'" alt="">'.
	'<div class="caption">'.
	'<h3><p>'.$vista['articulo'].'<br>'.$vista['texto'].'</p></h3>'.
	'<span class="meta">'.
	'<i class="fa-icon-calendar"></i> January 1, 2013'.
	'</span>'.
	'<p> 
			<a href="index.php?page=personal_form&datos='.$vista['id'].'" class="btn btn-primary" role="button" style="width:100%">Editar</a>
			</p>'.
	'</div>'.
	'</div>'.
	'</div>'.
	'</div>';
	
}
?>

<!--
<div id="container-folio" style="position:relative">
    <div class="box col-xs-12 col-md-4 col-sm-6 col-lg-3">
		<div class="thumbnail">		
			<img class="img-responsive" src="http://lorempixel.com/560/420/fashion/10" alt="">
			<div class="caption">
				<h3 class="single-title"><a href="#" title="">Blog Post Title</a></h3>
		<span class="meta">
			<i class="fa-icon-calendar"></i> January 1, 2013
		</span>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc sit amet enim eu nulla scelerisque tincidunt. 
			<a href="" class="btn btn-primary" role="button" style="width:100%">Editar</a>
			</p>

		</div>
	</div> 
</div>
-->
<!-- END portfolio item -->
	  

</div><!--/ROW-->
<!--###################-->
<!-- END PORTFOLIO -->
<!--###################-->
      <hr>
	  <div class="row">
	    <!-- PAGINATION-->
	  <div class="col-12 col-lg-12 text-center">

        <ul class="pagination text-center">
          <li class="disabled">
          <a href="#">Previous</a></li>
          <li class="active" id="page_nav"><a href="#">1</a></li>
          <li id="page_nav"><a href="#">2</a></li>
          <li id="page_nav"><a href="#">3</a></li>
          <li id="page_nav"><a href="#">4</a></li>
          <li id="page_nav"><a href="#">5</a></li>
          <li id="page_nav"><a href="#">Next</a></li>
        </ul>
      </div>
	  <!-- END PAGINATION-->
	  </div>
	  <hr>

      <footer>
        <p><a href="http://www.bootstraptor.com" title=""> Built with ©Bootstraptor 2013</a></p>
      </footer>

    </div> <!-- /container -->
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js" type="text/javascript"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
<!-- Isotope init script -->

<script type="text/javascript" src="assets/js/jquery.waitforimages.js"></script> 
<script type="text/javascript" src="assets/js/jquery.isotope.min.js"></script>


<!-- Isotope init script -->
<script>
		jQuery.noConflict()(function($){
			var $container = $('#container-folio');
					
			if($container.length) {
				$container.waitForImages(function() {
					$(this).slideDown();
					// initialize isotope
					$container.isotope({
					
					  itemSelector : '.box',
					  
					  resizable: false, // disable normal resizing
					 masonry: { columnWidth: $container.width() / 12 }
					});
					 
						// update columnWidth on window resize
						$(window).smartresize(function(){
		
							$(window).smartresize(function(){
				  $container.isotope({
					// update columnWidth to a percentage of container width
					masonry: { columnWidth: $container.width() / 12 }
				  }); 
				  
				  });

		});
					
					
					
				},null,true);
				
			}});

</script>
<!-- / Isotope init script -->

</body>
</html>