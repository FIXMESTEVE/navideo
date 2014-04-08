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
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=UTF-8\">";
		echo "<title>Projet De Programmation</title>";
		echo "<script type=\"text/javascript\" src=\"js/SM2/soundmanager2.js\"></script>";
		echo "<script type=\"text/javascript\" src=\"js/utils.js\"></script>";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/body.css\">";
	    echo "<!-- Bootstrap -->";
	    echo "<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">";
		$this->menu->linkCSS();
		$this->section->linkCSS();
		echo "<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->";
	    echo "<script src=\"js/jquery.min.js\"></script>";
		$this->section->linkJS();


		echo "</head>";
		echo "<body onload=".$this->menu->onLoadJS().$this->section->onLoadJS().">";

		$this->menu->draw();
		$this->section->draw();
		$this->addTagMenu->draw();
		
		echo "<button onClick=\"hideMenu(this);\">Cacher les menus</button>";

	    echo "<!-- Include all compiled plugins (below), or include individual files as needed -->";
	    echo "<script src=\"js/bootstrap.min.js\"></script>";

		echo "</body>";
		echo "</html>";
	}
}
?>

