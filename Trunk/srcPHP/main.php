<?php

include_once "View/Menu/MenuView.php";
include_once "View/Section/SectionView.php";
include_once "View/Player/Tag/AddTag.php";

class Main{
	var $menu;
	var $section;
	var $addTagMenu;

	function Main(){
		try{
			$this->menu = new MenuView();
			$this->section = new SectionView();
			$this->addTagMenu = new AddTag();
		} catch(Exception $e){
			echo $e->getMessage();
		}

	}

	function run(){
		echo "<!doctype html>";
		echo "<html>";
		echo "<head>";
		echo "<title>Projet De Programmation</title>";
		echo "<script type=\"text/javascript\" src=\"js/SM2/soundmanager2.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/utils.js\"></script>";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/body.css\">";

		$this->menu->linkCSS();
		$this->section->linkCSS();
		$this->section->linkJS();

		echo "</head>";
		echo "<body onload=".$this->menu->onLoadJS().$this->section->onLoadJS().">";

		$this->menu->draw();
		$this->section->draw();
		$this->addTagMenu->draw();
		
		
		echo "</body>";
		echo "</html>";
	}
}
?>

