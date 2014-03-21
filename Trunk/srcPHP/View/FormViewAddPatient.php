<?php
include_once "FormView.php";
include_once "srcPHP/Model/UploadModel.php";
include_once "srcPHP/Model/ResearchModel.php";


class FormViewAddPatient extends FormView{
	var $model = NULL;
	var $listNotPatient = NULL;
	var $listPatient = NULL;

	function FormViewAddPatient($action, $id_doctor){
		try{
			parent::FormView($action);
			if(is_numeric($id_doctor)){
				$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
				$this->listNotPatient = $this->model->getListOfNotPatients($id_doctor);
				$this->listPatient = $this->model->getListOfPatients($id_doctor);
				$this->model = new UploadModel("dbserver", "xjouveno", "xjouveno", "pdp");
			}
			else
				throw new Exception("ERREUR - Fonction FormViewAddPatient(...) - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/add_patient.css\">"; }

	function linkJS(){ echo "<script src=\"js/add_patient.js\"></script> "; }

	function onLoadJS(){ return ""; }

	function execute(){
/*		if(isset($_GET) && isset($_GET["execute"]) && $_GET["execute"] === "true")
			if(isset($_POST) && isset($_POST["NamePatient"]) && !empty($_POST["NamePatient"]) && isset($_SESSION["Authentification"]["Id"]) && !empty($_SESSION["Authentification"]["Id"]))
				$this->model->addPatient($_POST["NamePatient"], $_SESSION["Authentification"]["Id"]);
*/	}

	function draw(){
		echo "<form id=\"add_doctor\" action=\"".$this->action."?form=add_patientr&execute=true\" method=\"post\">";
		echo "<table>";
		echo "<tr><th>Autres Patients</th><th></th><th>Mes Patients</th></tr>";
		echo "<tr>";
		echo "<th>";
		echo "<select size=15 id=\"others\">";
		for($i=0; $i<count($this->listNotPatient); $i++)
			echo "<option>".$this->listNotPatient[$i]["Name"]." ".$this->listNotPatient[$i]["Id"]."</option>";
		echo "</select>";
		echo "</th>";
		echo "<th>";
		echo "<button onclick=\"removePatient();\">"."<<"."</button>";
		echo "<button onclick=\"addPatient()\">".">>"."</button>";
		echo "</th>";
		echo "<th>";
		echo "<select size=15 id=\"mine\">";
		for($i=0; $i<count($this->listPatient); $i++)
			echo "<option>".$this->listPatient[$i]["Name"]." ".$this->listPatient[$i]["Id"]."</option>";
		echo "</select>";
		echo "</th>";
		echo "</tr>";
		echo "</table>";
		echo "<input type=\"submit\" value=\"Valider\">";
		echo "</form>";
		echo "<button onclick=\"goToCreateNewPatient();\">Creer un nouveau patient</button>";
	}
}

?>
