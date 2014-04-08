<?php
/**
 *\file		FormView.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini la classe mère abstraite de vue des formulaires.
 *
 *\details	Cette classe permet de definir les fonctions nécessaire au bons fonctionnement des
 *			différents formulaire des l'application
 *			Les fonction définies par l'interface + une fonction execute
 */
include_once "srcPHP/View/View.php";

abstract class FormView implements View{
	/* Variables */
	var $action = "";

	/**
	 *\brief	Contructeur de la classe FormView
	 *\details	Fontion permettant d'instancier les variables de la classe Main
	 *\param	$action		fichier qui va recevra le formulaire
	 */
	function FormView($action){
		if(is_string($action))
			$this->action = $action;
		else
			throw new Exception("ERREUR - FormView(...) - Verifier les types des parametres");
	}

	/**
	 *\brief	Fonction abstraite qui servira a l'execution des formulaires Fille
	 */
	abstract function execute();

	abstract function linkCSS();

	abstract function linkJS();

	abstract function onLoadJS();

	abstract function draw();
}
?>
