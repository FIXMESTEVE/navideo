<?php
include_once "srcPHP/View/Form/FormView.php";

class CreatePatient extends FormView{

	var $model = NULL;

	function CreatePatient($action){
		try{
			parent::FormView($action);
			$this->model = new UploadModel("dbserver", "xjouveno", "xjouveno", "pdp");
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
