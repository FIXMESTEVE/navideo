<?php
/**
 *\file		GuestMenu.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini la classe de la vue du menu des Invités de cette application.
 *
 *\details	Cette classe permet de gerer le menu des invités et les options qui leur sont proposées.
 */
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
