<?php 
include_once("administracion/BBDD.php");

	class User{
	
		
		/*** for login process ***/
		public function check_login($name, $password){
			
			$bbdd = new Base_de_datos('administracion/bbdd.db');
        	
			$sql2="SELECT * from usuarios WHERE nombre='$name' and sha_pass='$password'";
			
			
			//checking if the username is available in the table
        	$result = $bbdd->consulta($sql2,"select","usuarios","");
        	$user_data = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        	$nombre = $user_data['nombre'];
        	
		
	        if ($name == $nombre) {
	            // this login var will use for the session thing
	            $_SESSION['login'] = true; 
	            $_SESSION['id'] = $user_data['id'];
	            $_SESSION['nivel'] = $user_data['nivel'];
	            return true;
	        }
	        else{
			    return false;
			}
    	}
    	/*** starting the session ***/
	    public function get_session(){    
	        return $_SESSION['login'];
	    }

	    public function user_logout() {
	        $_SESSION['login'] = FALSE;
	        session_destroy();
	    }

	}
		
?>