<?php
include_once "srcPHP/View/Menu/MenuInterface.php";
include_once "srcPHP/View/Form/GuestForm/Connection.php";
include_once "srcPHP/View/Form/GuestForm/AddDoctor.php";

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
		echo "<a class='btn btn-default' href=\"index.php\" ><span class='glyphicon glyphicon-th'></span>Mosaique</a>";
		echo "<a class='btn btn-default' href=\"index.php?form=add_doctor\"> <span class='glyphicon glyphicon-user'></span>Creer un nouveau compte</a>";
		echo "</nav>";
	}
}

?>
