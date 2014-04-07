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
		if(isset($_POST) && isset($_POST["Login"]) && !empty($_POST["Login"]) && isset($_POST["Password"]) && !empty($_POST["Password"]))
			$_SESSION["Authentification"] = array("Login" => $_POST["Login"], "Password" => $_POST["Password"]);
	}

	function draw(){
		
		echo "<form class=\"form-inline\" role=\"form\" id=\"connexion\" action=\"".$this->action."\" method=\"post\">";
		echo "<div class=\"form-group\">";
		echo "<label class=\"sr-only\" for=\"Login\">Identifiant</label><input class=\"form-control\" type=\"text\" id=\"Login\" placeholder=\"Identifiant\" name=\"Login\"/>";
		echo "</div>";
		echo "<div class=\"form-group\">";
		echo "<label class=\"sr-only\" for=\"Password\">Mot de passe</label><input class=\"form-control\" placeholder=\"Mot de passe\" type=\"password\" id=\"Password\" name=\"Password\"/>";
		echo "</div>";
		echo "<input class=\"btn btn-default\" type=\"submit\" value=\"Connexion\">";
		echo "</form>";
		
		/*
		echo "<form class=\"form-inline\" role=\"form\" id=\"connexion\" action=\"".$this->action."\">";
		echo  "<div class=\"form-group\">";
		echo    "<label class=\"sr-only\" for=\"Login\">Nom d'utilisateur</label>";
		echo    "<input type=\"email\" class=\"form-control\" id=\"Login\" name=\"Login\" placeholder=\"Enter email\">";
		echo  "</div>";
		echo  "<div class=\"form-group\">";
		echo    "<label class=\"sr-only\" for=\"Password\">Mot de passe</label>";
		echo    "<input type=\"password\" class=\"form-control\" id=\"Password\" name=\"Password\" placeholder="Password">";
		echo  "</div>";
		echo  "<button type=\"submit\" class=\"btn btn-default\">Connexion</button>";
		echo "</form>";
		*/
	}
}

?>
