<?php
	session_start();
	include_once 'include/class.user.php';
	$user = new User();
	
	
	if($_SESSION['login'] == true){
		header("Location:index.php");
	}

	if (isset($_REQUEST['submit'])) { 
		extract($_REQUEST);   
	    $login = $user->check_login($name, $password);
	    if ($login) {
	        // Registration Success
	       header("location:index.php");
	    } else {
	        // Registration Failed
	      echo '<script language="javascript">alert("Nombre o Contraseña incorrectos");</script>'; 
	    }
	}
?>

<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Login</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">  
<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/js/jquery.bootgrid.css" rel="stylesheet">
<link href="assets/js/bootstrap.min.js" rel="stylesheet">
<link rel="stylesheet" href="assets/js/date/jquery-ui.css">  
<script src="assets/js/date/jquery-1.10.2.js"></script>
<script src="assets/js/date/jquery-ui.js"></script>
<link rel="stylesheet" href="assets/js/date/style.css">
<link rel="stylesheet" type="text/css" href="assets/css/login.css" />
<script src="assets/js/login.js">	
</script>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form action="" class="form-signin" method="post" name="login">
	            
<span id="reauth-email" class="reauth-email"></span>

<input type="text" id="inputEmail" name="name" class="form-control" placeholder="Nombre usuario" required>
<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Contrase&#241;a" required>
<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="submit" value="Login" onclick="return(submitlogin());">Acceder
</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</head>
</html>