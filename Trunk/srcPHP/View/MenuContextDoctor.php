<?php
include_once "MenuContext.php";

class MenuContextDoctor implements MenuContext{
	var $name = "";

	function MenuContextDoctor($name){
		try{
			if(is_string($name))
				$this->name = $name;
			else
				throw new Exception("ERREUR - Fonction MenuContextDoctor(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e;
		}
	}

	function isLogged(){ return true; }

	function disconnect(){
		$_SESSION = array();
	}

	function draw(){
		echo "<label>Bonjour ".$this->name."</label>";
		echo "<a href=\"index.php?disconnect=true\"><button>Deconnexion</button></a>";

		echo "<div class='patientList'>";
		echo "<label>Bonjour!</label>";
		echo "</div>";
	}
}

?>
