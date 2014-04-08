<?php

/**
 *\file		MenuView.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini la classe principale de la vue des menu de cette application.
 *
 *\details	Cette classe permet de gerer les différents menus et d'afficher le bon, au bon moment
 *			C'est la classe qui gère les divers états du menu.
 */
include_once "srcPHP/View/Menu/GuestMenu/GuestMenu.php";
include_once "srcPHP/View/Menu/DoctorMenu/DoctorMenu.php";
include_once "srcPHP/View/Menu/AdminMenu/AdminMenu.php";
include_once "srcPHP/Model/ResearchModel.php";

class MenuView implements View{
	/* Variable */
	var $context = NULL;

	/**
	 *\brief	Contructeur de la classe MenuView
	 *\details	Fontion permettant d'instancier les variables de la classe MenuView et de statuer sur le menuà afficher
	 *
	 */
	function MenuView(){
		$this->isLogged();
	}

	/**
	 *\brief	Fonction permettant de mettre à jour l'état du Menu
	 *\details	Fontion permettant d'instancier les variables de la classe MenuView et de statuer sur le menuà afficher
	 *
	 */
	function setContext(){
		session_start();

		// verification de la valide des identifiants
		if(isset($_SESSION) && isset($_SESSION["Authentification"]) && isset($_SESSION["Authentification"]["Login"]) && isset($_SESSION["Authentification"]["Password"])){
			$tmp = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
			if( $res = $tmp->getDoctor($_SESSION["Authentification"]["Login"], $_SESSION["Authentification"]["Password"]) )
				$this->context = new DoctorMenu($res["id"], $res["name"]);
			else if( $res = $tmp->getAdministrator($_SESSION["Authentification"]["Login"], $_SESSION["Authentification"]["Password"]) )
				$this->context = new AdminMenu($res, $_SESSION["Authentification"]["Login"]);
			else
				echo "BAM - Erreur connection - Identifiant/Mot de passe incorrecte";
		}
		else if(isset($_GET["disconnect"]) && !empty($_GET["disconnect"])){
			$this->context->disconnect();
			$this->context = new GuestMenu();
		}
		else
			$this->context = new GuestMenu();

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
