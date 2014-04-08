<?php

/**
 *\file		main.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini la classe principale de cette application.
 *
 *\details	Cette classe permet de structurer la page web en plusieurs grandes parties distinctes:
 *		le menu, le contenu de la page. Elle perm egalement d'instancier les objets de l'application en cascadede,
 *		de lier les divers fichiers CSS et JS de ceux-ci et de les afficher.
 */


include_once "View/Menu/MenuView.php";
include_once "View/Section/SectionView.php";
include_once "View/Player/Tag/AddTag.php";

class Main{
	/* Variables */
	var $menu = NULL;
	var $section = NULL;
	var $addTagMenu = NULL;


	/**
	 *\brief	Contructeur de la classe Main
	 *\details	Fontion permettant d'instancier les variables de la classe Main
	 *
	 */
	function Main(){
		try{
			$this->menu = new MenuView();
			$this->section = new SectionView();
			$this->addTagMenu = new AddTag();
		} catch(Exception $e){
			echo $e->getMessage();
		}

	}

	/**
	 *\brief	Fonction d'affichage de la classe Main
	 *\details	Cette fontion permet de mettre en place la structure d'une page web
	 *		et de lier les divers CSS etS a la page, ainsi que d'affichier les elements
	 *		qui en font partis.
	 */
	function run(){
		echo "<!doctype html>";
		echo "<html>";
		echo "<head>";
		echo "<title>Projet De Programmation</title>";
		echo "<script type=\"text/javascript\" src=\"js/SM2/soundmanager2.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/utils.js\"></script>";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/body.css\">";
		echo "<!-- Bootstrap -->";
		echo "<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">";
		$this->menu->linkCSS();
		$this->section->linkCSS();
		$this->section->linkJS();

		echo "</head>";
		echo "<body onload=".$this->menu->onLoadJS().$this->section->onLoadJS().">";

		$this->menu->draw();
		$this->section->draw();
		$this->addTagMenu->draw();

		echo "<button onClick=\"hideMenu(this);\">Cacher les menus</button>";
		echo "<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->";
		echo "<script src=\"js/jquery.min.js\"></script>";
		echo "<!-- Include all compiled plugins (below), or include individual files as needed -->";
		echo "<script src=\"js/bootstrap.min.js\"></script>";

		echo "</body>";
		echo "</html>";
	}
}
?>

