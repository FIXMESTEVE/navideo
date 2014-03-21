<?php
include_once "InterfaceSectionView.php";
include_once "FormViewAddDoctor.php";
include_once "PlayerView.php";

class SectionAdministratorView implements InterfaceSectionView{

	var $context = NULL;

	function SectionAdministratorView(){
		$this->setContext();
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

	function linkJS(){ $this->context->linkJS(); }

	function onLoadJS(){ return $this->context->onLoadJS(); }

	function draw(){ $this->context->draw(); }
}
?>
