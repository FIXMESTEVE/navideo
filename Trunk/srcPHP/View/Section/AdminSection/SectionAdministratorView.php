<?php
include_once "srcPHP/View/Form/AdminForm/AddDoctor.php";
include_once "srcPHP/View/Player/PlayerView.php";
include_once "srcPHP/View/Section/InterfaceSectionView.php";

class SectionAdministratorView implements InterfaceSectionView{

	var $context = NULL;

	function SectionAdministratorView(){
		$this->setContext();
	}

	function setContext(){
		if(isset($_GET) && isset($_GET["form"]) && $_GET["form"] === "add_doctor")
			$this->context = new AddDoctor("index.php");
		else
			$this->context = new PlayerView();
	}

	function linkCSS(){ $this->context->linkCSS(); }

	function linkJS(){ $this->context->linkJS(); }

	function onLoadJS(){ return $this->context->onLoadJS(); }

	function draw(){ $this->context->draw(); }
}
?>
