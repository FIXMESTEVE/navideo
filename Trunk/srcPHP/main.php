<?php

include_once "View/Menu/MenuView.php";
include_once "View/Section/SectionView.php";

class Main{
	var $menu;
	var $section;

	function Main(){
		try{
			$this->menu = new MenuView();
			$this->section = new SectionView();
		} catch(Exception $e){
			echo $e->getMessage();
		}

	}

	function run(){
		echo "<!doctype html>";
		echo "<html>";
		echo "<head>";
		echo "<title>Projet De Programmation</title>";
		echo "<script type=\"text/javascript\" src=\"srcPHP/script.js\"></script>";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/body.css\">";

		$this->menu->linkCSS();
		$this->section->linkCSS();
		$this->section->linkJS();

		echo "</head>";
		echo "<body onload=".$this->menu->onLoadJS().$this->section->onLoadJS().">";

		$this->menu->draw();
		$this->section->draw();

		echo "<button onClick=\"hideMenu(this);\">Cacher les menus</button>";

		echo "</body>";
		echo "</html>";
	}
}
?>

