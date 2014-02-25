<?php
include_once "MenuContext.php";

class MenuContextDoctor implements MenuContext{

	function MenuContextDoctor(){
	}

	function isLogged(){ return true; }

	function draw(){
		echo "<label>Bonjour Docteur</label>";
	}
}

?>
