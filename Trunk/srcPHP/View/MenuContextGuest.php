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

	function linkCSS(){
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu_guest.css\" >";
		$this->formConnection->linkCSS();
	}

	function draw(){
		echo "<header>";
		$this->formConnection->draw();
		echo "</header>";
	}
}

?>
