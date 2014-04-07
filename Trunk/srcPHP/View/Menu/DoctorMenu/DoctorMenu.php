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
		$_SESSION = array();
		session_destroy();
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/menu_doctor.css\">"; }

	function linkJS(){ }

	function onLoadJS(){ return ""; }

	function draw(){
		echo "<header>";
		echo "<label id=\"welcome\" >Bonjour ".$this->name."</label>";
		echo "<a id=\"deconnexion\" class=\"btn btn-default\" href=\"index.php?disconnect=true\">Deconnexion</a>";
		echo "</header>";
		echo "<nav>";
		echo "<a href=\"index.php\"><label>Liste des Patients</label></a>";
		echo "<a href=\"index.php?section=mosaic\"><label>Mosaique</label></a>";
		echo "<a href=\"index.php?form=manage_patient\"><label>Gestion des Patients</label></a>";
		echo "</nav>";
	}
}

?>
