<?php
include_once "srcPHP/View/Form/DoctorForm/ManagePatient.php";
include_once "srcPHP/View/Form/DoctorForm/CreatePatient.php";
include_once "srcPHP/View/Form/DoctorForm/SendXML.php";

include_once "srcPHP/View/Section/InterfaceSectionView.php";

include_once "srcPHP/View/Section/GuestSection/Mosaic.php";

include_once "srcPHP/View/Section/DoctorSection/ListPatientView.php";

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
		if(isset($_GET) && isset($_GET["form"]) && $_GET["form"] === "manage_patient")
			$this->context = new ManagePatient("index.php", $this->id_doctor);
		else if(isset($_GET) && isset($_GET["form"]) && $_GET["form"] == "create_patient")
			$this->context = new CreatePatient("index.php");
		else if(isset($_GET) && isset($_GET["section"]) && $_GET["section"] == "mosaic")
			$this->context = new Mosaic();
		else if(isset($_GET) && isset($_GET["section"]) && $_GET["section"] == "sendXML")
			$this->context = new SendXML();
		else if(isset($_GET) && isset($_GET["play"]))
			$this->context = new PlayerView($_GET["play"]);
		else
			$this->context = new ListPatientView($this->id_doctor);
	}

	function linkCSS(){ $this->context->linkCSS(); }

	function linkJS(){ $this->context->linkJS(); }

	function onLoadJS(){ return $this->context->onLoadJS(); }

	function draw(){ $this->context->draw(); }
}
?>
