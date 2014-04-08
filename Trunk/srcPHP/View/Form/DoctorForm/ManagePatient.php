<?php
/**
 *\file		ManagePatient.php
 *\author	Antoine Laumond, Romain Fontaine, Tom Solacroup, Xavier Jouvenot
 *\version	2.0
 *\date		08 Avril 2014
 *\brief	Defini le Formulaire gerant la liste des clients d'un patient et les video des ceux-ci.
 *
 *\details	Cette classe permet à un docteur de se rajouter ou de s'enlever des patients
 *			et aussi de gerer les liens entre les patients et leurs videos.
 */
include_once "srcPHP/View/Form/FormView.php";
include_once "srcPHP/Model/DoctorModel/DoctorModel.php";
include_once "srcPHP/Model/ResearchModel.php";


class ManagePatient extends FormView{
	/* Variables */
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
				$this->listAllPatients = $this->model->getListOfAllPatients();
				$this->listAllVideos = $this->model->getCompleteVideoList();
				$this->model = new DoctorModel("dbserver", "xjouveno", "xjouveno", "pdp");
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
		/* Gestion des patients */
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
		echo "<button class='btn btn-default' type=\"button\" onclick=\"removePatient();\"><span class='glyphicon glyphicon-arrow-left'></span></button><br/>";
		echo "<button class='btn btn-default' type=\"button\" onclick=\"addPatient();\"><span class='glyphicon glyphicon-arrow-right'></span></button>";
		echo "</th>";
		echo "<th>";
		echo "<select name=\"mine[]\" size=15 id=\"mine\" multiple>";
		for($i=0; $i<count($this->listPatient); $i++)
			echo "<option value=\"".$this->listPatient[$i]["Id"]."\">".$this->listPatient[$i]["Name"]." ".$this->listPatient[$i]["Id"]."</option>";
		echo "</select>";
		echo "</th>";
		echo "</tr>";
		echo "</table>";
		echo "<input type=\"submit\" class='btn btn-success' value=\"Valider\" onclick=\"updatePatients();\">";
		echo "</form>";
		echo "<button type=\"button\" class='btn btn-default' onclick=\"goToCreateNewPatient();\"><span class='glyphicon glyphicon-plus'></span>Creer un nouveau patient</button>";
	
		echo "<br/>";
		echo "<br/>";
		echo "<p><label>Attribution des videos aux patients.</label></p>";
		echo "<div id='assignVideosToPatients'>";
		echo "<select size=15 id=\"allPatients\">";
		for($i=0; $i<count($this->listAllPatients); $i++)
			echo "<option value='".$this->listAllPatients[$i]["Id"]."'>".$this->listAllPatients[$i]["Name"]." ".$this->listAllPatients[$i]["Id"]."</option>";
		echo "</select>";

		echo "<div id=\"videoList\">";
    	for($i=0; $i<count($this->listAllVideos); $i++)
			echo "<input type=\"checkbox\" name='".$this->listAllVideos[$i]["IdVideo"]."' value='".$this->listAllVideos[$i]["IdVideo"]."' disabled/>".$this->listAllVideos[$i]["Title"]."<br />";
    	echo "</div>";
    	echo "</div>";
	}
}

?>
