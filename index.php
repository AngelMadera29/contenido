<?php
    session_start();
    include_once 'include/class.user.php';
    $user = new User();

    $id = $_SESSION['id'];
    $_SESSION['nivel'];

    if (!$user->get_session()){
       header("location:login.php");
    }

    if (isset($_GET['q'])){
        $user->user_logout();
        header("location:login.php");
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Home</title>
		<style>
    		body{
    			font-family:Arial, Helvetica, sans-serif;
    		}
    		h1{
    		    font-family:'Georgia', Times New Roman, Times, serif;
    		}
		</style>
    </head>

    <body>
        <div id="container">
            <div id="header">
                <a href="index.php?q=logout">LOGOUT</a>
            </div>
            <div id="main-body">
    			<br/><br/><br/><br/>
    			<h1>
                  Hello <?php echo "$id"; ?>
    			</h1>	
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
