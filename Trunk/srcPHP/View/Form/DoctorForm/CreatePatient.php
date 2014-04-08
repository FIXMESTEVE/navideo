<?php
/**
 *\file		CreatePatient.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini le Formulaire gerant la creation
 *
 *\details	Cette classe permet à un docteur d'ajouter un patient n'existant pas déjà
 */
include_once "srcPHP/View/Form/FormView.php";
include_once "srcPHP/Model/DoctorModel/DoctorModel.php";

class CreatePatient extends FormView{
	/* Variable */
	var $model = NULL;

	function CreatePatient($action){
		try{
			parent::FormView($action);
			$this->model = new DoctorModel("dbserver", "xjouveno", "xjouveno", "pdp");
			$this->execute();
		} catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkCSS(){ }

	function linkJS(){ }

	function onLoadJS(){ }

	function execute(){
		if(isset($_GET) && isset($_GET["execute"]) && $_GET["execute"] === "true" )
			if(isset($_POST) && isset($_POST["NamePatient"]) && !empty($_POST["NamePatient"]))
				$this->model->addPatient($_POST["NamePatient"]);
	}

	function draw(){
		echo "<form id=\"createPatient\" action=\"".$this->action."?form=create_patient&execute=true\" method=\"post\">";
		echo "<label>Nom du Patient : </label><input type=\"text\" name=\"NamePatient\">";
		echo "<input type=\"submit\" value=\"Creer\">";
		echo "</form>";
	}
}
?>
