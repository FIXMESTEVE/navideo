<?php

include_once "Model/UploadModel.php";
include_once "View/MenuView.php";
include_once "View/VideoView.php";
include_once "View/UploadView.php";
include_once "View/FormViewUpload.php";

class Main{
	var $model;
	var $menu;
	var $video;
	var $upload;

	function Main(){
		$this->model = new UploadModel("dbserver", "xjouveno", "xjouveno", "pdp");
		$this->menu = new MenuView();
		$this->video = new VideoView();
		$this->upload = new FormViewUpload("index.php");
	}

	function run(){
//		$this->model->addDoctor("House", "Gregory", "Diagnostic");
//		$this->model->addDoctor("Hadley", "Numero 13", "Diagnostic");
//		$this->model->addDoctor("Martin", "Martin", "Diagno");

//		$this->model->addPatient("Martin", "Gregory");

//		$this->model->addVideo(3,"monChemin1");
//		$this->model->addVideo(3,"monChemin2");

		$this->menu->draw();
		$this->video->draw();
		//$this->upload->draw();
	}
}



?>
