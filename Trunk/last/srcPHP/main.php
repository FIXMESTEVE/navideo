<?php

include_once "Model/UploadModel.php";
include_once "View/MenuView.php";

class Main{
	var $model;
	var $menu;

	function Main(){
		$this->model = new UploadModel("dbserver", "xjouveno", "xjouveno", "pdp");
		$this->menu = new MenuView();
	}

	function run(){
//		$this->model->addDoctor("House", "Gregory", "Diagnostic");
//		$this->model->addDoctor("Hadley", "Numero 13", "Diagnostic");
//		$this->model->addDoctor("Martin", "Martin", "Diagno");

//		$this->model->addPatient("Martin", "Gregory");

//		$this->model->addVideo(3,"monChemin1");
//		$this->model->addVideo(3,"monChemin2");

		$this->menu->draw();
	}
}

?>
