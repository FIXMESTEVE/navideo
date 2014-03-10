<?php
include_once "FormViewAddDoctor.php";
include_once "PlayerView.php";

class SectionView implements View{

	var $javascriptPath = "";
	var $context = NULL;

	function SectionView($javaPath=""){
		if(is_string($javaPath)){
			$this->javascriptPath = $javaPath;
			$this->setContext();
		}
		else
			throw new Exception("ERREUR - Fonction SectionView(...) - Verifier les types des parametres");
	}

	function setContext(){
		if(isset($_GET) && isset($_GET["form"])){
			if($_GET["form"] === "add_doctor")
				$this->context = new FormViewAddDoctor("index.php");

			$this->context->execute();
		}
		else
			$this->context = new PlayerView();
	}

	function linkCSS(){ $this->context->linkCSS(); }

	function draw(){
		$this->context->draw();
	}
}
?>
