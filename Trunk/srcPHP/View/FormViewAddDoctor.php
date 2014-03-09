<?php
include_once "FormView.php";
include_once "srcPHP/Model/UploadModel.php";


class FormViewAddDoctor extends FormView{
	var $model = NULL;

	function FormViewAddDoctor($action){
		parent::FormView($action);
		$this->model = new UploadModel("dbserver", "xjouveno", "xjouveno", "pdp");
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/add_doctor.css\">"; }

	function execute(){
		if(isset($_GET) && isset($_GET["execute"]) && $_GET["execute"] === "true")
			if(isset($_POST) && isset($_POST["NameDoctor"]) && !empty($_POST["NameDoctor"]) && isset($_POST["LoginDoctor"]) && !empty($_POST["LoginDoctor"]) && isset($_POST["PasswordDoctor"]) && !empty($_POST["PasswordDoctor"]))
				$this->model->addDoctor($_POST["NameDoctor"], $_POST["LoginDoctor"], $_POST["PasswordDoctor"]);
	}

	function draw(){
		echo "<form id=\"add_doctor\" action=\"".$this->action."?form=add_doctor&execute=true\" method=\"post\">";
		echo "<label>Nom : </label><input type=\"text\" name=\"NameDoctor\"/>";
		echo "<label>Identifiant : </label><input type=\"text\" name=\"LoginDoctor\"/>";
		echo "<label>Mot de passe : </label><input type=\"password\" name=\"PasswordDoctor\"/>";
		echo "<input type=\"submit\" value=\"Ajouter\">";
		echo "</form>";
	}
}

?>
