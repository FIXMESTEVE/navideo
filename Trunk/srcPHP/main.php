<?php

include_once "Model/UploadModel.php";
include_once "View/MenuView.php";
include_once "View/VideoView.php";

class Main{
	var $model;
	var $menu;
	var $video;

	function Main(){
//		$this->model = new UploadModel("dbserver", "xjouveno", "xjouveno", "pdp");
//		$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
		$this->menu = new MenuView();
		$this->video = new VideoView();
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

		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/body.css\">";
		$this->menu->linkCSS();
		$this->video->linkCSS();

		echo "</head>";
		echo "<body>";

		$this->menu->draw();
		$this->video->draw();

		echo "</body>";
		echo "</html>";

	}
}



?>

