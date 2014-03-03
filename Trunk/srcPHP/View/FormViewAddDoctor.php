<?php
include_once "FormView.php";

class FormViewAddDoctor extends FormView{
	function FormViewAddDoctor($action){
		parent::FormView($action);
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/add_doctor.css\">"; }

	function draw(){
		echo "<form id=\"add_doctor\" action=\"".$this->action."\" method=\"post\">";
		echo "<label>Nom : </label><input type=\"text\" name=\"Name\"/>";
		echo "<label>Identifiant : </label><input type=\"text\" name=\"Login\"/>";
		echo "<label>Mot de passe : </label><input type=\"password\" name=\"Password\"/>";
		echo "<input type=\"submit\" value=\"Ajouter\">";
		echo "</form>";
	}
}

?>
