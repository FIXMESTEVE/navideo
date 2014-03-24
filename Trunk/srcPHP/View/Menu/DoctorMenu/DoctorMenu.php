<?php
include_once "srcPHP/View/Menu/MenuInterface.php";

class DoctorMenu implements MenuInterface{
	var $name = "";
	var $id = -1;

	function DoctorMenu($id, $name){
		try{
			if(is_numeric($id) && is_string($name)){
				$this->id = $id;
				$this->name = $name;
			}
			else
				throw new Exception("ERREUR - Fonction DoctorMenu(...) - Verifier les types des parametres");
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

	function linkJS(){ }

	function onLoadJS(){ return ""; }

	function draw(){
		echo "<header>";
		echo "<label id=\"welcome\" >Bonjour ".$this->name."</label>";
		echo "<a id=\"deconnexion\" href=\"index.php?disconnect=true\"><button>Deconnexion</button></a>";
		echo "</header>";
		echo "<nav>";
		echo "<a href=\"index.php\"><label>Visionnage</label></a>";
		echo "<a href=\"index.php?form=manage_patient\"><label>Gestion des Patients</label></a>";
		echo "</nav>";
	}
}

?>
