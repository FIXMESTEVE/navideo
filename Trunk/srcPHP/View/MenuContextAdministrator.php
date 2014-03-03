<?php
include_once "MenuContext.php";

class MenuContextAdministrator implements MenuContext{

	function MenuContextAdministrator(){
	}

	function isLogged(){ return true; }

	function disconnect(){
		$_SESSION = array();
	}

	function linkCSS(){ }

	function draw(){
		echo "<label>Bonjour Administreur</label>";
	}
}

?>
