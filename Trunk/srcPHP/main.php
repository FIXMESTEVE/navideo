<?php

include_once "Model/UploadModel.php";
include_once "View/MenuView.php";
include_once "View/VideoView.php";
include_once "View/FormViewAddDoctor.php";

class Main{
	var $model;
	var $menu;
	var $form;

	function Main(){
		$this->model = new UploadModel("dbserver", "xjouveno", "xjouveno", "pdp");
//		$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
		$this->menu = new MenuView();
		if(isset($_GET) && isset($_GET["form"]) && $_GET["form"]==="add_doctor"){
			$this->form = new FormViewAddDoctor("index.php?execute=add_doctor");
		}
		else
			$this->form = new VideoView();
			$this->executeForm();

	}

	function executeForm(){
		if(isset($_GET) && isset($_GET["execute"]) && $_GET["execute"]==="add_doctor"){
			echo "1";
			if(isset($_POST) && isset($_POST["Name"]) && !empty($_POST["Name"]) && isset($_POST["Login"]) && !empty($_POST["Login"]) && isset($_POST["Password"]) && !empty($_POST["Password"]) ){
				echo "2";
				$this->model->addDoctor($_POST["Name"], $_POST["Login"], $_POST["Password"]);
			}
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

		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/body.css\">";

		$this->menu->linkCSS();
		$this->form->linkCSS();

		echo "</head>";
		echo "<body>";

		$this->menu->draw();
		$this->form->draw();

		echo "</body>";
		echo "</html>";

	}
}



?>

