<?php
/**
 *\file		DoctorMenu.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini la classe de la vue du menu des Docteurs de cette application.
 *
 *\details	Cette classe permet de gerer le menu des médecins et les options qui leurs sont offertes
 */
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
		$_SESSION = array();
		session_destroy();
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu_doctor.css\">"; }

	function linkJS(){ }

	function onLoadJS(){ return ""; }

	function draw(){
		echo "<header>";
		echo "<label id=\"welcome\" >Bonjour ".$this->name."</label>";
		echo "<a id=\"deconnexion\" class=\"btn btn-default\" href=\"index.php?disconnect=true\"><span class='glyphicon glyphicon-off'></span> Deconnexion</a>";
		echo "</header>";
		echo "<nav>";
		echo "<a class=\"btn btn-default\" href=\"index.php\"><span class='glyphicon glyphicon-list'></span><label>Patients et visionnage</label></a>";
		echo "<a class='btn btn-default' href=\"index.php?section=mosaic\"><span class='glyphicon glyphicon-th'></span><label>Mosaique</label></a>";
		echo "<a class='btn btn-default' href=\"index.php?form=manage_patient\"><span class='glyphicon glyphicon-wrench'></span><label>Gestion des Patients</label></a>";
		echo "<a class='btn btn-default' href=\"modules/jQuery-File-Upload\" ><span class='glyphicon glyphicon-upload'></span>Upload</a>";
		echo "</nav>";
	}
}

?>
