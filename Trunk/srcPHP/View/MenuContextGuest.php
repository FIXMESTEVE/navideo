<?php
include_once "MenuContext.php";
include_once "FormViewConnection.php";

class MenuContextGuest implements MenuContext{

	var $formConnection = NULL;

	function MenuContextGuest(){
		$this->formConnection = new FormViewConnection("index.php");
	}

	function isLogged(){ return false; }

	function disconnect(){ }

	function draw(){
		echo "<label>Bonjour Anonyme</label>";
		$this->formConnection->draw();
	}
}

?>
