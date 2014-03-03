<?php
include_once "MenuContext.php";

class MenuContextDoctor implements MenuContext{
	var $name = "";
	var $id = -1;

	function MenuContextDoctor($id, $name){
		try{
			if(is_numeric($id) && is_string($name)){
				$this->id = $id;
				$this->name = $name;
			}
			else
				throw new Exception("ERREUR - Fonction MenuContextDoctor(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function isLogged(){ return true; }

	function disconnect(){
		session_start();
		$_SESSION = array();
		if(ini_get("session.use_cookies")){
			$params = session_get_cookie_params();
			setcookie(session_name, "", time-42000, $params["path"], $params["domain"], $params["secure"], $path["httponly"]);
		}
		session_destroy();
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu_doctor.css\">"; }

	static function linkJavascript(){ echo ""; }

	function draw(){
		echo "<div id=\"menuDoctor\">";
		echo "<label id=\"welcome\" >Bonjour ".$this->name."</label>";
		echo "<a id=\"deconnexion\" href=\"index.php?disconnect=true\"><button>Deconnexion</button></a>";
		echo "</div>";

		echo "<div id=\"patientsList\">";

		echo "</div>";
	}
}

?>
