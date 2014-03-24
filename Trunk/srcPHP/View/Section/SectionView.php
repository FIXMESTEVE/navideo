<?php
include_once "srcPHP/Model/ResearchModel.php";
include_once "srcPHP/View/Section/InterfaceSectionView.php";
include_once "srcPHP/View/Section/DoctorSection/SectionDoctorView.php";
include_once "srcPHP/View/Section/AdminSection/SectionAdministratorView.php";
include_once "srcPHP/View/Section/GuestSection/SectionGuestView.php";

class SectionView implements InterfaceSectionView{

	var $context = NULL;

	function SectionView(){
		$this->setContext();
	}

	function setContext(){
		if(isset($_SESSION) && isset($_SESSION["Authentification"]) && isset($_SESSION["Authentification"]["Login"]) && isset($_SESSION["Authentification"]["Password"])){
			$tmp = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
			if($res = $tmp->getDoctor($_SESSION["Authentification"]["Login"], $_SESSION["Authentification"]["Password"]))
				$this->context = new SectionDoctorView($res["id"]);
			else if($res = $tmp->getAdministrator($_SESSION["Authentification"]["Login"], $_SESSION["Authentification"]["Password"]))
				$this->context = new SectionAdministratorView();
		}
		else{
			$this->context = new SectionGuestView();
		}
	}

	function linkCSS(){ $this->context->linkCSS(); }

	function linkJS(){ $this->context->linkJS(); }

	function onLoadJS(){ return $this->context->onLoadJS(); }

	function draw(){ $this->context->draw(); }
}
?>
