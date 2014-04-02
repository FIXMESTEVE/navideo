<?php
include_once "srcPHP/View/Menu/MenuInterface.php";
include_once "srcPHP/View/Form/GuestForm/Connection.php";

class GuestMenu implements MenuInterface{

	var $formConnection = NULL;

	function GuestMenu(){
		$this->formConnection = new Connection("index.php");
//		$this->execute();
	}

	function isLogged(){ return false; }

	function disconnect(){ }

	function linkCSS(){
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu_guest.css\" >";
		$this->formConnection->linkCSS();
	}

	function linkJS(){ }

	function onLoadJS(){ return ""; }

	function draw(){
		echo "<header>";
		$this->formConnection->draw();
		echo "</header>";
		echo "<nav>";
		echo "<a href=\"index.php\" >Mosaique</a>";
		echo "</nav>";
	}
}

?>
