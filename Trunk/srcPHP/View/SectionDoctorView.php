<?php
include_once "InterfaceSectionView.php";
include_once "ListPatientView.php";
include_once "FormViewAddPatient.php";

class SectionDoctorView implements InterfaceSectionView{

	var $context = NULL;
	var $id_doctor;

	function SectionDoctorView($id_doctor){
		try{
			if(is_numeric($id_doctor)){
				$this->id_doctor = $id_doctor;
				$this->setContext();
			}
			else
				throw new Exception("ERREUR - Fonction SectionDoctorView(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function setContext(){
		if(isset($_GET) && isset($_GET["form"]) && $_GET["form"] === "add_patient")
			$this->context = new FormViewAddPatient("index.php", $this->id_doctor);
		else
			$this->context = new ListPatientView($this->id_doctor);
	}

	function linkCSS(){ $this->context->linkCSS(); }

	function linkJS(){ $this->context->linkJS(); }

	function onLoadJS(){ return $this->context->onLoadJS(); }

	function draw(){ $this->context->draw(); }
}
?>
