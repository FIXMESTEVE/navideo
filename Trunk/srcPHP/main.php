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
		echo "<div id=\"newTagTest\">";
		echo "Ancre A = null & Ancre B = null";
		echo "</div>";

		echo "<button onClick=\"hideMenu(this);\">Cacher les menus</button>";
		echo "<button onClick=\"anchorTag(this);\">Etiquettage A->B</button>";
		
		echo "<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->";
	    echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\"></script>";
	    echo "<!-- Include all compiled plugins (below), or include individual files as needed -->";
	    echo "<script src=\"js/bootstrap.min.js\"></script>";

		echo "</body>";
		echo "</html>";
	}
}
?>

