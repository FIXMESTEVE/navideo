<?php
include_once "srcPHP/View/Form/FormView.php";
include_once "srcPHP/Model/UploadModel.php";
include_once "srcPHP/Model/ResearchModel.php";


class ManagePatient extends FormView{
	var $model = NULL;
	var $listNotPatient = NULL;
	var $listPatient = NULL;
	var $id_doctor;

	function ManagePatient($action, $id_doctor){
		try{
			parent::FormView($action);
			if(is_numeric($id_doctor)){
				$this->id_doctor = $id_doctor;
				$this->model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
				$this->listNotPatient = $this->model->getListOfNotPatients($this->id_doctor);
				$this->listPatient = $this->model->getListOfPatients($this->id_doctor);
				$this->model = new UploadModel("dbserver", "xjouveno", "xjouveno", "pdp");
				$this->execute();
			}
			else
				throw new Exception("ERREUR - Fonction ManagePatient(...) - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/add_patient.css\">"; }

	function linkJS(){ echo "<script src=\"js/add_patient.js\"></script> "; }

	function onLoadJS(){ return ""; }

	function execute(){
		if(isset($_GET) && isset($_GET["execute"]) && $_GET["execute"] === "true")
			if(isset($_POST) && isset($_POST["mine"])){
				$this->model->updateListPatient($this->id_doctor, $_POST["mine"]);
				header('Location: index.php');
			}
	}

	function draw(){
		echo "<form id=\"manage_doctor\" action=\"".$this->action."?form=manage_patient&execute=true\" method=\"post\">";
		echo "<table>";
		echo "<tr><th>Autres Patients</th><th></th><th>Mes Patients</th></tr>";
		echo "<tr>";
		echo "<th>";
		echo "<select size=15 id=\"others\" multiple>";
		for($i=0; $i<count($this->listNotPatient); $i++)
			echo "<option>".$this->listNotPatient[$i]["Name"]." ".$this->listNotPatient[$i]["Id"]."</option>";
		echo "</select>";
		echo "</th>";
		echo "<th>";
		echo "<button type=\"button\" onclick=\"removePatient();\">"."<<"."</button>";
		echo "<button type=\"button\" onclick=\"addPatient();\">".">>"."</button>";
		echo "</th>";
		echo "<th>";
		echo "<select name=\"mine[]\" size=15 id=\"mine\" multiple>";
		for($i=0; $i<count($this->listPatient); $i++)
			echo "<option value=\"".$this->listPatient[$i]["Id"]."\">".$this->listPatient[$i]["Name"]." ".$this->listPatient[$i]["Id"]."</option>";
		echo "</select>";
		echo "</th>";
		echo "</tr>";
		echo "</table>";
		echo "<input type=\"submit\" value=\"Valider\" onclick=\"updatePatients();\">";
		echo "</form>";
		echo "<button type=\"button\" onclick=\"goToCreateNewPatient();\">Creer un nouveau patient</button>";
	}
}

?>
