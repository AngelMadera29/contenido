<?php 
include_once("administracion/db/BBDD.php");

	class User{
	
		
		/*** for login process ***/
		public function check_login($name, $password){
			
			$bbdd = new Base_de_datos('administracion/db/bbdd.db');
        	
			$sql2="SELECT * from usuarios WHERE nombre='$name'";
			
			//checking if the username is available in the table
        	$result = $bbdd->consulta($sql2,"select","usuarios","");
        	$user_data = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
        	$pass = $user_data['sha_pass'];
        	

	        if ($pass == sha1("$name:$password")) {
	            // this login var will use for the session thing
	            $_SESSION['login'] = true; 
	            $_SESSION['id'] = $user_data['id'];
	            $_SESSION['nivel'] = $user_data['nivel'];
	            $_SESSION['nombre'] = $user_data['nombre'];
	            return true;
	        }
	        else{
			    return false;
			}
    	}
    	
    	/*** for showing the username or fullname ***/
    	public function get_fullname($id){
	    	$bbdd = new Base_de_datos('administracion/db/bbdd.db');
    		$sql3="SELECT nombre FROM usuarios WHERE id = $id";
			$result = $bbdd->consulta($sql3,"select","usuarios","");
			$user_data = $bbdd->obtener_resutado(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
	        echo $user_data['nombre'];
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