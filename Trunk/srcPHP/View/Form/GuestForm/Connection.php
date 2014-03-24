<?php
include_once "srcPHP/View/Form/FormView.php";

class Connection extends FormView{
	function Connection($action){
		parent::FormView($action);
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/connexion.css\">"; }

	function linkJS(){ }

	function onLoadJS(){ return ""; }

	function execute(){

	}

	function draw(){
		echo "<form id=\"connexion\" action=\"".$this->action."\" method=\"post\">";
		echo "<label>Identifiant : </label><input type=\"text\" name=\"Login\"/>";
		echo "<label>Mot de passe : </label><input type=\"password\" name=\"Password\"/>";
		echo "<input type=\"submit\" value=\"Connexion\">";
		echo "</form>";
	}
}

?>