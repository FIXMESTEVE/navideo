<?php

include_once "Model/UploadModel.php";
include_once "View/MenuView.php";
//include_once "View/VideoView.php";
//include_once "View/FormViewAddDoctor.php";
include_once "View/TagMenuView.php";
include_once "View/SectionView.php";

class Main{
	var $model;
	var $menu;
	var $section;
//	var $tags;

	function Main(){
		try{
			$this->model = new UploadModel("dbserver", "xjouveno", "xjouveno", "pdp");
//			$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
			$this->menu = new MenuView();
			$this->section = new SectionView();
//			$this->tags = new TagMenuView();
		} catch(Exception $e){
			echo $e->getMessage();
		}

	}

	function run(){
//		UploadModel

//		$this->model->addDoctor("House", "Gregory", "Diagnostic");
//		$this->model->addDoctor("Hadley", "Numero 13", "Diagnostic");
//		$this->model->addDoctor("Martin", "Martin", "Diagno");

//		$this->model->addPatient("Martin", "Gregory");

//		$this->model->addVideo(3,"monChemin1");
//		$this->model->addVideo(3,"monChemin2");

//		ResearchModel
//		$res = $this->model->getListOfPatients(22);
//		for($i=0; $i<count($res); $i++)
//			echo $res[$i];

		echo "<!doctype html>";
		echo "<html>";
		echo "<head>";
		echo "<title>Projet De Programmation</title>";
		echo "<script type=\"text/javascript\" src=\"srcPHP/script.js\"></script>";
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/body.css\">";

		$this->menu->linkCSS();
		$this->section->linkCSS();
//		$this->tags->linkCSS();

		echo "</head>";
		echo "<body>";

		$this->menu->draw();
		$this->section->draw();
//		$this->tags->draw();

		echo "<button onClick=\"hideMenu(this);\">Cacher les menus</button>";

		echo "</body>";
		echo "</html>";
	}
}



?>

