<?php
include_once "srcPHP/View/Menu/GuestMenu/GuestMenu.php";
include_once "srcPHP/View/Menu/DoctorMenu/DoctorMenu.php";
include_once "srcPHP/View/Menu/AdminMenu/AdminMenu.php";
include_once "srcPHP/Model/ResearchModel.php";

class MenuView implements View{

	var $javascriptPath = "";
	var $context = NULL;

	function MenuView($javaPath=""){
		if(is_string($javaPath)){
			$this->javascriptPath = $javaPath;
			$this->isLogged();
		}
		else
			throw new Exception("ERREUR - Fonction SectionModel(...) - Verifier les types des parametres");
	}

	function isLogged(){
		// connexion par defaut
		if($this->context == NULL)
			$this->context = new GuestMenu();

		session_start();
		// si l'on tente de se connecter
		if(isset($_POST) && isset($_POST["Login"]) && !empty($_POST["Login"]) && isset($_POST["Password"]) && !empty($_POST["Password"]))
			$_SESSION["Authentification"] = array("Login" => $_POST["Login"], "Password" => $_POST["Password"]);

		// verification de la valide des identifiants
		if(isset($_SESSION) && isset($_SESSION["Authentification"]) && isset($_SESSION["Authentification"]["Login"]) && isset($_SESSION["Authentification"]["Password"])){
			$tmp = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
			if( $res = $tmp->getDoctor($_SESSION["Authentification"]["Login"], $_SESSION["Authentification"]["Password"]) )
				$this->context = new DoctorMenu($res["id"], $res["name"]);
			else if( $res = $tmp->getAdministrator($_SESSION["Authentification"]["Login"], $_SESSION["Authentification"]["Password"]) )
				$this->context = new AdminMenu($res, $_SESSION["Authentification"]["Login"]);
			else
				$_SESSION = array();

			// si l'on tente de se connecter
			if(isset($_GET["disconnect"]) && !empty($_GET["disconnect"])){
				$this->context->disconnect();
				$this->context = new GuestMenu();
			}
		}
	}

	function linkCSS(){ $this->context->linkCSS(); }

	function linkJS(){ }

	function onLoadJS(){ return ""; }

	function draw(){
		$this->context->draw();
	}
}
?>
